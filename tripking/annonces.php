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
            "description" => "WOoooooo",
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
            "description" => "Caaaaaaaaaaaaaaaaaa",
            "images" => array(
                "./annonces/2/img1.jpg",
                "./annonces/2/img2.jpg"
            )
            ),
            "3" => array(
                "id" => 3,
                "titre" => "Villa de luxe avec piscine",
                "lieu" => "Marbella",
                "pays" => "Espagne",
                "prix_nuit" => 200,
                "nb_fav" => 5,
                "bon_plan" => false,
                "commentaires" => array("c09", "c15", "c28"),
                "description" => "Villa de luxe avec piscine privée, jardin tropical et vue panoramique sur la mer. Un paradis pour des vacances exclusives.",
                "images" => array(
                    "./annonces/3/img1.jpg",
                    "./annonces/3/img2.jpg",
                    "./annonces/3/img3.jpg")
                ),
            "4" => array(
                "id" => 4,
                "titre" => "Chalet de montagne confortable",
                "lieu" => "Chamonix",
                "pays" => "France",
                "prix_nuit" => 100,
                "nb_fav" => 3,
                "bon_plan" => false,
                "commentaires" => array("c12", "c18", "c21"),
                "description" => "Chalet de montagne confortable avec une vue imprenable sur les sommets enneigés.",
                "images" => array(
                    "./annonces/4/img1.jpg",
                    "./annonces/4/img2.jpg"
                )
                ),
            "5" => array(
                "id" => 5,
                "titre" => "Appartement moderne en centre-ville",
                "lieu" => "Paris",
                "pays" => "France",
                "prix_nuit" => 80,
                "nb_fav" => 1,
                "bon_plan" => true,
                "commentaires" => array("c08", "c14", "c22"),
                "description" => "Appartement moderne situé en plein cœur de Paris, à proximité des attractions principales.",
                "images" => array(
                        "./annonces/5/img1.jpg",
                        "./annonces/5/img2.jpg",
                        "./annonces/5/img3.jpg"
                    )
                ),
            );
    $res = json_encode($default_users, JSON_PRETTY_PRINT);
    file_put_contents("./annonces/annonces.json", $res);
}
function showAnnonces($annonces, $found=false){
    if($annonces == []){
        echo '
        <div class="p-2 mt-2">
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
echo '<div class="row">';

foreach ($annonces as $found) {
    echo '
        <div class="col-md-4">
            <div class="card mb-3 bg-opacity-25">
                <img src="'.$found['images'][0].'" class="card-img-top" alt="Annonce Preview">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">'.$found['titre'].'</h5>
                    <p class="card-text fst-italic">'.$found['lieu'].'</p>
                    <p class="card-text">
                        <strong>'.$found['prix_nuit'].'€</strong> / Nuit
                    </p>
                    <a type="button" href="page_annonce.php?id='.$found['id'].'" class="btn btn-dark">Voir +</a>
                </div>
            </div>
        </div>';
}
echo '</div>

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

function findAnnonces($keywords, $radioBtn, $checkboxBtn, $priceRange) {
    $founded_annonces = [];
    $keywords = strip_tags($keywords); // Remove HTML tags
    $keywords = htmlentities($keywords, ENT_QUOTES, 'UTF-8'); // Encode special characters
    $annonces = json_decode(file_get_contents("./annonces/annonces.json"), true);
    $filtered_annonces = [];

    if($keywords == "" && $radioBtn == null && $checkboxBtn == null && $priceRange == 0){
        return getAnnonces($annonces);
    }
    $transports = ["train","avion","bus","voiture","autres_tr"];
    echo '
        <ul class="mt-2 bg-dark bg-opacity-25 border border-black border-3 px-3 m-4">';
        echo '<li>Recherche : '.($keywords).'</li>';
        if($checkboxBtn != null){ //Transport
            
            if(in_array($checkboxBtn, $transports)){
                echo "<li>Recherche par $checkboxBtn </li>";
            }
            else{
                echo "<li>Tous les types de transport</li>";
            }
        }
        $recherchepar = ["titre","lieu_pays","contenu"];
        if($radioBtn != null){ //Transport
            if(in_array($radioBtn, $recherchepar)){
                if($radioBtn == "lieu_pays"){
                    echo "<li>Recherche par Lieu / Pays </li>";
                }
                else{
                    echo "<li>Recherche par $radioBtn </li>";
                }
            }
            else{
                echo "<li>Titre, lieux, pays ou contenu</li>";
            }
        }
        if($priceRange != null){ //Transport
            echo "<li>Prix Maximum/nuit : $priceRange €</li>";
        }
        echo '</ul>';


    $keywords = explode(" ", $keywords);
    foreach ($keywords as $key) {
        //Affiche recherche en cours
        foreach ($annonces as $annonce) {
            //echo strtolower($annonce["titre"]);
            $key = strtolower($key);
            if (str_contains(strtolower($annonce["titre"]), $key)) {
                array_push($founded_annonces, $annonce);
            } elseif ($radioBtn === 'lieu_pays' && str_contains(strtolower($annonce["lieu"]), $key)) {
                array_push($founded_annonces, $annonce);
            } elseif ($radioBtn === 'contenu' && str_contains(strtolower($annonce["contenu"]), $key)) {
                array_push($founded_annonces, $annonce);
            }
        }
    }

    $filtered_annonces = array_filter($founded_annonces, function ($annonce) use ($priceRange) {
        return $annonce['prix_nuit'] <= $priceRange;
    });
    print_r($founded_annonces);
    echo '<br>';
    print_r($filtered_annonces);
    showAnnonces($filtered_annonces);
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

function newCommentaires(){
    //fichier json contenant les premiers commentaires
        /*

        */
        $commentaires = array(
            "c04" => array(
                "id" => "c04",
                "auteur" => "bagel",
                "titre" => "Super Weekend en famille !",
                "note" => 2,
                "message" => "J4AI ADORé la vue et le balcon superbe."
            ),
            "c01" => array(
                "id" => "c01",
                "auteur" => "alice123",
                "titre" => "Expérience incroyable",
                "note" => 5,
                "message" => "Nous avons passé un séjour fantastique dans cet endroit. Tout était parfait !"
            ),
            "c02" => array(
                "id" => "c02",
                "auteur" => "john_doe",
                "titre" => "Vacances relaxantes",
                "note" => 4,
                "message" => "L'endroit était paisible et l'appartement était très confortable. Nous avons vraiment apprécié notre séjour."
            ),
            "c03" => array(
                "id" => "c03",
                "auteur" => "emma89",
                "titre" => "Séjour agréable",
                "note" => 3,
                "message" => "L'appartement était bien situé mais aurait pu être mieux entretenu."
            ),
            "c05" => array(
                "id" => "c05",
                "auteur" => "james007",
                "titre" => "Wonderful stay",
                "note" => 5,
                "message" => "The place exceeded our expectations. Highly recommended!"
            ),
            "c06" => array(
                "id" => "c06",
                "auteur" => "lucy123",
                "titre" => "Perfect location",
                "note" => 4,
                "message" => "The apartment was conveniently located close to all the attractions."
            ),
            "c07" => array(
                "id" => "c07",
                "auteur" => "mike22",
                "titre" => "Great value for money",
                "note" => 4,
                "message" => "We got more than what we paid for. It was a fantastic deal!"
            ),
            "c08" => array(
                "id" => "c08",
                "auteur" => "sarah87",
                "titre" => "Cozy and comfortable",
                "note" => 5,
                "message" => "The place had a warm and cozy atmosphere. We felt right at home."
            ),
            "c09" => array(
                "id" => "c09",
                "auteur" => "alex123",
                "titre" => "Lovely apartment",
                "note" => 4,
                "message" => "We enjoyed our stay in this lovely apartment. It had everything we needed."
            ),
            "c10" => array(
                "id" => "c10",
                "auteur" => "julia56",
                "titre" => "Fantastic view",
                "note" => 5,
                "message" => "The view from the apartment was breathtaking. We couldn't get enough of it."
            ),
            "c11" => array(
                "id" => "c11",
                "auteur" => "peter789",
                "titre" => "Excellent service",
                "note" => 5,
                "message" => "The host provided exceptional service throughout our stay. Highly recommended!"
            ),
            "c12" => array(
                "id" => "c12",
                "auteur" => "sophie23",
                "titre" => "Amazing location",
                "note" => 4,
                "message" => "The apartment was located in the heart of the city. It was so convenient for exploring."
            ),
            "c13" => array(
                "id" => "c13",
                "auteur" => "david456",
                "titre" => "Wonderful amenities",
                "note" => 5,
                "message" => "The apartment had all the amenities we needed for a comfortable stay."
            ),
            "c14" => array(
                "id" => "c14",
                "auteur" => "natalie19",
                "titre" => "Friendly host",
                "note" => 4,
                "message" => "The host was very friendly and helpful. We had a great experience."
            ),
            "c15" => array(
                "id" => "c15",
                "auteur" => "michael34",
                "titre" => "Spacious and clean",
                "note" => 4,
                "message" => "The apartment was spacious and clean. We had a comfortable stay."
            ),
            "c16" => array(
                "id" => "c16",
                "auteur" => "lily789",
                "titre" => "Excellent value",
                "note" => 5,
                "message" => "We got an excellent value for the price we paid. Highly recommended!"
            ),
            "c17" => array(
                "id" => "c17",
                "auteur" => "sammy56",
                "titre" => "Peaceful and relaxing",
                "note" => 4,
                "message" => "The place was so peaceful and relaxing. We had a great time unwinding there."
            ),
            "c18" => array(
                "id" => "c18",
                "auteur" => "olivia12",
                "titre" => "Charming apartment",
                "note" => 5,
                "message" => "The apartment had a charming character and we fell in love with it."
            ),
            "c19" => array(
                "id" => "c19",
                "auteur" => "ryan45",
                "titre" => "Excellent location",
                "note" => 5,
                "message" => "The location of the apartment was perfect. We could easily reach all the attractions."
            ),
            "c20" => array(
                "id" => "c20",
                "auteur" => "emma_jones",
                "titre" => "Home away from home",
                "note" => 4,
                "message" => "The apartment felt like a home away from home. We had a comfortable stay."
            ),
        );
      
    $res = json_encode($commentaires, JSON_PRETTY_PRINT);
    file_put_contents("./data/commentaires.json", $res);
}


?>
