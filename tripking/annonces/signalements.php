<?php
$log = $_POST['report_log'];
// Récuperation du log envoyé via 
$file = './report_logs.txt';
file_put_contents($file, "New report input on report_logs.txt : ".$log.'\n', FILE_APPEND);
?>
