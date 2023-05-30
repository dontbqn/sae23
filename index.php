<?php 
include("vue/template_html.php");
include("modeles/annonces.php");
include("modeles/utilisateurs.php");
include("controleurs/utilisateurs.php");
if(isset($_SESSION["user"])){
    setup($_SESSION["role"]);
} 
else{
    setup("user");
}



?>