<?php
session_start();
include('../../annonces.php');
if(!isset($_SESSION)){
    echo '<script>alert("You don\'t have the rights");</script>';
    sleep(2);
    header("Location: ../../page01.php");
}
else{
    if(!(isset($_SESSION['role']) && ($_SESSION['role']=="admin" || $_SESSION['role']=="superadmin" || $_SESSION['role']=="partenaire") )){
        echo '<script>alert("You don\'t have the rights");</script>';
        sleep(2);
        header("Location: ../../page01.php");
    }
    else{
        include("../../fonctions_start.php");
        setup();
        /*
        Page Partenaire avec reconfirmation de connexion par formulaire
        */
    
      echo '<body>';
          if(!isset($_POST['intra-form'])){ 
                  echo '
                  <h1 class="my-4 text-center">
                      Portail Partenaire
                      <hr class="position-relative translate-middle text-warning border-5 rounded-circle col-6 top-50 start-50">
                          <h4 class="display-5 text-center">
                             TripKing vous souhaite la Bienvenue !
                          </h4>
                  </h1>
                  <div class="d-flex container-fluid justify-content-center mt-3">
                      <div class="col-5 mb-5 mt-4 border border-2 rounded-4 p-3">
                      <form method="post">
                              <div class="form-group">
                                  <label for="roleinp">Role</label>
                                  <input type="text" class="form-control shadow-none" id="roleinp" name="roleinp" placeholder="partenaire" value="'.$_SESSION['role'].'" readonly>
                              </div>
                              <div class="form-group">
                                  <label for="username">Username</label>
                                  <input type="text" class="form-control shadow-none" id="username" name="username" placeholder="" required>
                              </div>
                              <div class="form-group">
                                  <label for="motdepasse" class="col-form-label">Password</label>
                                  <input type="password" class="form-control shadow-none passwords" name="motdepasse" id="motdepasse" required>
                              </div>  
                              <div class="form-group form-check form-switch my-2">
                                  <input type="checkbox" name="visible_box" class="form-check-input my-2 p-2 shadow-none" id="dontwatchme">
                                  <label for="visible_box" class="pt-1"> rendre visible</label>
                              </div>
                              <div class="form-group mt-2 mb-4">
                              <input type="submit" class="form-control btn btn-lg btn-warning" id="intra-form" name="intra-form">
                          </div>
                          
                      </form>
                      <script src="../../js/pass_verif.js"></script>
                  </div>
              </div>
              ';
              }
              else{
                  echo '
                      <h1 class="my-4 text-center">
                          Portail Partenaire
                          <hr class="position-relative translate-middle text-warning border-5 rounded-circle col-6 top-50 start-50">
                              <h4 class="display-5 text-center">
                                  Modifier vos informations
                              </h4>
                      </h1>
                      <p class="text-center">TripKing vous offre la possibilité le changer vous-mêmes vos informations dynamquement</p>
                      <p class="text-center">Cette fonctionnalité est basée sur la confiance entre nos entreprises</p>
                  ';
                  echo '
                  <div class="container border-1 border rounded-3 border-secondary p-5 my-5">
                    <div class="display-6"> Logo et description de votre entreprise</div>
                    <hr>
                    les formats acceptées sont les suivants : <span class="fst-italic">png, jpg, jpeg.</span>
                  ';
                  // Modifs Dynamiques avec AJAX
                  // Gestion : Description, Titre, Logo (.ico et png) de l'entreprise   
                  echo '
                  <div class="d-flex row justify-content-evenly">
                    <div class="text-center m-4 border border-4 col-4 bg-dark bg-opacity-50" id="partenaireForm">
                      <form action="./modif_part.php" method="post" enctype="multipart/form-data">';
                            if(isset($_GET["partenaire"])){
                                echo '<input class="form-control p-1 mt-3 mb-4" type="text" name="entreprise" placeholder="'.$_GET["partenaire"].'" id="part_entr">';
                            }
                            if($_SESSION["role"]=="admin" || $_SESSION["role"]=="superadmin"){
                                echo '<p class="fw-bold text-dark py-3"> En tant qu\'administrateur, vous êtes salariés de TripKing,
                                vous avez donc accès à cette page mais ne pouvez rien faire
                                étant donné que vous n\'êtes pas associés à l\'un des partenaires </p>';
                                die();
                            }
                      
                          echo '
                          <textarea class="form-control p-1 mt-3 mb-4" type="description" name="description" placeholder="" id="part_descr"></textarea>
                          <input class="form-control p-1 my-2" type="file" name="imageFile" id="imageFile" accept=".png, .jpg, .jpeg">
                      </form>
                    </div>';
                    //Image preview
                    echo '
                    <div class="text-center m-4 border border-4 col-5">
                      <div class="card">
                        <img id="imagePreview" class="card-img-top" src="../../images/louis.png" alt="Preview">
                        <div class="card-body">
                          <h5 class="card-title" id="previewTitle"></h5>
                          <p class="card-text" id="previewDesc"></p>
                        </div>
                      </div>
                    </div>
                    <script src="../../js/partenaire_form.js"></script>
                    ';
                                   
                  echo '
                    </div>
                  </div>
                  ';
              }
      echo '</body>';
    }
}
?>

    <footer class="container mt-2 pt-5">
        <div class="container text-center">
                <div>
                    <button href="https://www.twitter.com/tripking/" class="btn">
                        <img src="../../images/twitter.png" alt="" width="40" height="40">
                    </button>
                    <button href="https://www.instagram.com/tripking/" class="btn">
                        <img src="../../images/insta.png" alt="" width="40" height="40">
                    </button>
                    <button href="www.facebook.com/tripking/" class="btn">
                        <img src="../../images/facebook.png" alt="" width="40" height="40">
                    </button>
                </div>
            </div>
        <div class="d-flex flex-column flex-sm-row justify-content-center py-4 my-4 border-top">
            <p>&copy; 2022 Company, Inc. All rights reserved.</p>      
        </div>
    </footer>
</html>