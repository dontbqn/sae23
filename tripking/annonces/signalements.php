<?php
if (isset($_POST["id"])) {
    $log = $_POST["id"];
    // Récuperation du log envoyé via
    echo "XMLHttpRequest a bien été reçu";
    $file = './report_logs.txt';
    file_put_contents($file, "Nouveau signalement de l'annonce : ".$log. PHP_EOL, FILE_APPEND); //EOL = EndOfLine
}

?>
