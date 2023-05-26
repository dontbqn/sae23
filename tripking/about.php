<?php
session_start();
/*
Page Qui sommes-nous ?

*/
include("./fonctions_start.php");
setup();
pagenavbar("about.php");
?>
<body>

    <h1 class="my-4 text-center">
        Qui sommes-nous ?
        <hr>
    </h1>
    <h1 class="my-4 text-center">Liste des partenaires</h1 >

    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Date de naissance</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $personnages = json_decode(file_get_contents("data/partenaires.json"), true);
                    foreach ($personnages as $personnage) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $personnage['id'] ?></th>
                            <td><?php echo $personnage['prenom'] ?></td>
                            <td><?php echo $personnage['nom'] ?></td>
                            <td><?php echo $personnage['date_naissance'] ?></td>
                            <td style="border: none"><a href="tripking/supprimer_personnage.php?id=<?php echo $personnage['id'] ?>" class="btn btn-sm btn-danger material-icons">close</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <h2 class="my-4">Ajouter un personnage</h2>
        <form action="tripking/ajouter_personnage.php">
            <div class="form-row my-4">
                <div class="offset-1 col-3">
                    <input type="text" class="form-control" placeholder="Prénom" name="prenom" required>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" placeholder="Nom" name="nom" required>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" placeholder="Date de naissance" name="date_naissance" required>
                </div>
                <div class="col-2">
                    <input type="submit" class="btn btn-success" value="Ajouter">
                </div>
            </div>
        </form>
    </div>



    </body>
    <?php footer(); ?>
</html>




