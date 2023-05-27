<?php


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
                        footer();
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
            footer();
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
    // setting the expiration date to an hour ago to delete cookies
    if($_SESSION["remember"]=!true){ 
        setcookie("LOGGED_USER", "", time() - 3600); // On supprime cookies user/mdp si $session remember n'est pas initialisé
        setcookie("MOTDEPASSE", "", time() - 3600);
    }
    session_unset();
    session_destroy();
    header("Location: page01.php");
}
function connexion($nom, $mdp, $remember=false){
    $founded=false;
    $database = json_decode(file_get_contents('data/users.json', true), true);
    foreach($database as $user){
        if($user["user"] == $nom && password_verify($mdp, $user["mdp"])){
            $_SESSION['user'] = $user["user"];
            $_SESSION['mdp'] = $user["mdp"];
            $_SESSION['role'] = $user["role"];
            $_SESSION["remember"] = true;
            $founded=true;
            if($remember==true){
                setcookie(
                    'LOGGED_USER',
                    $nom,
                    [
                        'expires' => time() + 3*24*3600, // 3 jours avant expiration du cookie
                        'secure' => true,
                        'httponly' => true,
                    ]
                );
                setcookie(
                    'MOTDEPASSE',
                    password_hash($mdp, PASSWORD_DEFAULT),
                    [
                        'expires' => time() + 3*24*3600, // 3 jours avant expiration du cookie
                        'secure' => true,
                        'httponly' => true,
                    ]
                );
            }
        }
    }
    if($founded==false){
        echo "<script>console.log('Identifiants non reconnus')</script>";
    }
    header("Refresh:0");
    //json files don't support comments
}

function getUsers($database){
    if(!isset($database)){
        $path ="data/users.json";
        $users = json_decode(file_get_contents($path, true), true);
        echo '
        <div class="container mb-1 col-10" id="utilisateurs">
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
                    <button type="submit" name="delete_usr" class="btn btn-sm btn-danger text-decoration-none" value=""><img src="images/delete.png" class="" width="20" height="20"></button>
                    </form></td>
                </tr>
            ';
        }
    }
    else{
        echo '
        <div class="container mb-1 col-10" id="utilisateurs">
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
                <button type="submit" name="delete_usr" class="btn btn-sm btn-danger text-decoration-none" value=""><img src="images/delete.png" class="" width="20" height="20"></button>
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

?>
