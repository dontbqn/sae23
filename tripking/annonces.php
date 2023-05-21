<?php
function newAnnonce(){
    //fichier json contenant les premieres annonces
    $default_users = array(
        /*
        "01": {
        "id": 01,
        "titre": "Barcelone T4 vue sur Mer Thalasso",
		"lieu": "Barcelone",
        "pays": "Espagne",
        "prix_nuit": 27,
		"nb_fav":2, 
		"bon_plan":True, //booléen
		"commentaires":[c01,]
    },
    */
        "01" => array(
            "id"=> 01,
            "titre"=> "Barcelone T4 vue sur Mer Thalasso",
            "lieu" => "Barcelone",
            "pays" => "Espagne",
            "prix_nuit"=> 27,
            "nb_fav" => 2,
            "bon_plan" => False,
            "commentaires" => array("c01","c02","c56"),
            "images" => array(
                "./annonces/01/img1.jpg",
                "./annonces/01/img2.jpg"
            )
            ),
        "02" => array(
            "id"=> 02,
            "titre"=> "Saint-Malo Studio Saisonnier",
            "lieu" => "Saint-Malo",
            "pays" => "France",
            "prix_nuit"=> 15,
            "nb_fav" => 0,
            "bon_plan" => True,
            "commentaires" => array("c05","c07","c17"),
            "images" => array(
                "./annonces/02/img1.jpg",
                "./annonces/02/img2.jpg"
            )
            )
            );
    $res = json_encode($default_users, JSON_PRETTY_PRINT);
    file_put_contents("./annonces/annonces.json", $res);
    echo '
        <div class="d-flex justify-content-center">

            <pre>
            '.print_r($res).'
            </pre>
        </div>';
}
function showAnnonces($annonces, $found){
    if($annonces == []){
        echo '
        <div class="p-2 pt-2 mt-2 text-white">
            Aucune annonce correspondante
        </div>
        ';
        return null;
    }
    if($found==True){
        echo '
        <div class="p-2 pt-2 text-white">
        <a class="display-3 text-black-50">Annonces Trouvé(s) : 
        </a><br>';
    }
    else{
        echo '
        <div class="p-2 pt-2">
            <a class="display-3 link-underline-light text-black-50">Annonces : </a>';
    }
    echo '
    <table class="table text-white">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Titre</th>
        <th scope="col">Lieu</th>
        <th scope="col">Pays</th>
        <th scope="col">1 Nuit</th>
        <th scope="col">Favs</th>
        <th scope="col">Bon Plan</th>
        </tr>
    </thead>
    <tbody>';

  foreach($annonces as $found) {
    echo '<tr class="">
        <th scope="row">';
        echo $found['id'];
        echo '</th><td><a href="" class="fw-bold">';
        echo $found['titre'];
        echo '</a></td><td>'; 
        echo $found['lieu'];
        echo '</td><td>
        <a href="">';
        echo $found['pays'];
        echo '</a>
        </td>';
        echo '<td>';
        echo $found['prix_nuit'];
        echo '</td>';
        echo '<td>';
        echo $found['nb_fav'];
        echo '</td>';
        echo '<td>';
        echo $found['bon_plan'];
        echo '</td>';
        echo '<td><img src="'.$found['images'][0].'" class="img-fluid border border-1 border-light" width="100" height="100" alt="Preview"/>';
        echo '</td>
        </tr>';
}
echo '
    </tbody>
    </table>
</div>
';

}
function addAnnonce($usr, $mdp){
     // encode sans avoir decoder => ecrase le fichier déja present
     $annonces = json_decode(file_get_contents("annonces/annonces.json", true), true);
     // Création liste de données utilisateur
     foreach($annonces as $annonce){
        if($annonce["annonce"] == $usr){
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
     $newAnnonces = array(
     "id"=> 01,
     "titre"=> "Barcelone T4 vue sur Mer Thalasso",
     "lieu" => "Barcelone",
     "pays" => "Espagne",
     "prix_nuit"=> 27,
     "nb_fav" => 2,
     "bon_plan" => False,
     "commentaires" => array(),
     "images" => array(
         "./annonces/01/img1.jpg",
         "./annonces/01/img2.jpg"
     ),
    );
     $annonces[$newAnnonces["annonce"]] = $newAnnonces;
     $res=json_encode($annonces, JSON_PRETTY_PRINT);
     file_put_contents("./annonces/annonces.json",$res); //résultat dans annonces.json
     //header("Refresh:0");
     //die();
}

function deleteAnnonce($usr){
    //echo "annonce : ".$usr['annonce']." will be deleted soon";
    //echo "<br>";
    $annonces = json_decode(file_get_contents('annonce/annonces.json', true), true);
    foreach($annonces as $key => $annonce) {
        //echo "checking ".$annonce["annonce"];
        //echo "<br>";
        if($annonce["annonce"] == $usr["annonce"] && $annonce['role'] != "admin" && $annonce['role'] != "superadmin") {
            echo $annonce['annonce']." isn't admin and will be deleted <br/>";
            unset($annonces[$key]);
        }
        elseif($annonce["annonce"] == $usr["annonce"] && $_SESSION['role'] == "superadmin"){
            unset($annonces[$key]);
        }
    }
    file_put_contents("annonces/annonces.json", json_encode($annonces, JSON_PRETTY_PRINT));
    header("Refresh:0");
}
function getAnnonces($annoncesbase){
    if(!isset($annoncesbase)){
        $path ="annonces/annonces.json";
        $annonces = json_decode(file_get_contents($path, true), true);
        echo '
        <div class="container mb-1 col-10">
            <span class="align-middle">Nombre d\'utilisateurs : '.count($annonces).'</span>
        </div>
        <div class="container pb-4 pt-3 px-2 text-white border-black border-2 rounded-2 bg-black bg-gradient col-10">
            <h3 class="mt-4 mx-1">Les Utilisateurs correspondants : </h3>
            recherche de toutes les annnonces : '.count($annonces).' résultats trouvés
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
        foreach($annonces as $annonce){ 
        //hidden inputs so that I can retrieve which button was clicked
            echo '
                <tr>
                <th scope="row">'.$annonce["annonce"].'</th>
                <td>'.
                $annonce['mdp'].'</td>
                <td>'.
                $annonce['role'].'</td>
                <td style="border: none"><form method="post">
                    <input type="hidden" name="username" value="'.$annonce['annonce'].'">
                    <input type="hidden" name="usermdp" value="'.$annonce['mdp'].'">
                    <input type="submit" name="delete_usr" class="btn btn-sm btn-danger text-decoration-none" value="X">
                </form></td>
                </tr>
            ';
        }
    }
    else{
        echo '
        <div class="container mb-1 col-10">
            <span class="align-middle">Nombre d\'utilisateurs : '.count($annoncesbase).'</span>
        </div>
        <div class="container pb-4 pt-3 px-2 text-white border-black border-2 rounded-2 bg-black bg-gradient col-10">
            <h3 class="mt-4 mx-1">Les Utilisateurs correspondants : </h3>
            recherche de tous les utilisateurs : '.count($annoncesbase).' résultats trouvés
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
        foreach($annoncesbase as $annonce){
            echo '
            <tr>
            <th scope="row">'.$annonce['id'].'</th>
            <td>'.
            $annonce['title'].'</td>
            <td>'.
            $annonce['lieu'].'</td>
            <td style="border: none"><form method="post">
                <input type="hidden" name="username" value="'.$annonce['annonce'].'">
                <input type="hidden" name="usermdp" value="'.$annonce['mdp'].'">
                <input type="submit" name="delete_usr" class="btn btn-sm btn-danger text-decoration-none" value="X">
            </form></td>
            </tr>
        ';
        }
    }
}

function findAnnonces($text){
    $founded_annonces=[];
    $text = htmlspecialchars(strtolower($text));
    $annonces = json_decode(file_get_contents("./annonces/annonces.json", true), true);
    $text = explode(" ", $text);
    foreach ($text as $key) {
        foreach($annonces as $annonce){
            if(str_contains(strtolower($annonce["annonce"]), $key)){
                array_push($founded_annonces, $annonce);
            }
        }
    }
    foreach($founded_annonces as $key => $founded){
        if (array_search($founded, $founded_annonces) !== $key) {
            unset($founded_users[$key]);
          }
    }
    getAnnonces($founded_annonces);
}



//Modification apportées à l'annonce après sa publication
function modifyAnnnonce($annonce, $new_usr, $mdp, $role, $favcolor){
    $annonces = json_decode(file_get_contents("./annonces/annonces.json", true), true);
    if($mdp == False){
        echo "changement de nom seulement <br>";
        $usr = $new_usr;
        $mdp = $annonces[$annonce]['mdp'];
        $_SESSION['annonce'] = $usr;
        $_SESSION['favcolor'] = $favcolor;
        $new_usr = array(
            'annonce' => $usr,
            'mdp' => $mdp,
            'role'=> $role
        );
        foreach($annonces as $thisone){
            if($thisone["annonce"]==$annonce){
                deleteUser($thisone); //On repère l'ancienne entrée d'utilisateur et on le supprime
            }
        }
        $annonces[$new_usr['annonce']] = $new_usr; //  $annonces['User1'] = {'annonce':'User1','mdp':$10$,'role':'annonce'}
        unset($annonces[$annonce]);
        $res=json_encode($annonces, JSON_PRETTY_PRINT);
        echo $res;
        file_put_contents("./annonces/annonces.json",$res); //résultat dans annonces.json
    }
    elseif($new_usr == False){
        $_SESSION['favcolor'] = $favcolor;
        echo "changement de mdp seulement <br>";
        $usr = $annonces[$annonce]['annonce'];
        $new_usr = array(
            'annonce' => $usr,
            'mdp' => password_hash($mdp, PASSWORD_DEFAULT),
            'role'=> $role
        );
        $annonces[$new_usr['annonce']] = $new_usr; //  $annonces['User1'] = {'annonce':'User1','mdp':$10$,'role':'annonce'}
        $res=json_encode($annonces, JSON_PRETTY_PRINT);
        file_put_contents("./annonces/annonces.json",$res); //résultat dans annonces.json
        header("Refresh:0");
    }
    else{
        echo 'changement de nom et mdp';
        $_SESSION['annonce'] = $new_usr;
        $_SESSION['favcolor'] = $favcolor;
        deleteUser($annonces[$annonce]);
        addAnnonce();
        $_SESSION['mdp'] = ($annonces[$new_usr]['mdp']);
        $res=json_encode($annonces, JSON_PRETTY_PRINT);
        file_put_contents("./annonces/annonces.json",$res); //résultat dans annonces.json
    }
    
}
?>
