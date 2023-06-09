<?php
session_start();
?>
<!DOCTYPE HTML>
<html>   
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Bastien, Aronn, Clément, Adrien">
        <link rel="icon" href="images/iconetk.ico">
        <title>Intranet T.K</title>
        <meta name="viewport" content="width=device-width">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">    
    </head>
    <body>
        <h1 class="text-center pt-4 pb-3 my-3">Mes Fichiers</h1>
        <div class="container d-flex justify-content-center pt-4 pb-3 my-5">
            <div class="col-6">
                <h5 class="pt-4 pb-3 my-3">Lire le fichier de votre choix</h5>
                <?php 
                $directory = __DIR__; // current directory
                $files = scandir($directory);
                $files = array_diff($files, array('.', '..',$_SESSION['user'].".php")); //Hide current file employee2421.php, bagel.php for example

                echo '<ul class="files bg-black p-3 my-3 mx-2 list-unstyled border border-3 border-success">';
                foreach ($files as $file) {
                    echo '<li><kbd><a type="button" href="?file='.$file.'">'.$file.'</a></kbd></li>';
                }

                echo '
                    </ul>
                    </div>
                ';

                echo '
                <form class="col-6" method="post">
                    <label for="select">Modifier un fichier</label>
                    <select id="select" name="file" class="bg-secondary bg-gradient p-2">
                    <optgroup label="Vos Fichiers" class="bg-dark text-white">                  
                    ';
                    foreach ($files as $file) {
                        echo '<option type="button" value="'.$file.'">'.$file.'</option>';
                    }
                    echo '
                        </optgroup>
                    </select>
                    <button type="submit" class="btn btn-dark btn-outline-warning" name="modif">Choisir</button>
                </form>
                </div>
                ';
                // Modification fichier
                if(isset($_POST['modif'])) {
                    echo '
                    <div class="text-center text-white m-4 p-3 border border-3 border-success bg-black">
                        modification du fichier suivant : '.$_POST["file"].'<br/><br/>
                        
                        <textarea name="modified_file" class="" style="min-width:1000px;min-height:400px">'.file_get_contents($directory.DIRECTORY_SEPARATOR.$_POST["file"]).'</textarea>
                    </div>';
                }


                // Lecture de fichier
                if(isset($_GET['file'])) {
                    $selectedFile = $_GET['file'];
                    $filePath = $directory.DIRECTORY_SEPARATOR.$selectedFile; // Pour s'adapter à Windows et Linux
    
                    if (file_exists($filePath)) {
                        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                        echo '<div class="container border border-3 rounded-3">';
                        if ($fileExtension === 'gif') {
                            echo '<h6>Contenu du gif '.$filePath.'</h6>';
                            echo '<img src="'.$filePath.'" alt="GIF Image">';

                        } elseif($fileExtension === 'mp4'){
                            echo '<h6>Contenu du mp4 '.$filePath.'</h6>';
                            echo '<video controls>';
                            echo '<source src="'.$filePath.'" type="video/mp4">';
                            echo 'Your browser does not support the video tag.';
                            echo '</video>';
                        } else{
                            echo '<p>"'.$filePath.'"</p>';
                            echo '<div class="container p-5">';
                            echo htmlspecialchars(file_get_contents($filePath));
                            echo htmlspecialchars(file_get_contents($filePath));
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Le fichier sélectionné n\'existe pas.</p>';
                    }
                    echo '</div>';
                }


                ?>

            <div class="mb-5 container col-8 p-5 my-4 border border-2 shadow-md text-break">
                <h5 class="my-1">Ajouter un fichier depuis votre PC</h5>
                <form class="d-flex justify-content-center" method="POST" enctype="multipart/form-data"> 
                    <?php //enctype "multipart/form-data" is used if the usera wants to upload a file throught the form  ?>
                    <label class="me-2">Select a file to upload : </label>
                    <input type="file" id="file_txt" name="file_txt" accept=".txt, .php, .js, .csv, .odt, .pdf, .png, .jpg">
                    <input type="submit" name="submit_file" class="col-3 btn btn-sm btn-outline-warning btn-white" value="Ajouter ce fichier">
                </form>
                    <?php
                    if (isset($_FILES['file_txt'])) {
                        $file = $_FILES['file_txt'];
                        if ($file['name'] != "") {
                            $path = $file['tmp_name'];
                            $newFilePath = __DIR__.DIRECTORY_SEPARATOR.$file['name'];
                            echo $newFilePath;
                            if (move_uploaded_file($path, $newFilePath)) {
                                echo '<div class="text-success fw-bold">Le fichier a été ajouté avec succès !</div>';
                                echo "<br><div class='mt-4 p-4 fs-6 bg-secondary bg-opacity-50 rounded-1 border-white'>";
                                echo htmlspecialchars(file_get_contents($newFilePath));
                                echo '
                                </div>
                                <aside class="mt-4">
                                    <ul>
                                        <li><em>name: '.$file['name'].'</em></li>
                                        <li><em>type : '.$file['type'].'</em></li>
                                        <li><em>size: '.$file['size'].' octets</em></li>
                                    </ul>
                                </aside>';
                            } else {
                                echo '<div class="text-danger fw-bold">Une erreur est survenue lors de l\'ajout du fichier.</div>';
                            }
                        } else {
                            echo '<div class="text-danger fw-bold">Entrez un fichier valide !</div>';
                        }
                    }
                    ?>
            </div>
    </body>
    <footer class="container mt-2 pt-5">
        <div class="container text-center">
                <div>
                    <button href="https://www.twitter.com/tripking/" class="btn">
                        <img src="../../../images/twitter.png" alt="" width="40" height="40">
                    </button>
                    <button href="https://www.instagram.com/tripking/" class="btn">
                        <img src="../../../images/insta.png" alt="" width="40" height="40">
                    </button>
                    <button href="www.facebook.com/tripking/" class="btn">
                        <img src="../../../images/facebook.png" alt="" width="40" height="40">
                    </button>
                </div>
            </div>
        <div class="d-flex flex-column flex-sm-row justify-content-center py-4 my-4 border-top">
            <p>&copy; 2022 Company, Inc. All rights reserved.</p>      
        </div>
    </footer>
</html>
