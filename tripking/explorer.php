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
        <div class="d-flex justify-content-center rounded-3 p-3 mx-4 px-4 m-2 bg-secondary-subtle border border-black border-3">
            <form method="post" class="shadow-md border-white">
                <div class="row g-2">
                    <div class="col-7 my-2 mx-4 p-3 bg-dark bg-opacity-25 border border-1 border-black">
                        <label class="fs-6 d-none d-md-none d-lg-block" for="keywords">Rechercher l\'expression</label>
                        <input type="search" class="form-control shadow-none" placeholder="Barcelone T4 piscine" name="keywords" minlength="4" maxlength="32" autofocus>
                    </div>
                    <div class="col-sm-4 mt-3 p-2 bg-dark bg-opacity-25 border border-1 border-black">
                        <div class="form-check">
                            <input class="form-check-input shadow-none" type="radio" name="radioBtn" value="titre" id="titre" checked>
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
                </div>
                    <div class="row my-3">
                        <div class="col-9">
                            <div class="input-group rounded-5">
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
                                        Autres transports disponibles 
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="ms-1 bg-dark bg-opacity-25 border border-1 border-black">
                                <label for="price_range" class="ms-1 p-2 fw-bold">Prix Max/nuit</label>
                                <div class="px-3 pb-2 input-group">
                                    <span class="col-5 input-group-item">10€</span>
                                    <span class="col-2 input-group-item" id="range_value"></span>
                                    <span class="col-5 text-end input-group-item">50€</span>
                                    <input type="range" class="form-range" min="0" max="50" step="5" value="50" name="price_range" id="price_range">
                                    <script src="./js/rangeinp.js"></script>
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
        // Reload par défaut les annonces si besoin
        //newAnnonce();
        //newCommentaires();
        $annonces = json_decode(file_get_contents("./annonces/annonces.json"), true);
        echo '<div class="container d-flex justify-content-center rounded-3 my-2 bg-secondary-subtle border border-black border-1">';
        showAnnonces($annonces, $found=False);   
        echo '</div>';
    }
    else{
        // Récupérer toutes les valeurs des balises <input>
        $keywords = $_POST['keywords'];
        if(isset($_POST["radioBtn"])){$radioBtn = $_POST['radioBtn'];}else{$radioBtn = null;}
        if(isset($_POST["checkboxBtn"])){$checkboxBtn = $_POST['checkboxBtn'];}else{$checkboxBtn = null;}
        $priceRange = $_POST['price_range'];

        // Appeler la fonction findAnnonces() avec les valeurs récupérées
        //print_r($_POST);
        
        findAnnonces($keywords, $radioBtn, $checkboxBtn, $priceRange);
    }
    ?>
        
    </div>
    </body>
    <?php footer(); ?>
</html>