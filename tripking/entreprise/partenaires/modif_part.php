<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imageFile'])) {
    $imageTmpPath = $_FILES['imageFile']['tmp_name'];
    $imageType = $_FILES['imageFile']['type'];
    $entreprise = $_POST["entreprise"];
    //Vérifie si le fichier est un PNG ou JPG
    if ($imageType == 'image/png' || $imageType == 'image/jpeg') {
        $destinationPath = "../../images/partenaires/$entreprise.png";
        // le même dossier de destination pour chaque entreprise
        if (move_uploaded_file($imageTmpPath, $destinationPath)) {
            echo 'Conversion terminée, Le logo a été ajouté à votre dossier d\'images.';
        } else {
            header("Location :error_page.php?message=ErreurSauvegardeLogo");
        }
    } else {
        echo 'Veuillez sélectionner une image au format PNG ou JPG.';
    }
}
else{
    echo '<script>alert("Erreur, aucune image détectée")</script>';
}
?>
