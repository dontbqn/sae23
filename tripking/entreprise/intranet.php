<?php
session_start();
include("../fonctions_start.php");
setup();
?>
    <body>
        <?php if(!isset($_POST['intra-form'])){ 
                echo '
                <h1 class="my-4 text-center">
                    Accès Employé
                    <hr class="position-relative translate-middle text-warning border-5 rounded-circle col-6 top-50 start-50">
                        <h4 class="display-5 text-center">
                            Intranet TripKing
                        </h4>
                </h1>
                <div class="d-flex container-fluid justify-content-center mt-3">
                    <div class="col-5 mb-5 border border-2 rounded-4 p-3">
                    <form method="post">
                            <div class="form-group">
                                <label for="roleinp">Role</label>
                                <input type="text" class="form-control shadow-none" id="roleinp" name="roleinp" placeholder="visitor" value="visitor" readonly>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control shadow-none" id="username" name="username" placeholder="Xx_DarcoxXx96" required>
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
                    <script src="../js/pass_verif.js"></script>
                </div>
            </div>
            ';
            }
            else{
                echo '
                    <h1 class="my-4 text-center">
                        Accès Employé
                        <hr class="position-relative translate-middle text-warning border-5 rounded-circle col-6 top-50 start-50">
                            <h4 class="display-5 text-center">
                                Intranet TipKing
                            </h4>
                    </h1>
                ';
                echo '<pre>';
                print_r($_POST);
                echo '</pre>';
                // Gestion des utilisateurs, du profil associé et de l’appartenance aux différents groupes
                echo '
                <div class="container">
                <div class="row mb-5 border border-2 rounded-4 p-3 text-wrap">
                  <div class="col-md-4">
                    <div class="card mb-4">
                      <div class="card-body">
                        <h5 class="card-title">Gestion des utilisateurs</h5>
                        <p class="card-text">Gérez les utilisateurs, les profils et l\'appartenance aux groupes.</p>
                        <a href="lien_vers_page_utilisateurs.html" class="btn btn-primary">Accéder</a>
                      </div>
                    </div>
                  </div>
              
                  <div class="col-md-4">
                    <div class="card mb-4">
                      <div class="card-body">
                        <h5 class="card-title">Gestionnaire de fichiers</h5>
                        <p class="card-text">Ajoutez, supprimez et visualisez des fichiers (selon les droits).</p>
                        <a href="lien_vers_page_fichiers.html" class="btn btn-primary">Accéder</a>
                      </div>
                    </div>
                  </div>
              
                  <div class="col-md-4">
                    <div class="card mb-4">
                      <div class="card-body">
                        <h5 class="card-title">Groupes</h5>
                        <p class="card-text">Gérez les différents groupes (admin, salariés, managers, direction, perso).</p>
                        <a href="lien_vers_page_groupes.html" class="btn btn-primary">Accéder</a>
                      </div>
                    </div>
                  </div>
              
                  <div class="col-md-4">
                    <div class="card mb-4">
                      <div class="card-body">
                        <h5 class="card-title">Annuaire de l\'entreprise</h5>
                        <p class="card-text">Consultez l\'annuaire de l\'entreprise (30 personnes minimum).</p>
                        <a href="annuaire.php" class="btn btn-primary">Accéder</a>
                      </div>
                    </div>
                  </div>
              
                  <div class="col-md-4">
                    <div class="card mb-4">
                      <div class="card-body">
                        <h5 class="card-title">Gestion des partenaires</h5>
                        <p class="card-text">Gérez le logo, les informations du partenaire et les commentaires qui s\'affichent dans la vitrine.</p>
                        <a href="lien_vers_page_partenaires.html" class="btn btn-primary">Accéder</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>';
              



            } ?>
    </body>
<?php footer(); ?>
</html>