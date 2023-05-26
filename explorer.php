<?php
session_start();
include("./fonctions_start.php");
include("./annonces.php");
setup();
pagenavbar("explorer.php");
?>
    <body>
        <h1 class="my-1 text-center">
        Explorer
    </h1>
        
    <div class="container col-11 border border-2 rounded-4 shadow my-2 p-3">
    <?php 
    if(!isset($_POST["recherche"])){ //Javascript mettre à jour le placeholder à partir de 2 ou 3 phrases
        echo '
        <div class="d-flex justify-content-center rounded-3 p-2 mx-4 px-4 m-2 bg-secondary-subtle border border-black border-3">
            <form method="post" class="shadow-md border-white">
                <div class="row">
                    <div class="col-md-8 my-2">
                        <label class="fs-6 d-none d-md-none d-lg-block" for="keywords">Rechercher l\'expression</label>
                        <input type="search" class="form-control shadow-none" placeholder="Barcelone T4 piscine" name="keywords" minlength="4" maxlength="32" autofocus>
                    </div>
                    <div class="col-sm-4 mt-3">
                        <div class="form-check">
                            <input class="form-check-input shadow-none" type="radio" name="radioBtn" value="titre" id="titre">
                            <label class="form-check-label" for="titre">
                            Rechercher par Titre
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input shadow-none" type="radio" name="radioBtn" value="lieu_pays" id="lieu_pays">
                            <label class="form-check-label" for="lieu_pays">
                            Rechercher par Lieu/Pays
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input shadow-none" type="radio" name="radioBtn" value="contenu" id="contenu">
                            <label class="form-check-label" for="contenu">
                            Rechercher par Contenu
                            </label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-7 input-group">
                            <div class="input-group-text">
                                <input class="form-check-input shadow-none" type="checkbox" name="checkboxBtn" value="bus" id="bus">
                                <label class="form-check-label px-2" for="bus">
                                    Bus
                                </label>
                            </div>
                            <div class="input-group-text">
                                <input class="form-check-input shadow-none" type="checkbox" name="checkboxBtn" value="train" id="train">
                                <label class="form-check-label px-2" for="train">
                                    Train
                                </label>
                            </div>
                            <div class="input-group-text">
                                <input class="form-check-input shadow-none" type="checkbox" name="checkboxBtn" value="avion" id="avion">
                                <label class="form-check-label px-2" for="avion">
                                    Avion
                                </label>
                            </div>
                            <div class="input-group-text">
                                <input class="form-check-input shadow-none" type="checkbox" name="checkboxBtn" value="autre_tr" id="autre_tr">
                                <label class="form-check-label px-2" for="autre_tr">
                                    Autre transport disponible  
                                </label>
                            </div>
                            <div class="ms-1 col-2 bg-light">
                                <label for="price_range" class="">Prix Max/nuit</label>
                                <div class="px-3">
                                    <span class="col-6">10€</span>
                                    <span class="col-6">50€</span>
                                    <input type="range" class="form-range" min="0" max="50" step="5" id="price_range">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <input type="submit" class="btn btn-outline-white btn-dark" name="recherche" value="Rechercher">
                </div>
            </form>
        </div>
        ';
        //Variables vides pour l'instant
        newAnnonce();
        $annonces = json_decode(file_get_contents("./annonces/annonces.json"), true);
        showAnnonces($annonces, $found=False);   
    }
    else{
        //Take inputs annonces and call findAnnonces() function from them
        $keywords = htmlspecialchars($_POST["keywords"]);
        $fields=[];
        if(isset($_POST["radioBtn"])){
            $radio=$_POST["radioBtn"];
            if($radio=="titre"){
                $btn = 'titre';
            }
            elseif($radio=="lieu_pays"){
                $btn = 'lieu_pays';
            }
            else{
                $btn = $radio; //"contenu"
            }
            $fields[$btn] = $btn;
        }

        $annonces = json_decode(file_get_contents("./annonces/annonces.json"), true);
        findAnnonces($annonces, $keywords, $fields);
    }
    ?>
        
    </div>
    </body>
    <?php footer(); ?>
</html>