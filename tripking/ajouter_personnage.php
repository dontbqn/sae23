<?php
/* Auteur : Séverin Messiaen */

if (!isset($_GET["prenom"]) || !isset($_GET["nom"]) || !isset($_GET["date_naissance"])) {
    echo ("Il manque des arguments !");
    echo ("<pre>");
    var_dump($_GET);
    echo ("</pre>");
    die();
}

$personnages = json_decode(file_get_contents("data/partenaires.json"), true);
array_push($personnages, array(
    "id" => end($personnages)['id'] + 1,
    "nom" => $_GET['nom'],
    "prenom" => $_GET['prenom'],
    "date_naissance" => $_GET['date_naissance']
));
file_put_contents("data/partenaires.json", json_encode($personnages));
header("Location: about.php");