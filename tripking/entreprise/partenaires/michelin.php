<?php
session_start();
if(!isset($_SESSION)){
    echo '<script>alert("You don\'t have the rights");</script>';
    sleep(2);
    header("Location: ../page01.php");
}
else{
    if(!(isset($_SESSION['role']) && ($_SESSION['role']=="admin" || $_SESSION['role']=="superadmin" || $_SESSION['role']=="salarie" || $_SESSION['role']=="partenaire") )){
        echo '<script>alert("You don\'t have the rights");</script>';
        sleep(2);
        header("Location: ../page01.php");
    }
    else{
        include("../../fonctions.php");
        /*
        Page dédiée au partenaire MICHELIN !
        */
        echo '
        <!DOCTYPE HTML>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Bastien, Aronn, Clément, Adrien">
        <link rel="icon" href="images/iconetk.ico">
        <title>TripKing</title>
        <meta name="viewport" content="width=device-width">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">    
        <link href="css/liseret.css" rel="stylesheet">
    </head>

        <body>';
                  echo '
                      <h1 class="my-4 text-center">
                          Accès Employé
                          <hr class="position-relative translate-middle text-warning border-5 rounded-circle col-6 top-50 start-50">
                              <h4 class="display-5 text-center">
                                  Partenaire '.$_SESSION["partenaire"].'
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
                                    <h5 class="card-title">Annuaire de l\'entreprise</h5>
                                    <p class="card-text">Consultez l\'annuaire de l\'entreprise (30 personnes minimum).</p>
                                    <a href="./annuaire.php" class="btn btn-primary">Accéder</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Gestion des partenaires</h5>
                                    <p class="card-text">Gérez le logo, les informations du partenaire et les commentaires qui s\'affichent dans la vitrine.</p>
                                    <a href="./partenaire.php?partenaire='.$_SESSION["partenaire"].'" class="btn btn-primary">Accéder</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
              }
      echo '</body>';
    }
?>
</html>