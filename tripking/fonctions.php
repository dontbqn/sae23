<?php
/*

Header <header>
Forme : Jumbotron ou équivalent
Contenu : titre du site, logo
Navigation <nav>
Forme : Navbar, horizontale
Contenu : liens vers les différentes pages
Contenu <div>
Contenu : spécifique à chaque page dont le contenu est précisé à chaque fois
Footer <footer>
Forme : Jumbotron ou équivalent en BS 5.
Contenu :
Première ligne : prénom, nom, mail de l’auteur, groupe, date et heure
Deuxième ligne : symbole du copyright avec année (généré en PHP), adresse IP et port de la
station du client (voir la variable $_SERVER)
*/

function pageheader(){
    echo '
    <header class="jumbotron row m-3 p-1">
    <div class="col-sm-4 logo">
        <img src="images/.png" class="img-fluid" style="height:10px;">SOLDES 50% - BONS PLANS - SUIVEZ NOTRE ACTUALITE
    </div>
    <div class="col-sm-2">';

    echo '</header>';
}

function setup(){
    echo '
    <!DOCTYPE HTML>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Adrien Crico">
        <link rel="icon" href="images/bugs.ico">
        <title>Site Dynamique</title>
        <meta name="viewport" content="width=device-width">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">    
        <link href="css/styledbooks.css" rel="stylesheet">
    </head>
    ';
    if(!isset($_SESSION['cookie'])){ // Thème du fond par défaut pour tous les utilisateurs
        cookiesOrNot();
    }
}
function pagefooter(){
    echo '
    <footer class="footer jumbotron px-5">
                <div class="row">
                    <div class="d-md-flex justify-content-between">
                        <div class="col-sm-1 d-none d-sm-none d-md-block"> <!--Hidden on small pages-->
                                <a href="https://iut-stmalo.univ-rennes1.fr/">
                                    <img class="mt-5" src="images/RT-St-malo.png" title="R&T" alt="R&T" height="40"/>
                                </a>
                        </div>
                        <div class="col-xl">
                            <div class="copyright border-top text-center m-4 py-3">
                                <address class="text-black-50">Adrien Crico Groupe 1 - <a class="link-dark" href="mailto:adrien.crico@etudiant.univ-rennes1.fr">adrien.crico@etudiant.univ-rennes1.fr</a> - '.date('l jS \of F Y h:i:s A').'</address>
                                <p class="text-black-50">ⓒ2022 IP: '.$_SERVER["REMOTE_ADDR"].' PORT: '.$_SERVER["REMOTE_PORT"].' </p>
                            </div>
                        </div>
                        <div class="col-sm-1 d-none d-sm-none d-md-block"> <!--Hidden on small pages-->
                                <a href="https://iut-stmalo.univ-rennes1.fr/">
                                    <img class="mt-5 mx-4 d-block" src="images/IUT-de-Saint-Malo-logo.png" title="IUT de Saint-Malo" alt="IUT-de-Saint-Malo-logo" width="60" height="50"/>
                                </a>
                            </div>
                    </div>
            </footer>
    ';
}

