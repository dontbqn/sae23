<?php

include("./fonctions.php");

function liseret(){
    echo '
    <nav class="navbar bg-secondary">
        <div class="container-fluid">
            <a class="navbar-text text-decoration-none link-light" href="./bons_plans.php">
            &#128722;&#127939; GROSSE PROMO SUR LES LOGEMENTS !! -50% PARTOUT
            </a>
        </div>
    </nav>
    ';
}

function setup(){
    echo '
    <!DOCTYPE HTML>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Bastien, Aronn, Clément, Adrien">
        <link rel="icon" href="images/iconetk.ico">
        <title>TripKing</title>
        <meta name="viewport" content="width=device-width">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">    
        <link href="css/liseret.css" rel="stylesheet">
    </head>
    ';

    echo '<header>'.liseret().'</header>';  
        if(!isset($_COOKIE['LOGGED_USER'])){ // Thème du fond par défaut pour tous les utilisateurs
            cookiesOrNot();
        }
        else{
            if(!$_SESSION["user"]){
                //Cookie LOGGED_USER, donc utilisateur existe, on relance sa session
                echo "VOUS AVEZ ETE RECONNU, relancement de la session en cours";
                connexion($_COOKIE['LOGGED_USER'],$_COOKIE['MOTDEPASSE']);
            }
            //echo 'cookies : ';
            //sprint_r($_COOKIE);
        }
}

