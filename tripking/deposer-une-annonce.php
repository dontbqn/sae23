<?php
session_start();
include("./fonctions_start.php");
include("./annonces.php");
setup();
pagenavbar("deposer-une-annonce.php");
if(isset($_SESSION['role']) && ($_SESSION['role']=="admin" || $_SESSION['role']=="superadmin"|| $_SESSION['role']=="partenaire")){
}
else{
    echo '<script>console.log("You are not one of TripKing\'s partner");</script>';
    header("Location: page01.php");
}
?>
    <body>
        <h1 class="my-5 text-center">
            Publier une offre
            <hr class="position-relative translate-middle text-warning border-5 rounded-circle col-6 top-50 start-50">
        </h1>
        <?php
            if(isset($_SESSION['partenaire'])){
                $p = $_SESSION["partenaire"];
                echo '<h1 class="text-center text-primary mb-3">Votre société : '.ucfirst($p).'</h1>'; // Premiere lettre en capital
            }

            //ANNONCES
            $annonces = json_decode(file_get_contents("annonces/annonces.json"), true);
        ?>      
        <div class="d-flex container-fluid justify-content-evenly">
            <div class="col-5 mb-5 border-dark border border-2 rounded-4 p-3">
                <h5 class="text-center my-4 bg-success p-3">Publier une Offre</h5>
            <?php if(!isset($_POST['annonce_btn'])){ 
                echo '
                <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" class="form-control shadow-none" id="titre" name="titre" placeholder="Barcelone T4 vue sur Mer Thalasso" required>
                        </div>
                        <div class="form-group">
                            <label for="lieu">Lieu</label>
                            <input type="text" class="form-control shadow-none" id="lieu" name="lieu" placeholder="Barcelone" required>
                        </div>
                        <div class="form-group">
                            <label for="pays">Pays</label>
                            <input type="text" class="form-control shadow-none" id="pays" name="pays" placeholder="Espagne" required>
                        </div>
                        <div class="form-group">
                            <label for="prixnuit" class="col-form-label">Prix d\'une nuit</label>
                            <input type="number" class="form-control shadow-none password" name="prixnuit" id="prixnuit" placeholder="23€" min="5" max="50" required>
                        </div>  
                        <div class="form-group">
                            <label for="description" class="col-form-label">Description</label>
                            <textarea type="description" class="form-control shadow-none password" name="description" id="description" placeholder="3 chambres, 2 toilettes, 1 frigo..." max="300" required style="max-height:500px"></textarea>
                        </div>  
                        <div class="form-group form-check form-switch my-2">
                            <input type="checkbox" name="bonplan" class="form-check-input my-2 p-2 shadow-none" id="bonplan">
                            <label for="bonplan" class="pt-1"> Bon Plan &#128293; </label>
                        </div>';
                        //Selection d'images de l'annonce
                        echo '
                        <div class="my-3 form-group">
                        <div class="row offset-2 col-8 p-5 border text-wrap bg-transparent border-2 shadow-md text-break">
                                <label class="me-2">Selectectionnez des photos</label>
                                <input type="file" id="img_files" name="img_files[]" accept=".jpg,.png" multiple>';
                        echo '
                        </div>
                    </div>
                        <div class="mt-2 mb-4">
                            <input type="submit" class="form-control btn btn-warning" id="annonce_btn" name="annonce_btn">
                        </div>
                </form>
                ';
            }
            else{
                //Création de la nouvelle annonce
                //Puis, redirection vers la page d'annonce nouvellement créée grâce à son id
                $lastItem = end($annonces);
                $newAnnonceID = $lastItem["id"] + 1;
                //echo $newAnnonceID;
                //var_dump($_FILES);
                $images = $_FILES['img_files'];
                //var_dump($_POST);
                if(isset($_POST["bon_plan"])){
                    addAnnonce($newAnnonceID,$_POST["titre"], $_POST["lieu"], $_POST["pays"], $_POST["prixnuit"], $_POST["description"], $images, $_POST["bon_plan"]);
                }
                else{
                    addAnnonce($newAnnonceID,$_POST["titre"], $_POST["lieu"], $_POST["pays"], $_POST["prixnuit"], $_POST["description"], $images);
                }
                
            } ?>
            </div>
        </div>
    </body>
<?php footer(); ?>
</html>