function pagenavbar($pageactive){

    echo '<nav class="navbar navbar-expand-lg navbar-light bg-secondary bg-opacity-75 bg-gradient">
    <a class="navbar-brand" href="page01.php"><img src="images/RT-St-malo.png" height=50></a>
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">|</button>
    ';
    echo '
        <div class="row">
            <input class="form-control shadow-none col-5 ms-4" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
            <datalist id="datalistOptions">
            <option value="San Francisco">
            <option value="New York">
            <option value="Seattle">
            <option value="Los Angeles">
            <option value="Chicago">
            </datalist>
        </div>
        <div class="col-2 justify-content-end">
        ';
        if(isset($_SESSION['user'])){
            if(isset($_SESSION['role']) && $_SESSION['role']=="visitor"){
                if(isset($_POST["deconnect"])){
                    deconnexion();
                }
                else{
                    echo "
                    <form method='post'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-power mb-3 me-1' viewBox='0 0 16 16'>
                        <path d='M7.5 1v7h1V1h-1z'/>
                        <path d='M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z'/>
                        </svg><button type='submit' name='deconnect' class='btn btn-outline-warning btn-danger btn-sm badge text-wrap'>Deconnexion</a></form><br>";
                        echo '<span class="text-center fst-italic">connected as '.$_SESSION["user"].'</span>';
    
                }
            }
            elseif(isset($_SESSION['role']) && ($_SESSION['role']=="admin" || $_SESSION['role']=="superadmin")){
                if(isset($_POST["deconnect"])){
                    deconnexion();
                }
                else{
                    echo "
                        <form method='post'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-power mb-3 me-1' viewBox='0 0 16 16'>
                        <path d='M7.5 1v7h1V1h-1z'/>
                        <path d='M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z'/>
                        </svg><button type='submit' name='deconnect' class='text-black btn btn-outline-warning btn-danger btn-sm badge text-wrap'>Change account</a></form><br>";
                        echo '<span class="text-center fst-italic">connected as '.$_SESSION["user"].'</span>';
                }
            }
            else{ //in the case of anonymous visitors
                if(isset($_POST["deconnect"])){
                    deconnexion();
                }
                else{
                    echo "
                        <form method='post'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-power mb-1' viewBox='0 0 16 16'>
                        <path d='M7.5 1v7h1V1h-1z'/>
                        <path d='M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z'/>
                        </svg><button type='submit' name='deconnect' class='btn btn-outline-warning btn-danger btn-sm badge text-wrap'>Deconnexion</a></form>";
                }
            }
        }
        else{
            echo "
            <button type='submit' class='btn btn-outline-secondary btn-dark btn-sm badge text-wrap' data-bs-toggle='modal' data-bs-target='#connectModal'>Se connecter</button>";
            if(!isset($_POST['connect'])){
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
                                </form>';
                    echo '
                            </div>
                        </div>
                    </div>
                </div>';
            }
            else{
                $nom = $_POST['user'];
                $mdp = $_POST['mdp'];
                //echo '<pre>';
                //echo password_hash($mdp,PASSWORD_DEFAULT);
                //echo '</pre>';
                if(isset($_POST["remember"])){
                    setcookie('USER_SET_COOKIE', time() + 3600 * 24 * 3); //temps avant fin du cookie
                    //var_dump($_COOKIE);
                }
                // Si un utilisateur lance le site, il n'est plus connecté (session fini)
                // Mais grâce au cookie d'auth, on peut aller rechercher à qui correspond
                // le cookie et relancer la session automatiquement pour l'utilisateur
                connexion($nom, $mdp);
            }
        echo '
        </div>
            '; 
        }
    echo '
        </nav>

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">SIDE BAR</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
        <ul>
            <li class="nav-item">
            <a class="nav-link '.($pageactive == "page01.php" ? navbarItemActive() : navbarItem()).'" href="page01.php">Accueil</a>
        </li>';
        echo '<li class="nav-item">
            <a class="nav-link '.($pageactive == "page02.php" ? navbarItemActive()  : navbarItem()).'" href="page02.php">Formulaires</a>
        </li>';

        echo '<li class="nav-item">
        <a class="nav-link '.($pageactive == "page08.php" ? navbarItemActive() : navbarItem()).'" href="page08.php">Informations</a>
        </li>';
        echo '
        <li class="nav-item">
        <a class="nav-link '.($pageactive == "page05.php" ? navbarItemActive() : navbarItem()).'" href="page05.php">Profil</a>
        </li>';
        if(isset($_SESSION)){
            if(isset($_SESSION['user']) && ($_SESSION['role']=="admin" || $_SESSION["role"] == "superadmin")){
                echo '
                <li class="nav-item">
                <a class="nav-link '.($pageactive == "page06.php" ? "active bg-danger fw-bolder border bg-opacity-50 border-2 border-danger bg-gradient rounded-3 p-3" : navbarItem()).'" href="page06.php">Admin</a>
                </li>';
            }
        }
        echo '
                <li class="nav-item">
                    <a class="nav-link '.($pageactive == "deposer-une-annonce.php" ? navbarItemActive() : navbarItem()).'" href="deposer-une-annonce.php">Déposer votre annonce</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link '.($pageactive == "explorer.php" ? navbarItemActive() : navbarItem()).'" href="explorer.php">Explorer</a>
                </li>
            </ul>
        </div>
    </div>
    ';

}


function navbarItemActive(){
    return 'fw-semibold active border border-2 rounded-3 border-light bg-secondary bg-opacity-50 ps-2 py-3';
}
function navbarItem(){
    return 'border border-2 rounded-3 border-light bg-secondary bg-opacity-25 ps-2 py-1';
}