function pagenavbar($pageactive){
    echo '
    <div class="container-fluid pt-4">
        <nav class="row navbar">
            <div class="col" role="group">
                <a class="navbar" href="./Acceuil.php">
                    <img src="images/logo.png" alt="" width="50" height="44">
                </a>
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                    <img src="images/menu.png" class="img-fluid" width="30" height="30">
                </button>
            </div>

            <div class="col">
                <form class="d-flex" role="search" method="post" action="./explorer.php">
                    <input class="form-control me-2 shadow-none" list="datalistOptions" type="search" placeholder="Search" aria-label="Search" style="width: 400px;">
                    <button class="btn btn-outline-dark" type="submit">Search</button>
                    <datalist id="datalistOptions">
                        <option value="San Francisco">
                        <option value="New York">
                        <option value="Seattle">
                        <option value="Los Angeles">
                        <option value="Chicago">
                    </datalist>
                </form>
            </div> 
            ';
            //Bouton Utilisateur connecté / ou non

            if(!isset($_POST['connect'])){ // Lorsque l'utilisateur n'est pas encore connecté donc pas de role, fenêtre de connexion Modal
                echo '
                <div class="modal fade" id="connectModal" tabindex="-1" aria-labelledby="connectModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="connectModalLabel">Vous n\'êtes pas connecté</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="" id="form_connect" method="post">
                                            <div class="mb-3">
                                                <label for="user" class="col-form-label">Pseudo</label>
                                                <input type="text" class="form-control shadow-none" name="user" id="user" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="mdp" class="col-form-label">Mot de passe</label>
                                                <input type="password" class="form-control shadow-none passwords" placeholder="" name="mdp" id="mdp" required>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" name="mdp_check" class="form-check-input my-2 p-2 shadow-none" id="dontwatchme">
                                                <label for="mdp_check"> rendre visible</label>
                                                <script src="js/pass_verif.js"></script>
                                            </div>
                                            <div class="row p-2 mt-1 ms-1">
                                                <div class="col form-check">
                                                    <input type="checkbox" class="form-check-input" name="remember" checked>
                                                    <label for="remember">Se souvenir ?</label>
                                                </div>
                                                <div class="col text-center">
                                                    <label for="inscription">Pas encore membre ?</label>
                                                    <a class="link-warning" href="inscription.php"> Rejoignez-nous !</a>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" name="connect">Connexion</button>
                                </form>
                                    </div>
                        </div>
                    </div>
                    
                </div>
                ';
            }
            else{ // Lorsque l'utilisateur a cliqué sur "Se Connecter"

                $nom = $_POST['user'];
                $mdp = $_POST['mdp'];
                $remember=false;
                //echo '<pre>';
                //echo password_hash($mdp,PASSWORD_DEFAULT);
                //echo '</pre>';
                // Commandes troubleshoot mot de passes hashés
 
                if(isset($_POST["remember"])){
                    $remember=true;
                }
                // Si un utilisateur lance le site, il n'est plus connecté (session finie)
                // Mais grâce au cookie d'authentification, on peut aller rechercher à qui correspond
                // le cookie et relancer la session automatiquement pour l'utilisateur
                // ==> Pas besoin de se login en joignant le site pendant 3 jours

                connexion($nom, $mdp,$remember);
            }
            echo '
            <div class="col text-end">
            ';

            if(isset($_SESSION['user'])){ // Utilisateur connecté => on affiche son pseudo
                echo '
                    <a class="navbar-brand" href="Fichier_Utilisateur.php">
                        <span class="fs-6 me-1">'.$_SESSION["user"].'</span>
                        <img src="images/icone_user.png" alt="" width="40" height="40">
                    </a>
                ';
            }
            else{
                echo '
                    <a class="navbar-brand">
                        <button type="button" id="connectBtn" class="btn btn-outline-secondary btn-dark btn-sm badge text-wrap me-1" data-bs-toggle="modal" data-bs-target="#connectModal">Se connecter</button>
                    </a>
                ';
            }
            echo '
                <a class="navbar-brand" href="#">
                    <img src="images/icone_coeur.png" alt="" width="40" height="40">
                </a>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        FR / EN
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><button class="dropdown-item"><img src="images/FR.png" alt="" width="20" height="20"></button></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><button class="dropdown-item"><img src="images/EN.png" alt="" width="20" height="20"></button></li>
                    </ul>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        € / $
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><button class="dropdown-item">€</button></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><button class="dropdown-item">$</button></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container-fluid pt-3">
        <div class="row ">
            <div class="col-md-6 offset-md-3 text-center">
                <button type="button" class="btn btn-danger">texte</button>
                <div class="vr"></div>
                <button type="button" class="btn btn-danger ms-2">texte</button>
                <div class="vr"></div>
                <button type="button" class="btn btn-danger ms-2">texte</button>
            </div>
        </div>
    </div>
    <script src="js/liseret.js"></script>
    '; //liseret.js


    // Menu Side Bar
    echo '
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling">
        <div class="offcanvas-header">';
        //On occuppe le Header du Canva pour implémenter nos boutons de connexions / inscriptions
        if(isset($_SESSION['user'])){
            if(isset($_SESSION['role']) && $_SESSION['role']=="visitor"){ // Si un utilisateur avec le role visiteur est sur le site 
                if(isset($_POST["deconnect"])){
                    deconnexion();
                }
                else{
                    echo "
                    <form method='post'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-power mb-3 me-1' viewBox='0 0 16 16'>
                        <path d='M7.5 1v7h1V1h-1z'/>
                        <path d='M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z'/>
                        </svg><button type='submit' name='deconnect' class='btn btn-outline-warning btn-danger btn-sm badge text-wrap'>Deconnexion</a>
                    </form><br>";
                        echo '<span class="text-center fst-italic">connected as '.$_SESSION["user"].'</span>';
                }
            }
            elseif(isset($_SESSION['role']) && ($_SESSION['role']=="admin" || $_SESSION['role']=="superadmin")){ // Si un admin est sur le site 
                if(isset($_POST["deconnect"])){
                    deconnexion();
                }
                else{
                    echo "
                        <form method='post'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-power mb-3 me-1' viewBox='0 0 16 16'>
                            <path d='M7.5 1v7h1V1h-1z'/>
                            <path d='M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z'/>
                            </svg><button type='submit' name='deconnect' class='text-black btn btn-outline-warning btn-danger btn-sm badge text-wrap'>Change account</a>
                        </form><br>";
                        echo '<span class="text-center fst-italic">connected as '.$_SESSION["user"].'</span>';
                }
            }
            else{   // Si un utilisateur connecté avec le role anonyme est sur le site 
                    // Ils ont quand même un compte, donc peuvent se déconnecter
                if(isset($_POST["deconnect"])){
                    deconnexion();
                }
                else{
                    echo "
                        <form method='post'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-power mb-1' viewBox='0 0 16 16'>
                            <path d='M7.5 1v7h1V1h-1z'/>
                            <path d='M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z'/>
                            </svg><button type='submit' name='deconnect' class='btn btn-outline-warning btn-danger btn-sm badge text-wrap'>Deconnexion</a>
                        </form>";
                }
            }
            
            
        }
        else{
            echo 'Non connecté';
        }

        // FIN DU HEADER OFFCANVAS
        echo '
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <a type="button" href="./reservations.php" class="btn btn-sm active text-wrap badge mx-2 px-4">mes réservations</a>

        <div class="offcanvas-body">
        <ul class="list-group list-group-flush">
            <li class="nav-item list-group-item">
            <a class="nav-link '.($pageactive == "Accueil.php" ? navbarItemActive() : navbarItem()).'" href="Accueil.php">Accueil</a>
        </li>';
        echo '<li class="nav-item list-group-item">
            <a class="nav-link '.($pageactive == "Formulaires.php" ? navbarItemActive()  : navbarItem()).'" href="Formulaires.php">Formulaires</a>
        </li>';

        echo '<li class="nav-item list-group-item">
        <a class="nav-link '.($pageactive == "Informations.php" ? navbarItemActive() : navbarItem()).'" href="Informations.php">Informations</a>
        </li>';
        echo '
        <li class="nav-item list-group-item">
        <a class="nav-link '.($pageactive == "Fichier_Utilisateur.php" ? navbarItemActive() : navbarItem()).'" href="Fichier_Utilisateur.php">Profil</a>
        </li>';
        if(isset($_SESSION)){
            if(isset($_SESSION['user']) && ($_SESSION['role']=="admin" || $_SESSION["role"] == "superadmin")){
                echo '
                <li class="nav-item list-group-item">
                <a class="nav-link '.($pageactive == "page06.php" ? "active bg-danger fw-bolder border bg-opacity-50 border-2 border-danger bg-gradient rounded-3 p-3" : navbarItem()).'" href="page06.php">Admin</a>
                </li>';
            }
        }
        echo '
                <li class="nav-item list-group-item">
                    <a class="nav-link '.($pageactive == "deposer-une-annonce.php" ? navbarItemActive() : navbarItem()).'" href="deposer-une-annonce.php">Déposer votre annonce</a>
                </li>
                <li class="nav-item list-group-item">
                    <a class="nav-link '.($pageactive == "explorer.php" ? navbarItemActive() : navbarItem()).'" href="explorer.php">Explorer</a>
                </li>
                <li class="nav-item list-group-item">
                    <a class="nav-link '.($pageactive == "restrictions.php" ? navbarItemActive() : navbarItem()).'" href="restrictions.php">Restrictions de voyage</a>
                </li>
                <li class="nav-item list-group-item">
                    <a class="nav-link '.($pageactive == "pourvous.php" ? navbarItemActive() : navbarItem()).'" href="pourvous.php"><img src="images/foryou.png" class="me-1" width="30" height="30">Pour vous</a>
                </li>
                <li class="nav-item list-group-item">
                    <a class="nav-link '.($pageactive == "about.php" ? navbarItemActive() : navbarItem()).'" href="explorer.php">Qui sommes-nous ?</a>
                </li>
                <li class="nav-item list-group-item">
                    <a class="nav-link '.($pageactive == "partenaires.php" ? navbarItemActive() : navbarItem()).'" href="partenaires.php">Partenaires</a>
                </li>
            </ul>
        </div>
    </div>
    ';
}

