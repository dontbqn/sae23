<?php
function newUsers(){
    //fichier json contenant 4 premiers users
    $default_users = array(
        "bagel" => array(
            "user"=> "bagel",
            "mdp"=> "$2y$10\$Nf2pZndPyVGVg9ZgM3m8mOEDqStoyijjTZdFk7rBme1egCF8pKLZq",
            "role"=> "superadmin",
            "favoris"=>array("1","4","6")            
        ),
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
        setcookie("LOGGED_USER", "", time() - 3600); // On supprime cookies user/mdp si $session remember n'est pas initiasé
        setcookie("MOTDEPASSE", "", time() - 3600);
    }
    session_unset();
    session_destroy();
    header("Location: page01.php");
}
function connexion($nom, $mdp, $remember=false){
    $founded=false;
    $path ="data/users.json";
    $users = json_decode(file_get_contents($path), true);
    foreach($users as $user){
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
                    <input type="hidden" name="usermdp" value="'.$user['mdp'].'">';
                    if(isset($_SESSION['role']) && ($_SESSION['role']=="admin" || $_SESSION['role']=="superadmin") && (strpos($_SERVER['REQUEST_URI'], "entreprise") === false)){
                        echo '
                        <button type="submit" name="delete_usr" class="btn btn-sm btn-danger text-decoration-none" value=""><img src="images/delete.png" class="" width="20" height="20"></button>
                        ';
                    }
                    echo '
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
                <input type="hidden" name="usermdp" value="'.$user['mdp'].'">';
                if(isset($_SESSION['role']) && ($_SESSION['role']=="admin" || $_SESSION['role']=="superadmin") && (strpos($_SERVER['REQUEST_URI'], "entreprise") === true)){
                    echo $_SERVER['REQUEST_URI'].'
                    <button type="submit" name="delete_usr" class="btn btn-sm btn-danger text-decoration-none" value=""><img src="images/delete.png" class="" width="20" height="20"></button>
                    ';
                }
                echo '
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


function addpartenaire($name, $description, $users, $logo, $lien){
     // encode sans avoir decoder => ecrase le fichier déja present
     $partenaire = json_decode(file_get_contents("data/partenaires.json", true), true);
     // Création liste de données utilisateur
     
     foreach($partenaire as $element){
        if($element["name"] == $name){
            echo '
            </div><div class="text-center text-danger fw-bold mb-4 mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle mb-1" viewBox="0 0 16 16">
            <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
            </svg>This parten is already taken    <br/>
            <a type="button" class="btn text-center border border-black mt-3" href="page06.php">reload page</a></div>';
            footer();
            die();
        }
    }
     $partenaire[$name] = array(
     'name' => $name,
     'description'=> $description,
     'users' => $users,
     'logo' => $logo,
     'lien' => $lien
    );
    
     $res=json_encode($partenaire, JSON_PRETTY_PRINT);
     file_put_contents("./data/partenaires.json",$res); //résultat dans users.json
     header("Refresh:0");
     die();
}


function deletepartenaire($nom){

    $partenaires = json_decode(file_get_contents('data/partenaires.json', true), true);
    if(isset($partenaires[$nom])){
    unset($partenaires[$nom]);
    }
    file_put_contents("data/partenaires.json", json_encode($partenaires, JSON_PRETTY_PRINT));
    header("Refresh:0");
}

?>