function showBooks($livres, $found){
    if($livres == []){
        echo '
        <div class="p-2 pt-2 mt-2 text-white">
            No books could be found
        </div>
        ';
        return null;
    }
    if($found==True){
        echo '
        <div class="p-2 pt-2 text-white">
        <a class="display-3 text-black-50">Livres Trouvé(s) : 
        </a><br>';
    }
    else{
        echo '
        <div class="p-2 pt-2">
            <a class="display-3 link-underline-light text-black-50">Livres : </a>';
    }
    echo '
    <table class="table table-hover text-white">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Content</th>
        <th scope="col">Author</th>
        <th scope="col">Date</th>
        </tr>
    </thead>
    <tbody>';

  foreach($livres as $found) {
    echo '<tr class="">
        <th scope="row">';
        echo $found['id'];
        echo '</th><td><a href="" class="fw-bold">';
        echo $found['title'];
        echo '</a></td><td>'; 
        echo $found['content'];
        echo '</td><td><a href="">';
        echo $found['author'];
        echo '</a></td>';
        echo '<td>';
        echo $found['date'];
        echo '</td>
        </tr>';
}
echo '
    </tbody>
    </table>
</div>
';

}

function findBooks($livres, $keyword, $fields=[]){
    echo '
    <div class="d-flex justify-content-center bg-opacity-75 bg-gradient rounded-3 text-white p-2 m-3">
    <h3 class="me-3">Votre recherche : </h3>
        <ul class="mt-2">';
        if(!$keyword == ""){
           echo '<li>"'.$keyword.'"</li>';
        }
        if($fields){
            foreach($fields as $champ) {
                if($champ){
                    if(in_array("auteur",$fields) && $fields["auteur"]==$champ){
                        echo "<li>Recherche par Auteurs</li>";
                    }
                    elseif(in_array("titre",$fields) && $fields["titre"]==$champ){
                        echo "<li>Recherche par Titres</li>";
                    }
                    elseif(in_array("contenu",$fields) && $fields["contenu"]==$champ){
                        echo "<li>Recherche par Contenus</li>";
                    }
                    else{
                        echo "<li>".$champ."</li>";
                    }
                }
            }
        }
        '</ul>
    ';
    echo '</div>
    <a class="btn mt-2 border-dark border-1 bg-dark link-light text-decoration-none" href="">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill me-2 mb-1" viewBox="0 0 16 16">
    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
    </svg>
    Retournez à votre recherche</a>
    ';

    $founded_books = []; //Liste de tous les champs (titres, auteurs etc) trouvés qui sera utilisé pour créer le tableau des resultats
    $filename = './data/booklogs.txt';
 
    if(file_exists($filename))
    {
        unlink($filename); //Réinitialise log.txt
    }
 
    $keyword = explode(" ",$keyword); //Division de chaque mots
    foreach($livres as $book){
        foreach($keyword as $key){
            if(strlen($key) > 3){ // Empèche de traiter les déterminants ou mots trop courts
                //traitement des mots clés
                //Recherche par Auteurs
                if(in_array("auteur", $fields)){
                    if(str_contains(strtolower($book["author"]), strtolower($key))){
                        file_put_contents($filename,'Author found : '.$book["author"]. PHP_EOL, FILE_APPEND);
                        array_push($founded_books, $book);
                    }
                }
                //Recherche par Titres
                elseif(in_array("titre", $fields)){
                    if(str_contains(strtolower($book["title"]), strtolower($key))){  
                        file_put_contents($filename,'Book title found : '.$book["title"]. PHP_EOL, FILE_APPEND);
                        array_push($founded_books, $book);
                    }
                }
                //Recherche par Contenus
                elseif(in_array("contenu", $fields)){
                    if(str_contains(strtolower($book["content"]), strtolower($key))){
                        file_put_contents($filename,"Content found, extracted from : ".$book["title"]. PHP_EOL, FILE_APPEND);
                        file_put_contents($filename,"Content : ".$book["content"]. PHP_EOL, FILE_APPEND);
                        array_push($founded_books, $book);   
                    }
                }
                else{ // Si aucun choix n'a été fait, recherche partout
                    foreach(array_values($book) as $content){
                        if(str_contains(strtolower($content), strtolower($key))){
                            file_put_contents($filename,"Content found : ".$content. PHP_EOL, FILE_APPEND);
                            array_push($founded_books, $book); 
                        }
                    }
                }
            }
            //traitement des dates
            if(array_key_exists("mois", $fields)){
                if(array_key_exists("annee", $fields)){
                    $month = date("m", strtotime($fields["mois"]));
                    $date = $month."/".$fields['annee'];
                    $date = DateTime::createFromFormat('m/Y', $date);
                    $book_date = DateTime::createFromFormat('d/m/Y', $book['date']); // Création de format date afin de pouvoir filtrer par la suite
                    //Tests
                    //echo $date->format('m/Y');
                    //echo "<br>";
                    echo $book_date->format('m/Y');
                    echo "<br>";

                    if($date->format('m/Y') == $book_date->format('m/Y')) {
                        file_put_contents($filename,"The date : ".$date->format('m/Y').", matches with : ".$book["title"]. PHP_EOL, FILE_APPEND);
                        array_push($founded_books, $book);
                    }
                    elseif($date->format('Y') == $book_date->format('Y')) {
                        if($date->format('m') < $book_date->format('m')){
                            file_put_contents($filename,"".$book["title"]." published the ".$book["date"].", was published month(s) after : ".$date->format('m/Y'). PHP_EOL, FILE_APPEND);
                            array_push($founded_books, $book);
                        }
                        else{
                            file_put_contents($filename,"".$book["title"]." published the ".$book["date"].", was published month(s) before : ".$date->format('m/Y'). PHP_EOL, FILE_APPEND);
                        }
                    }
                    elseif($date->format('Y') < $book_date->format('Y')) {
                        file_put_contents($filename,"The date : ".$date->format('m/Y').", is lower than : ".$book["title"]." published the ".$book["date"]. PHP_EOL, FILE_APPEND);
                        array_push($founded_books, $book);
                    }
                }
                else{
                    echo '
                        </div><div class="text-center text-danger fw-bold mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle mb-1" viewBox="0 0 16 16">
                        <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                        <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                        </svg> Vous n\'avez entrez que l\'option : "mois"</div>';
                        pagefooter();
                        die();
                }
            }
            elseif(array_key_exists("annee", $fields)){
                $date = $fields['annee'];
                $book_date = explode("/",$book["date"]);
                if ($date <= $book_date[2]) {
                    file_put_contents($filename, "Year : ".$date.", is lower or equals with : ".$book["title"]." published the ".$book["date"]. PHP_EOL, FILE_APPEND);
                    array_push($founded_books, $book);
                }
            }
        }
    }
    foreach($founded_books as $key => $founded){
        if (array_search($founded, $founded_books) !== $key) {
            unset($founded_books[$key]);
          }
    }
    showBooks($founded_books, $found=True);
    echo '</div>';
}

