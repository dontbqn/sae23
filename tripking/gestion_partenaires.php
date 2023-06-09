<?php 
session_start();
include("./fonctions_start.php");
setup();
liseret();
pagenavbar("partenaires.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>



<body>

  <div class="container">
    <h2>Gestion des partenaires</h2>
    <p> Indiquez uniquement le nom pour supprimer un utiisateur, en revanche, pour en ajouter un, veuillez remplir tout le formulaire </p>
    <form class="text-center" method="post">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Enter name of partner" name="name" required>
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <input type="text" class="form-control" id="description" placeholder="Enter description" name="description">
      </div>
      <div class="form-group">
        <label for="users">Users:</label>
        <input type="text" class="form-control" id="users" placeholder="Enter user" name="users">
      </div>
      <div class="form-group">
        <label for="logo">Logo:</label>
        <input type="text" class="form-control" id="logo" placeholder="ex: ./images/partenaires/michelin.ico" name="logo">
      </div>
      <div class="form-group">
        <label for="link">Link:</label>
        <input type="text" class="form-control" id="link" placeholder="Enter link" name="link">
      </div>
      
      
      <button name="add" type="submit" class="btn btn-default">Ajouter un partenaire</button>
      
      
      <button name="del" type="submit" class="btn btn-default">Supprime un partenaire</button>
      
      <?php
      
      $name = $_POST["name"];
      $description = $_POST["description"];
      $users = $_POST["users"];
      $logo = $_POST["logo"];
      $link = $_POST["link"];
      
      if(isset($_POST["add"])){
      	addpartenaire($name, $description, $users, $logo, $link);
      }
      
      
      if(isset($_POST["del"])){
      	deletepartenaire($name);
      }
      ?>
    </form>
    
    
    
  </div>

</body>
<?php
footer();
?>

</html>