function navbarItemActive(){
    return 'fw-semibold active border border-2 rounded-3 border-light bg-secondary bg-opacity-25 ps-2 py-3';
}
function navbarItem(){
    return 'border border-2 rounded-3 border-light ps-2 py-1';
}

function footer(){
    echo '
    <hr>
    <footer class="container mt-2 pt-5">
        <div class="row">
            <div class="col-6 col-md-3 mb-3">
                <h5>Entrepise</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="./entreprise/about.php" class="nav-link p-0 text-muted">A propos</a></li>
                    <li class="nav-item mb-2"><a href="./entreprise/partenaires.php" class="nav-link p-0 text-muted">Partenaires</a></li>
                    <li class="nav-item mb-2"><a href="./entreprise/carriere.php" class="nav-link p-0 text-muted">Rejoignez-vous</a></li>
                </ul>
                <br>
                
            </div>

            <div class="col-6 col-md-3 mb-3">
                <h5>Contact</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="./contact/aide.php" class="nav-link p-0 text-muted">Aide / Support</a></li>
                    <li class="nav-item mb-2"><a href="./contact/remboursement.php" class="nav-link p-0 text-muted">Remboursement</a></li>
                    <li class="nav-item mb-2"><a href="./contact/infosupp.php" class="nav-link p-0 text-muted">Informations complémentaires</a></li>
                </ul>
            </div>
            
            <div class="col-md-5 offset-md-1 mb-3">
                <form method="post">
                    <h5>Subscribe to our newsletter</h5>
                    <p>Monthly digest of what exciting from us.</p>
                    <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                        <label for="newsletter1" class="visually-hidden">Email address</label>
                        <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                        <button class="btn btn-primary" type="button">Subscribe</button>
                    </div>
                </form>
                <p>Avenue Jean Moulin – 7, 40221 Saint-Malo, France</p>
            </div>
        </div>

        <div class="container text-center">
            <div class="row">
                <div class="col-sm-4">
                    <div class="btn-group" role="group">
                            <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            FR / EN
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><button class="dropdown-item"><img src="images/FR.png" alt="" width="20" height="20"></button></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><button class="dropdown-item"><img src="images/EN.png" alt="" width="20" height="20"></button></li>
                            </ul>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            € / $
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><button class="dropdown-item">€</button></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><button class="dropdown-item">$</button></li>
                            </ul>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div>
                        <a href="https://www.twitter.com/tripking/" class="">
                            <img src="images/twitter.png" alt="" width="40" height="40">
                        </a>
                        <a href="https://www.instagram.com/tripking/" class="">
                            <img src="images/insta.png" alt="" width="40" height="40">
                        </a>
                        <a href="www.facebook.com/tripking/" class="">
                            <img src="images/facebook.png" alt="" width="40" height="40">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column flex-sm-row justify-content-center py-4 my-4 border-top">
            <p>&copy; 2022 Company, Inc. All rights reserved.</p>      
        </div>
    </footer>
    ';
}