function newUsers(){
    //fichier json contenant 4 premiers users
    $default_users = array(
        "bagel" => array(
            "user"=> "bagel",
            "mdp"=> "$2y$10\$Nf2pZndPyVGVg9ZgM3m8mOEDqStoyijjTZdFk7rBme1egCF8pKLZq",
            "role"=> "superadmin"),
        "user" => array(
            "user" => "user",
            "mdp" => "$2y$10\$g3HpUec5Idvak/9RVCKFhuppOpGOmRWoCYiAQVKfJk8rgaxrG/G5W",
            "role" => "user"),
        "anonymous" => array(
            "user" => "anonymous",
            "mdp" => "$2y$10$2iN\/YTDup6GDioGs4PJV3uhffURT8ZQSGpvTP4xWFVMVkBJntTdOq",
            "role" => "visitor",
            "favoris"=>[], //Liste des ids d'annonces misent en favoris (censé être illimité)
        ),
        "admin" => array(
            "user" => "admin",
            "mdp" => "$2y$10\$pxQCauEXDSIRncE17E6W.eQidzMH8kxHVBiAR9jF7vKwcomC4sXhu",
            "role" => "admin"),
        "Jean-Paul"=> array(
            "user"=> "Jean-Paul",
            "mdp"=> "$2y$10\$zeycWYo5FUC.CLriKeaOV.t5pNkxd.7hFwkcUbJxOdzrnA40SI\/d.",
            "role"=> "visitor")
        );
    echo '
        <div class="d-flex justify-content-center container col-10 my-4 border border-3 p-5">
    
        <pre>';
    $res = json_encode($default_users, JSON_PRETTY_PRINT);
    file_put_contents("./data/users.json", $res);
    echo '
        </pre>
        </div>';
}
function addUser($usr, $mdp, $role="user"){
     // encode sans avoir decoder => ecrase le fichier déja present
     $users = json_decode(file_get_contents("data/users.json", true), true);
     // Création liste de données utilisateur
     foreach($users as $user){
        if($user["user"] == $usr){
            echo '
            </div><div class="text-center text-danger fw-bold mb-4 mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle mb-1" viewBox="0 0 16 16">
            <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
            </svg>This username is already taken    <br/>
            <a type="button" class="btn text-center border border-black mt-3" href="page06.php">reload page</a></div>';
            pagefooter();
            die();
        }
    }
     $newUser = array(
     'user' => $usr,
     'mdp'=> password_hash($mdp, PASSWORD_DEFAULT),
     'role' => $role,
    );
     $users[$newUser["user"]] = $newUser;
     $res=json_encode($users, JSON_PRETTY_PRINT);
     file_put_contents("./data/users.json",$res); //résultat dans users.json
     header("Refresh:0");
     die();
}

