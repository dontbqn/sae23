<?php
session_start();
/*
Page Formulaire
*/
include("./fonctions_start.php");
setup();
pagenavbar("Formulaire.php");
?>
<body>

    <h1 class="my-4 text-center">
        Formulaire
        <hr>
    </h1>
    <div class="container col-9 bg-success rounded-4 shadow my-5 p-3">
    <?php 
    if(!isset($_POST["recherche"])){
        echo '
        <div class="d-flex justify-content-center bg-opacity-75 bg-gradient rounded-3 text-white p-2 mx-4 px-4 m-3">
            <form method="post" class="shadow-md border-white text-white">
                <div class="row">
                    <div class="col-md-5 my-2">
                        <label class="fs-6 d-none d-md-none d-lg-block" for="keywords">Rechercher l\'expression</label>
                        <input type="search" class="form-control shadow-none" placeholder="La Belle et la..." name="keywords" minlength="4" maxlength="32" autofocus>
                    </div>
                    <div class="col-sm-4 mt-3">
                        <div class="form-check">
                            <input class="form-check-input shadow-none" type="radio" name="radioBtn" value="Recherche par Titres" id="titre">
                            <label class="form-check-label" for="titre">
                            Rechercher par Titre
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input shadow-none" type="radio" name="radioBtn" value="Recherche par Auteurs" id="auteur">
                            <label class="form-check-label" for="auteur">
                            Rechercher par Auteur
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input shadow-none" type="radio" name="radioBtn" value="Recherche par Contenus" id="contenu">
                            <label class="form-check-label" for="contenu">
                            Rechercher par Contenu
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-4 row mb-4">
                        <div class="col">
                            <label class="" for="annee">Année de parution<span class="text-danger">*</span></label>
                                <select type="number" value="0" class="shadow-none my-2" id="annee" name="annee">
                                ';
                                $currentYear = date('Y');
                                for ($i = 0; $i <= $currentYear; $i++) {
                                    // display years in centuries for years before 1600
                                    if (($i < 1600) && ($i%100 == 0)) {
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                    elseif ($i >= 1600) {
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                }
                                echo '
                                </select>
                        </div>
                        <div class="col">
                            <label class="fs-6" for="mois">Mois de parution<span class="text-danger">**</span></label>
                            <input type="number" class="shadow-none w-50" value="0" id="mois" name="mois" max="12" min="0">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <input type="submit" class="btn btn-outline-white btn-dark" name="recherche" value="Rechercher">
                </div>
            </form>
        </div>
        <div class="ms-3 text-white"><span class="text-danger">*</span>La recherche s\'effectuera sur les années suivantes</div>
        <div class="ms-3 text-white"><span class="text-danger">**</span>0 = option non-prise en compte</div>
        ';
    //Variables vides pour l'instant
    $livres = json_decode(file_get_contents("data/data.json"), true);
    showBooks($livres, $found=False);
    }
    else{
        //Take inputs data and call findBooks() function from them
        $keywords = htmlspecialchars($_POST["keywords"]);
        $fields=[];
        if(isset($_POST["radioBtn"])){
            $radio=$_POST["radioBtn"];
            if($radio=="Recherche par Auteurs"){
                $btn = 'auteur';
            }
            elseif($radio=="Recherche par Titres"){
                $btn = 'titre';
            }
            else{
                $btn = 'contenu';
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
        $livres = json_decode(file_get_contents("data/data.json"), true);
        findBooks($livres, $keywords, $fields);
    }
    ?>
        
    </div>



    </body>
    <?php footer(); ?>
</html>




