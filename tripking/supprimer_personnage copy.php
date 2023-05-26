<?php
/* Auteur : Séverin Messiaen */

if (!isset($_GET["id"])) {
    echo ("Il manque des arguments !");
    echo ("<pre>");
    var_dump($_GET);
    echo ("</pre>");
    die();
}

$personnages = json_decode(file_get_contents("partenaire.json"), true);
foreach($personnages as $key => $personnage) {
    if($personnage['id'] == $_GET['id']) {
        unset($personnages[$key]);
    }
}
file_put_contents("partenaire.json", json_encode($personnages));
header("Location: ../about.php");