function deleteUser($usr){
    //echo "user : ".$usr['user']." will be deleted soon";
    //echo "<br>";
    $users = json_decode(file_get_contents('data/users.json', true), true);
    foreach($users as $key => $user) {
        //echo "checking ".$user["user"];
        //echo "<br>";
        if($user["user"] == $usr["user"] && $user['role'] != "admin" && $user['role'] != "superadmin") {
            echo $user['user']." isn't admin and will be deleted <br/>";
            unset($users[$key]);
        }
        elseif($user["user"] == $usr["user"] && $_SESSION['role'] == "superadmin"){
            unset($users[$key]);
        }
    }
    file_put_contents("data/users.json", json_encode($users, JSON_PRETTY_PRINT));
    header("Refresh:0");
}
function deconnexion(){
    echo '<script>console.log("Deconnexion en cours")</script>';
    $_SESSION = [];
    session_unset();
    session_destroy();
    header("Location: page01.php");
}
function connexion($nom, $mdp){
    $founded=false;
    $database = json_decode(file_get_contents('data/users.json', true), true);
    foreach($database as $user){
        if($user["user"] == $nom && password_verify($mdp, $user["mdp"])){
            $_SESSION['user'] = $user["user"];
            $_SESSION['mdp'] = $user["mdp"];
            $_SESSION['role'] = $user["role"];
            $_SESSION["favcolor"] = "#ffffff";
            echo "<script>console.log('Connexion validée');</script>";
            $founded=true;
        }
    }
    if($founded==false){
        echo "<script>console.log('Identifiants non reconnus')</script>";
    }
    header("Refresh:0");
    //json files don't support comments
    // my admin pass is admin
    // user=user and anonymous = ano
}
function getUsers($database){
    if(!isset($database)){
        $path ="data/users.json";
        $users = json_decode(file_get_contents($path, true), true);
        echo '
        <div class="container mb-1 col-10">
            <span class="align-middle">Nombre d\'utilisateurs : '.count($users).'</span>
        </div>
        <div class="container pb-4 pt-3 px-2 text-white border-black border-2 rounded-2 bg-black bg-gradient col-10">
            <h3 class="mt-4 mx-1">Les Utilisateurs correspondants : </h3>
            recherche de tous les utilisateurs : '.count($users).' résultats trouvés
                <div class="d-flex justify-content-center pb-4 pt-3 px-3 ms-5">
                    <table class="table text-white-50 table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Utilisateur</th>
                                <th scope="col">Mot de passe</th>
                                <th scope="col">Rôle</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach($users as $user){ 
        //hidden inputs so that I can retrieve which button was clicked
            echo '
                <tr>
                <th scope="row">'.$user["user"].'</th>
                <td>'.
                $user['mdp'].'</td>
                <td>'.
                $user['role'].'</td>
                <td style="border: none"><form method="post">
                    <input type="hidden" name="username" value="'.$user['user'].'">
                    <input type="hidden" name="usermdp" value="'.$user['mdp'].'">
                    <input type="submit" name="delete_usr" class="btn btn-sm btn-danger text-decoration-none" value="X">
                </form></td>
                </tr>
            ';
        }
    }
    else{
        echo '
        <div class="container mb-1 col-10">
            <span class="align-middle">Nombre d\'utilisateurs : '.count($database).'</span>
        </div>
        <div class="container pb-4 pt-3 px-2 text-white border-black border-2 rounded-2 bg-black bg-gradient col-10">
            <h3 class="mt-4 mx-1">Les Utilisateurs correspondants : </h3>
            recherche de tous les utilisateurs : '.count($database).' résultats trouvés
                <div class="d-flex justify-content-center pb-4 pt-3 px-3 ms-5">
                    <table class="table text-white-50 table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Utilisateur</th>
                                <th scope="col">Mot de passe</th>
                                <th scope="col">Rôle</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach($database as $user){
            echo '
            <tr>
            <th scope="row">'.$user['user'].'</th>
            <td>'.
            $user['mdp'].'</td>
            <td>'.
            $user['role'].'</td>
            <td style="border: none"><form method="post">
                <input type="hidden" name="username" value="'.$user['user'].'">
                <input type="hidden" name="usermdp" value="'.$user['mdp'].'">
                <input type="submit" name="delete_usr" class="btn btn-sm btn-danger text-decoration-none" value="X">
            </form></td>
            </tr>
        ';
        }
    }
}

