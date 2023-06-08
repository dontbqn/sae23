<?php
session_start();
include("./fonctions_start.php");
/*
Page Accueil
*/
setup();
pagenavbar("page01.php");

?>
<body>
<body>
    <?php
    // Tableau des partenaires
    $partenaires = array();

    // Charger les partenaires à partir du fichier JSON
    $jsonFile = 'data/partenaires.json';
    if (file_exists($jsonFile)) {
        $partenairesJson = file_get_contents($jsonFile);
        $partenaires = json_decode($partenairesJson, true);
    }

    // Ajouter un partenaire
    if (isset($_POST['ajouter'])) {
        $nouveauNom = $_POST['nouveauNom'];
        $nouvelleImage = $_FILES['nouvelleImage']['name'];
        $nouveauPartenaire = array('nom' => $nouveauNom, 'image' => $nouvelleImage);
        array_push($partenaires, $nouveauPartenaire);

        // Enregistrer les partenaires dans le fichier JSON
        $partenairesJson = json_encode($partenaires, JSON_PRETTY_PRINT);
        file_put_contents($jsonFile, $partenairesJson);
    }

    // Supprimer un partenaire
    if (isset($_GET['supprimer'])) {
        $index = $_GET['supprimer'];
        unset($partenaires[$index]);

        // Réindexer les clés du tableau
        $partenaires = array_values($partenaires);

        // Enregistrer les partenaires mis à jour dans le fichier JSON
        $partenairesJson = json_encode($partenaires, JSON_PRETTY_PRINT);
        file_put_contents($jsonFile, $partenairesJson);
    }

    // Afficher les partenaires
    foreach ($partenaires as $index => $partenaire) {
        echo '<div class="carte">';
        echo '<h3>' . $partenaire['nom'] . '</h3>';
        echo '<img src="' . $partenaire['image'] . '" alt="' . $partenaire['nom'] . '">';
        echo '<a href="?supprimer=' . $index . '">Supprimer</a>';
        echo '</div>';
    }
    ?>

    <h2>Ajouter un partenaire</h2>
    <form method="POST" enctype="multipart/form-data">
        <label for="nouveauNom">Nom du partenaire:</label>
        <input type="text" id="nouveauNom" name="nouveauNom" required><br><br>
        <label for="nouvelleImage">Image du partenaire:</label>
        <input type="file" id="nouvelleImage" name="nouvelleImage" required><br><br>
        <input type="submit" name="ajouter" value="Ajouter">
    </form>
</body>
    <?php footer(); ?>
</html>