function cookiesOrNot(){
    //Cookie popup devrait apparaitre qu'une seule fois dans une session utilisateur
    //
     if(!isset($_POST["cookie_popup"])){
        echo '
        <div class="d-flex justify-content-end position-fixed bottom-0 end-0 mb-4 m-2 d-none d-sm-none d-md-block" id="toaster" style="z-index:1">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-animation="true">
                    <div class="toast-header bg-success bg-gradient">
                        <img src="img/cookie.ico" class="rounded me-2" width="27px" height="27px" title="cookie ico">
                        <h5><strong class="me-auto badge text-dark text-wrap">Cookies & Privacy</strong></h5>
                        <button type="submit" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close" value="cookie_popup" name="cookie_popup"></button>
                    </div>
                    <div class="toast-body text-white bg-dark lh-sm">
                    <form method="post">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="necessary" name="necessary" checked />
                            <label class="form-check-label" for="necessary">
                                <p>
                                    <strong>Necessary cookies</strong>
                                    <muted>help with the basic functionality of our website, e.g remember if you gave consent to cookies.</muted>
                                </p>
                            </label>
                        </div>
                        <!-- Analytical -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="analytical" name="analytical" />
                            <label class="form-check-label" for="analytical">
                                <p>
                                    <strong>Analytical cookies</strong>
                                    <muted>make it possible to gather statistics about the use and trafic on our website, so we can make it better.</muted>
                                </p>
                            </label>
                        </div>
                        <!-- Marketing -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="marketing" name="marketing" />
                            <label class="form-check-label" for="marketing">
                                <p>
                                    <strong>Marketing cookies</strong>
                                    <muted>make it possible to show you more relevant social media content and advertisements on our website and other platforms.</muted>
                                </p>
                            </label>
                        </div>
                    </form>
                        <div class="learn-more">
                            <a class="d-inline rounded-pill link-danger badge bg-warning text-wrap p-2" href="#" target="">Learn More</a>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            ';
            //<span class="text-white-50">close to get rid of this pop-up</span>
     }
     else{
        if(isset($_POST["necessary"])){
            array_push($_SESSION["cookie"], "necessary");
        }
        if(isset($_POST["analytical"])){
            array_push($_SESSION["cookie"], "analytical");
        }
        if(isset($_POST["necessary"])){
            array_push($_SESSION["cookie"], "marketing");
        }
     }
    
}
?>

