<?php 
session_start();
include("./fonctions_start.php");
setup();
pagenavbar("partenaires.php");

?>

<body>
<?php

$partenaires = json_decode(file_get_contents("./data/partenaires.json", true),true);
foreach($partenaires as $element){
echo '
<div class="container mt-3">
    <div class="text-center">
	<div class="card" style="width:400px">
	    <img class="card-img-top" src="'.$element["logo"].'" alt="Card image" style="width:100%">
	 <div class="card-body">
	      <h4 class="card-title">'.$element["name"].'</h4>
	      <p class="card-text"> '.$element["description"].'</p>
	      <a href="'.$element["lien"].'" class="btn btn-primary">Acceder au site</a>
	  </div>
	</div>
    </div>
</div>
  <br>
';
}



?>

</body>

<?php
footer();
?>

</html>
