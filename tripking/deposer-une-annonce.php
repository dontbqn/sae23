<?php
session_start();
include("./fonctions.php");
include("./annonces.php");
setup();
pageheader();
pagenavbar("deposer-une-annonce.php");
?>
    <body>
        <h1 class="my-4 text-center">
            Publier une offre
            <hr class="position-relative translate-middle text-warning border-5 rounded-circle col-6 top-50 start-50">
        </h1>
        <div class="d-flex container-fluid justify-content-center">
            <div class="col-5 mb-5 border border-2 rounded-4 p-3">
            <?php if(!isset($_POST['annonce_btn'])){ 
                echo '
                <form method="post">
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" class="form-control shadow-none" id="titre" name="titre" placeholder="Barcelone T4 vue sur Mer Thalasso" readonly>
                        </div>
                        <div class="form-group">
                            <label for="lieu">Lieu</label>
                            <input type="text" class="form-control shadow-none" id="lieu" name="lieu" placeholder="Barcelone" required>
                        </div>
                        <div class="form-group">
                            <label for="prixnuit" class="col-form-label">Prix d\'une nuit</label>
                            <input type="text" class="form-control shadow-none password" name="prixnuit" id="prixnuit" required>
                        </div>  
                        <div class="form-group form-check form-switch my-2">
                            <input type="checkbox" name="bonplan" class="form-check-input my-2 p-2 shadow-none" id="bonplan">
                            <label for="bonplan" class="pt-1"> Bon Plan </label>
                        </div>';
                        //Selection d'images dde l'annonce
                        echo '
                        <div class="my-3 form-group">
                        <div class="row offset-2 col-8 p-5 border text-wrap bg-transparent border-2 shadow-md text-break">
                            <form class="d-flex justify-content-center" method="POST" enctype="multipart/form-data">
                                <label class="me-2">Selectectionnez des photos</label>
                                <input type="file" id="file_txt" name="file_txt" accept=".jpg,.png">
                            </form>';
                            if (isset($_FILES['annonce_btn'])) {
                                $file = $_FILES['annonce_btn']["name"]!="" ? $_FILES['annonce_btn'] : False;
                                if($file == False){
                                    echo '<div class="text-danger fw-bold">Entrez une photo valide !</div>';
                                }
                                else{
                                    $path = $file['tmp_name'];
                                    //stock file temporary in file
                                    $newfilePath = "annonces/".$new_annonce['id']."/".$file["name"];
                                    move_uploaded_file($path, $newfilePath);
                                    echo "<br> <div class='mt-4 p-3 bg-secondary bg-opacity-50 rounded-1 border-white'>";
                                    print(file_get_contents($newfilePath));
                                }
                            }
                        echo '
                        </div>
                    </div>
                        <div class="form-group col-4 mt-2 mb-4">
                        <input type="submit" class="form-control btn btn-warning" id="annonce_btn" name="annonce_btn">
                    </div>
                </form>
';
            }
            else{
                //Création de la nouvelle annonce
                addAnnonce();
                //Récupération du nouvel id
                //Redirection vers la page d'annonce nouvellement créée grâce à son id
                header('Location : ./annonce.php');
            } ?>
            </div>
        </div>
    </body>
<?php pagefooter(); ?>
</html>