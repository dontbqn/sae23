<?php
session_start();
include("./fonctions.php");
setup();
/*
Page Lecteur de Fichiers
*/
pageheader();
pagenavbar("page07.php");
?>
    <body>
        <h1 class="my-4 text-center">
            Lecteur de Fichiers
        </h1>
        <div class="mb-5 container">
            <div class="row offset-2 col-8 p-5 border text-wrap bg-transparent border-2 shadow-md text-break">
                <form class="d-flex justify-content-center" method="POST" enctype="multipart/form-data"> <?php //enctype is used if the usera wants to upload a file throught the form  ?>
                    <label class="me-2">Select a file to upload : </label>
                    <input type="file" id="file_txt" name="file_txt" accept=".txt">
                    <input type="submit" name="submit_file" class="col-3 btn btn-sm btn-outline-warning btn-white" value="Lire ce fichier">
                </form>
                    <?php
                    if (isset($_FILES['file_txt'])) {
                        $file = $_FILES['file_txt']["name"]!="" ? $_FILES['file_txt'] : False;
                        if($file == False){
                            echo '<div class="text-danger fw-bold">Entrez un fichier valide !</div>';
                        }
                        else{
                            $path = $file['tmp_name'];
                            //stock file temporary in file
                            $newfilePath = "usr_file/".$file["name"];
                            move_uploaded_file($path, $newfilePath);
                            echo "<br> <div class='mt-4 p-3 bg-secondary bg-opacity-50 rounded-1 border-white'>";
                            print(file_get_contents($newfilePath));
                            echo '
                            </div>
                            <aside class="mt-4">
                                <ul>
                                    <li><em>name : '.$file["name"].'</em></li>
                                    <li><em>type : '.$file["type"].'</em></li>
                                    <li><em>size : '.$file["size"].' octets</em></li>
                                </ul>
                            </aside>
                            ';
                        }
                    }
                    ?>
            </div>
        </div>



    </body>
    <?php pagefooter(); ?>
</html>



