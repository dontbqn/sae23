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
        <div class="d-flex justify-content-center rounded-3 p-2 mx-4 px-4 m-2 bg-secondary border border-black border-3">
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
                </div>
                <div class="col">
                    <input type="submit" class="btn btn-outline-white btn-dark" name="recherche" value="Rechercher">
                </div>
            </form>
        </div>
        ';
    //Variables vides pour l'instant
    newAnnonce();
    $annonces = json_decode(file_get_contents("annonces/annonces.json"), true);
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
        if(!$_POST["mois"]==0){
            $mois = date("F", mktime(0, 0, 0,$_POST["mois"], 10)); // 1 => year 2010, valeur à négligé dans ce contexte d'utilisation, "m" pour inverse 02=>February
            $fields["mois"] = $mois;
        }
        if(!$_POST["annee"]==0){
            $annee = $_POST["annee"];
            $fields["annee"] = $annee;
        }
        $annonces = json_decode(file_get_contents("./annonces.json"), true);
        findAnnonces($annonces, $keywords, $fields);
    }
    ?>
        
    </div>
    </body>
    <?php footer(); ?>
</html>