<?php
function newAnnonce(){
    //fichier json contenant les premieres annonces
    $default_users = array(
        /*
        "1": {
        "id": 1,
        "titre": "Barcelone T4 vue sur Mer Thalasso",
		"lieu": "Barcelone",
        "pays": "Espagne",
        "prix_nuit": 27,
		"nb_fav":2, 
		"bon_plan":True, //booléen
		"commentaires":[c01,]
    },
    */
        "1" => array(
            "id"=> 1,
            "titre"=> "Barcelone T4 vue sur Mer Thalasso",
            "lieu" => "Barcelone",
            "pays" => "Espagne",
            "prix_nuit"=> 27,
            "nb_fav" => 2,
            "bon_plan" => False,
            "commentaires" => array("c01","c02","c56"),
            "images" => array(
                "./annonces/1/img1.jpg",
                "./annonces/1/img2.jpg"
            )
            ),
        "2" => array(
            "id"=> 2,
            "titre"=> "Saint-Malo Studio Saisonnier",
            "lieu" => "Saint-Malo",
            "pays" => "France",
            "prix_nuit"=> 15,
            "nb_fav" => 0,
            "bon_plan" => True,
            "commentaires" => array("c04","c07","c17"),
            "images" => array(
                "./annonces/2/img1.jpg",
                "./annonces/2/img2.jpg"
            )
            )
            );
    $res = json_encode($default_users, JSON_PRETTY_PRINT);
    file_put_contents("./annonces/annonces.json", $res);
}
function showAnnonces($annonces, $found){
    if($annonces == []){
        echo '
        <div class="p-2 pt-2 mt-2">
            Aucune annonce correspondante.
        </div>
        ';
        return null;
    }
    if($found==True){
        echo '
        <div class="p-2 pt-2">
        <hr class="display-3 col-4 bg-dark">
        ';
    }
    else{
        echo '
            <div class="p-2 pt-2">
            <hr class="display-3 col-4 bg-dark">
        ';
    }

    echo '
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Titre</th>
        <th scope="col">Lieu</th>
        <th scope="col">Pays</th>
        <th scope="col">1 Nuit</th>
        <th scope="col">&#128159;</th>
        <th scope="col">Bon Plan &#128293;</th>
        </tr>
    </thead>
    <tbody>';

  foreach($annonces as $found) {
    echo '<tr class="">
        <th scope="row">';
        echo $found['id'];
        echo '</th><td><a href="page_annonce.php?id='.$found['id'].'" class="text-dark">';
        echo $found['titre'];
        echo '</a></td><td>'; 
        echo $found['lieu'];
        echo '</td><td>
        <a class="text-dark" href="">';
        echo $found['pays'];
        echo '</a>
        </td>';
        echo '<td>';
        echo $found['prix_nuit'];
        echo '€</td>';
        echo '<td>';
        echo $found['nb_fav'];
        echo '</td>';
        echo '<td>';
        echo $found['bon_plan'] == True ? "&#10003;" : "&#9932;";
        echo '</td>';        
        echo '<td><a href="" title="voir l\'annonce"><img src="'.$found['images'][0].'" class="img-fluid border border-1 border-light" width="100" height="100" alt="Annonce Preview"/></a>';
        echo '</td>
        </tr>';
}
echo '
    </tbody>
    </table>
</div>
';

}
function addAnnonce($titre, $lieu, $pays, $prixnuit, $bon_plan){
     // encode sans avoir decoder => ecrase le fichier déja present
     $annonces = json_decode(file_get_contents("annonces/annonces.json", true), true);
     //
     $compteur = 1;
     foreach($annonces as $annonce){
        if($annonce["titre"] == $titre){
            echo '
            </div><div class="text-center text-danger fw-bold mb-4 mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle mb-1" viewBox="0 0 16 16">
            <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
            </svg>Ce titre existe déjà !    <br/>
            <a type="button" class="btn text-center border border-black mt-3" href="deposer-une-annonce.php">reload page</a></div>';
            footer();
            die();
        }
        if($annonce["id"] >= $compteur){
            $compteur = $annonce["id"];
        }
    }
    // Création liste de données annonces
     $newAnnonces = array(
     "id"=> $compteur+1,
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

function deleteAnnonce($ann){
    //echo "annonce : ".$usr['annonce']." will be deleted soon";
    //echo "<br>";
    $annonces = json_decode(file_get_contents('annonce/annonces.json', true), true);
    foreach($annonces as $key => $annonce) {
        //echo "checking ".$annonce["id"];
        //echo "<br>";
        if($annonce["id"] == $ann["id"] && ($_SESSION['role'] == "superadmin" || $_SESSION['role'] == "admin")){
            unset($annonces[$key]);
        }
    }
    file_put_contents("annonces/annonces.json", json_encode($annonces, JSON_PRETTY_PRINT));
    header("Refresh:0");
}
function getAnnonces($annoncesbase){
    if(!isset($annoncesbase)){
        $path ="./annonces/annonces.json";
        $annonces = json_decode(file_get_contents($path, true), true);
        echo '
        <div class="container mb-1" id="annonces">
            <span class="align-middle">Nombre d\'annonces : '.count($annonces).'</span>
        </div>
        <div class="container pb-4 pt-3 text-white border-black border-2 rounded-2 bg-black bg-gradient bg-opacity-50 my-3">
            <h3 class="mt-4 mx-1">Les Annonces correspondantes : </h3>
            recherche de toute les annonces : '.count($annonces).' résultats trouvés
                <div class="d-flex justify-content-center pb-4 pt-3 px-3 ms-5">
                    <table class="table text-white-50">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Annonce</th>
                                <th scope="col">Lieu</th>
                                <th scope="col">Pays</th>
                                <th scope="col">Prix nuit</th>
                                <th scope="col">Favs</th>
                                <th scope="col">Bon Plan</th>
                                <th scope="col">Images</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach($annonces as $annonce){ 
            //hidden inputs so that I can retrieve which button was clicked
            echo '<tr>
            <th scope="row">';
            echo $annonce['id'];
            echo '</th><td><a href="" class="link-light">';
            echo $annonce['titre'];
            echo '</a></td><td>'; 
            echo $annonce['lieu'];
            echo '</td><td>';
            echo $annonce['pays'];
            echo '</td>';
            echo '<td>';
            echo $annonce['prix_nuit'];
            echo '€</td>';
            echo '<td>';
            echo $annonce['nb_fav'];
            echo '</td>';
            echo '<td>';
            echo $annonce['bon_plan'] == True ? "&#10003;" : "&#9932;";
            echo '</td>';        
            echo '<td><a class="link-light" href="./annonces/'.$annonce['id'].'/">voir les images</a>';
            echo '</td>
            </tr>';
            echo '
                <td style="border: none"><form method="post">
                    <input type="hidden" name="id" value="'.$annonce['id'].'">
                    <button type="submit" name="delete_annonce" class="btn btn-sm btn-danger text-decoration-none" value=""><img src="images/foryou.png" class="" width="30" height="30"></button>
                </form></td>
                </tr>
            ';
        }
    }
    else{
        echo '
        <div class="container mb-1" id="annonces">
            <span class="align-middle">Nombre d\'annonces : '.count($annoncesbase).'</span>
        </div>
        <div class="container pb-4 pt-3 text-white border-black border-2 rounded-2 bg-black bg-gradient bg-opacity-50 my-3">
            <h3 class="mt-4 mx-1">Les Annonces correspondantes : </h3>
            recherche de toutes les annonces : '.count($annoncesbase).' résultats trouvés
                <div class="d-flex justify-content-center pb-4 pt-3 px-3 ms-5">
                    <table class="table text-white-50">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Annonce</th>
                            <th scope="col">Lieu</th>
                            <th scope="col">Pays</th>
                            <th scope="col">Prix nuit</th>
                            <th scope="col">Favs</th>
                            <th scope="col">Bon Plan</th>
                            <th scope="col">Images</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach($annoncesbase as $annonce){
            echo '<tr>
            <th scope="row">';
            echo $annonce['id'];
            echo '</th><td><a href="" class="link-light">';
            echo $annonce['titre'];
            echo '</a></td><td>'; 
            echo $annonce['lieu'];
            echo '</td><td>';
            echo $annonce['pays'];
            echo '</td>';
            echo '<td>';
            echo $annonce['prix_nuit'];
            echo '€</td>';
            echo '<td>';
            echo $annonce['nb_fav'];
            echo '</td>';
            echo '<td>';
            echo $annonce['bon_plan'] == True ? "&#10003;" : "&#9932;";
            echo '</td>';    
            //page d'images ??    
            echo '<td><a class="link-light" href="./annonces/'.$annonce['id'].'/">voir les images</a>';
            //<a href="" title="voir l\'annonce"><img src="'.$annonce['images'][0].'" class="img-fluid border border-1 border-light" width="100" height="100" alt="Annonce Preview"/>
            echo '</td>';
            echo '
                <td style="border: none"><form method="post">
                    <input type="hidden" name="id" value="'.$annonce['id'].'">
                    <button type="submit" name="delete_annonce" class="btn btn-sm btn-danger text-decoration-none" value=""><img src="images/delete.png" class="" width="20" height="20"></button>
                </form></td>
                </tr>
            ';
        }
    }
    echo '
        </tbody>
            </table>
                </div>
                    </div>
    ';
}

function findAnnonces($text){
    $founded_annonces=[];
    $text = htmlspecialchars(strtolower($text));
    $annonces = json_decode(file_get_contents("./annonces/annonces.json", true), true);
    $text = explode(" ", $text);
    foreach ($text as $key) {
        foreach($annonces as $annonce){
            if(str_contains(strtolower($annonce["titre"]), $key)){
                array_push($founded_annonces, $annonce);
            }
        }
    }
    foreach($founded_annonces as $key => $founded){
        if (array_search($founded, $founded_annonces) !== $key) {
            unset($founded_annonces[$key]);
          }
    }
    getAnnonces($founded_annonces);
}



//Modification apportées à l'annonce après sa publication
function modifyAnnonce($annonce, $new_usr, $mdp, $role, $favcolor){
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
        //addAnnonce($titre, $lieu, $pays, $prixnuit, $bon_plan);
        $_SESSION['mdp'] = ($annonces[$new_usr]['mdp']);
        $res=json_encode($annonces, JSON_PRETTY_PRINT);
        file_put_contents("./annonces/annonces.json",$res); //résultat dans annonces.json
    }
    
}
?>
