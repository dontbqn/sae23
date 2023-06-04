<?php

if (file_exists("./fonctions.php")) {
    include("./fonctions.php");
} elseif(file_exists("../fonctions.php")){
    include("../fonctions.php");
}
else{
    include("../../fonctions.php");
}


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
        if(!isset($_COOKIE['LOGGED_USER'])){ // Thème du fond par défaut pour tous les utilisateurs
            if(!isset($_SESSION["user"])){
                cookiesOrNot();
            }; 
        }
        else{
            if(!isset($_SESSION["user"])){
                // Cookie LOGGED_USER, donc utilisateur existe, on relance sa session via son TOKEN ID

                echo "VOUS AVEZ ETE RECONNU, relancement de la session en cours ";
                $usercookie = $_COOKIE['LOGGED_USER'];
                $hashcookie =  $_COOKIE['MOTDEPASSE'];
                //connexion($_COOKIE['LOGGED_USER'],$_COOKIE['MOTDEPASSE']);
                /*
                $users = json_decode(file_get_contents("data/users.json", true), true);
                foreach($users as $user){
                    if($user["user"] == $usercookie){
                        $usertoken = $user["tokenid"];
                    }
                }
                */

                // Connexion via tokenID avec mot de passe + token
                //connexion($usercookie,$userhash);
            }
            //echo 'cookies : ';
            //sprint_r($_COOKIE);
        }
}

