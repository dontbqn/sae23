<?php
session_start();
include("./fonctions_start.php");
include("./annonces.php");
setup();
pagenavbar("reservations.php");
?>
    <body>
        <h1 class="mt-5 mb-3 text-center">
            Votre Espace Réservations
        </h1>
        <h5 class="mt-5 mb-3 text-center">
            Vos annonces favorites sont listées ici ! 
        </h5>
    <div class="container col-11 border border-2 rounded-4 shadow my-2 p-3">
        <?php
            $users = json_decode(file_get_contents("./data/users.json"), true);
            $annonces = json_decode(file_get_contents("./annonces/annonces.json"), true);
            $annoncesId = [];
            $user1 = $_SESSION["user"];

            if (isset($users[$user1]) && isset($users[$user1]['favoris'])) {
                $favoris = $users[$user1]['favoris'];
                foreach ($favoris as $annonceId) {
                    $annonce = $annonces[$annonceId]; // Récupére les annonces
                    if ($annonce) {
                        array_push($annoncesId, $annonce);
                    }
                }

                getAnnonces($annoncesId); // Afficher les annonces des favoris du user
            } else {
                echo "Aucune annonce mise en favoris pour cet utilisateur.";
            }
        ?>
    </div>
        
    </div>
    </body>
    <?php footer(); ?>
</html>