function findUsers($text){
    $founded_users=[];
    $text = htmlspecialchars(strtolower($text));
    $users = json_decode(file_get_contents("data/users.json", true), true);
    $text = explode(" ", $text);
    foreach ($text as $key) {
        foreach($users as $user){
            if(str_contains(strtolower($user["user"]), $key)){
                array_push($founded_users, $user);
            }
        }
    }
    foreach($founded_users as $key => $founded){
        if (array_search($founded, $founded_users) !== $key) {
            unset($founded_users[$key]);
          }
    }
    getUsers($founded_users);
}

function modifyUser($user, $new_usr, $mdp, $role, $favcolor){
    $users = json_decode(file_get_contents("data/users.json", true), true);
    if($mdp == False){
        echo "changement de nom seulement <br>";
        $usr = $new_usr;
        $mdp = $users[$user]['mdp'];
        $_SESSION['user'] = $usr;
        $_SESSION['favcolor'] = $favcolor;
        $new_usr = array(
            'user' => $usr,
            'mdp' => $mdp,
            'role'=> $role
        );
        foreach($users as $thisone){
            if($thisone["user"]==$user){
                deleteUser($thisone); //On repère l'ancienne entrée d'utilisateur et on le supprime
            }
        }
        $users[$new_usr['user']] = $new_usr; //  $users['User1'] = {'user':'User1','mdp':$10$,'role':'user'}
        unset($users[$user]);
        $res=json_encode($users, JSON_PRETTY_PRINT);
        echo $res;
        file_put_contents("./data/users.json",$res); //résultat dans users.json
    }
    elseif($new_usr == False){
        $_SESSION['favcolor'] = $favcolor;
        echo "changement de mdp seulement <br>";
        $usr = $users[$user]['user'];
        $new_usr = array(
            'user' => $usr,
            'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
            'role'=> $role
        );
        $users[$new_usr['user']] = $new_usr; //  $users['User1'] = {'user':'User1','mdp':$10$,'role':'user'}
        $res=json_encode($users, JSON_PRETTY_PRINT);
        file_put_contents("./data/users.json",$res); //résultat dans users.json
        header("Refresh:0");
    }
    else{
        echo 'changement de nom et mdp';
        $_SESSION['user'] = $new_usr;
        $_SESSION['favcolor'] = $favcolor;
        deleteUser($users[$user]);
        addUser($new_usr, $mdp, $role);
        $_SESSION['mdp'] = ($users[$new_usr]['mdp']);
        $res=json_encode($users, JSON_PRETTY_PRINT);
        file_put_contents("./data/users.json",$res); //résultat dans users.json
    }
    
}

function cookiesOrNot(){
    //Cookie popup devrait apparaitre qu'une seule fois dans une session utilisateur
    //
     if(!isset($_POST["cookie_popup"])){
        echo '
        <div class="d-flex justify-content-end position-fixed bottom-0 end-0 mb-4 m-2 d-none d-sm-none d-md-block" id="toaster">
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