function pagenavbar($pageactive){
    echo '<header>'.liseret().'</header>';  
    echo '
    <div class="container-fluid pt-4">
        <nav class="row">
            <div class="col">
                <a class="navbar-brand" href="./page01.php">
                    <img src="images/logo.png" alt="" width="50" height="44">
                </a>
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                    <img src="images/menu.png" class="img-fluid" width="30" height="30">
                </button>
            </div>
            <div class="col">
                <form class="d-flex" role="search" method="post" action="./explorer.php">
                    <input class="form-control me-2 shadow-none" list="datalistOptions" type="search" placeholder="Search" aria-label="Search" style="width: 400px;">
                    <button class="btn btn-outline-dark btn-light" type="submit">Search</button>
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
                                <form id="form_connect" method="post">
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
                    <a class="navbar-brand">
                        <button type="button" class="btn shadow-none border-0 btn-theme pe-1 mb-1"><img src="images/night.png" width="20" height="20" /></button>
                        <script src="js/theme.js"></script>
                    </a>
                    <a type="button" class="navbar-brand ms-1" href="page05.php">
                        <span class="fs-6 me-1 pseudo font-monospace">'.$_SESSION["user"].'</span>
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
                
                <div class="btn-group">
                    <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    FR / EN
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark text-center">
                        <li><button class="dropdown-item"><img src="images/FR.png" alt="" width="20" height="20"></button></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><button class="dropdown-item"><img src="images/EN.png" alt="" width="20" height="20"></button></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    € / $
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark text-center">
                        <li><button class="dropdown-item">€</button></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><button class="dropdown-item">$</button></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">'; 
                // On check si l'utilisateur possède les droits
                //d'accès à l'intra
                if(isset($_SESSION['user'])){
                    if(isset($_SESSION['role']) && ($_SESSION['role']=="visitor" || $_SESSION['role']=="user")){
                        echo '
                        <a type="button" class="btn btn-danger ms-2" href="bonsplan.php">Bons Plans</a>
                        <a type="button" class="btn btn-danger ms-2" href="pourvous.php">Pour vous</a>
                        ';
                    }elseif(isset($_SESSION['role']) && $_SESSION['role']=="admin" ||$_SESSION['role']=="superadmin" ){
                        $employee = $_SESSION['user'];
                        if(!file_exists("./entreprise/salaries/$employee")){ // Boutons admins
                            $employee = null;
                        }
                        echo '
                        <a type="button" class="btn btn-danger ms-2" href="';echo ($employee !== null) ? './entreprise/salaries/'.$employee."/$employee.php" : 'error_page.php?message=EmployeeNotFound'; echo '">Accès à l\'espace perso</a>
                        <a type="button" class="btn btn-danger ms-2" href="./entreprise/intranet.php">Accès à l\'Intranet</a>
                        ';
                    }
                    elseif(isset($_SESSION['role']) && $_SESSION['role']=="salarie"){ // Boutons employés
                        $employee = $_SESSION['user'];
                        if(!file_exists("./entreprise/salaries/$employee.php")){
                            $employee = null;
                        }
                        echo '
                        <a type="button" class="btn btn-danger ms-2" href="';echo ($employee !== null) ? './entreprise/salaries/'.$employee : 'error_page.php?message=EmployeeNotFound'; echo '">Accès à l\'espace perso</a>
                        <a type="button" class="btn btn-danger ms-2" href="./entreprise/intranet.php">Accès à l\'Intranet</a>
                        ';
                    }
                    elseif(isset($_SESSION['role']) && $_SESSION['role']=="partenaire"){ // Boutons partenaire
                        $partenaire = $_SESSION['partenaire'];
                        if(!file_exists("./entreprise/partenaires/$partenaire.php")){
                            $partenaire = null;
                        }
                        echo '
                        <a type="button" class="btn btn-danger ms-2" href="';echo ($partenaire !== null) ? './entreprise/partenaires/'.$partenaire.'.php' : 'error_page.php?message=PartenaireNotFound'; echo '">Accès à l\'espace Partenaire</a>
                        ';
                    }
                    else{
                        return " "; // Boutons plèbe
                    }
                }

                echo '
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
            <a class="nav-link '.($pageactive == "page01.php" ? navbarItemActive() : navbarItem()).'" href="page01.php">Accueil</a>
        </li>';

        echo '<li class="nav-item list-group-item">
        <a class="nav-link '.($pageactive == "wiki.php" ? navbarItemActive() : navbarItem()).'" href="wiki.php">Wiki</a>
        </li>';
        echo '
        <li class="nav-item list-group-item">
        <a class="nav-link '.($pageactive == "page05.php" ? navbarItemActive() : navbarItem()).'" href="page05.php">Profil</a>
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
                    <a class="nav-link '.($pageactive == "about.php" ? navbarItemActive() : navbarItem()).'" href="./about.php">Qui sommes-nous ?</a>
                </li>
                <li class="nav-item list-group-item">
                    <a class="nav-link '.($pageactive == "partenaires.php" ? navbarItemActive() : navbarItem()).'" href="./entreprise/partenaires.php">Partenaires</a>
                </li>
            </ul>
        </div>
    </div>
    ';  
        // Assistant ChatBot
        echo '  <div class="fixed-bottom">
                    <span class="btn btn-primary ms-4 mb-3 btn-lg rounded-circle" id="liveToastBtn"> ? </span>
                </div>
                <div class="toast-container fixed-bottom ms-5 mb-5">
                    <div id="liveToast" class="toast" role="alert" class="show" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                        <div class="toast-header">
                            <img src="images/louis.png" class="rounded ms-1 me-2" alt="bugslogo" width="25" height="25">
                            <strong class="me-auto fs-6"> TripBot </strong>
                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            <div class="mb-3 p-1 text-dark">
                                Hey l\'ami ! Je suis ton assistant personnel, envoie moi un message décrivant ton problème et je ferai de mon mieux pour t\'aider ! Bonne journée :p
                            </div>
                            <form method="post" action="./contact/aide.php">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" maxlength="300" id="floatingText" style="height: 100px" required></textarea>
                                    <label for="floatingText">Votre message</label>
                                </div>
                                <small class="ps-1 mb-1">300 caractères max.</small>
                            
                                <div class="d-grid gap-2 col-3 mx-auto badge tex">
                                    <button class="bg-primary p-2 text-light" type="submit">envoyer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script> // From BootStrap Docs 5.3 /components/toasts/ 
                const toastTrigger = document.getElementById(\'liveToastBtn\')
                const toastLive = document.getElementById(\'liveToast\')

                if (toastTrigger) {
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLive)
                toastTrigger.addEventListener(\'click\', () => {
                    toastBootstrap.show()
                })
                }
                </script>
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
                    <li class="nav-item mb-2"><a href="./entreprise/about.php" class="nav-link p-0 footlink text-black-50">A propos</a></li>
                    <li class="nav-item mb-2"><a href="./entreprise/partenaires.php" class="nav-link p-0 footlink text-black-50">Partenaires</a></li>
                    <li class="nav-item mb-2"><a href="./entreprise/carriere.php" class="nav-link p-0 footlink text-black-50">Rejoignez-vous</a></li>
                </ul>
                <br>
                
            </div>

            <div class="col-6 col-md-3 mb-3">
                <h5>Contact</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="./contact/aide.php" class="nav-link p-0 footlink text-black-50">Aide / Support</a></li>
                    <li class="nav-item mb-2"><a href="./contact/remboursement.php" class="nav-link p-0 footlink text-black-50">Remboursement</a></li>
                    <li class="nav-item mb-2"><a href="./contact/infosupp.php" class="nav-link p-0 footlink text-black-50">Informations complémentaires</a></li>
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
                        <button href="https://www.twitter.com/tripking/" class="">
                            <img src="images/twitter.png" alt="" width="40" height="40">
                        </button>
                        <button href="https://www.instagram.com/tripking/" class="">
                            <img src="images/insta.png" alt="" width="40" height="40">
                        </button>
                        <button href="www.facebook.com/tripking/" class="">
                            <img src="images/facebook.png" alt="" width="40" height="40">
                        </button>
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
                        &#127850;
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
        var_dump($_SESSION["cookie"]);
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

function accesPerso($user){
    //return filename of user's personal file space
    if(file_exists("./entreprise/salaries/$user")){
        return $user;
    }
    else{
        echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle mb-1" viewBox="0 0 16 16">
        <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
        <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
        </svg>  Aucun espace perso pour '.$user.'    <br/>';
    }
}

?>

