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
        <h1 class="text-center pt-4 pb-2 mt-3">Fichiers TripKing</h1>
        <h5 class="text-center pt-4">Lire le fichier de votre choix</h5>
        <div class="container pt-2 pb-3 my-4 d-flex justify-content-center">
            <div class="col-9 bg-black border border-success border-5 rounded-5 ps-5 py-4"> 
                <?php 
                $directory = __DIR__; // current directory
                $files = scandir($directory); // List files and directories inside the specified path
                $files = array_diff($files, array('.', '..','.git')); // Hide current file employee2421.php, bagel.php for example

                echo '<ul class="my-2 list-group list-group-vertical list-unstyled">';
                foreach ($files as $file) {
                    $filePath = $directory.DIRECTORY_SEPARATOR.$file;
                    if(is_dir($filePath)){
                        echo '<ul class="my-2 list-group list-group-horizontal list-unstyled">';
                        //echo getcwd().DIRECTORY_SEPARATOR.$file; //Gets the current working directory
                            echo '<li class="py-1"><a class="link-warning" href="?file='.DIRECTORY_SEPARATOR.$file.'"><kbd>'.$file.'</kbd></a></li>';
                            $subFiles  = scandir($filePath);
                            $subFiles = array_diff($subFiles, array('.', '..')); // Hide parent and current directory (./ and ../)
                            foreach($subFiles as $subFile){
                                $subFilePath = $file.DIRECTORY_SEPARATOR.$subFile;
                                echo '<li class="py-1"> > <a class="link-success" href="?file='.urlencode($subFilePath).'"><kbd>'.$subFile.'</kbd></a></li>';
                            }
                        echo '</ul>';
                    }
                    else{
                        echo '<li class="py-1"><a class="link-primary" href="?file='.urlencode($file).'"><kbd>'.$file.'</kbd></a></li>';
                    }
                }
                echo '
                    </ul>
            </div>
        </div>
                ';
                // Lecture de fichier
                if(isset($_GET['file'])) {
                    // TESTS DE FONCTIONNEMENT
                    $selectedFile = $_GET['file'];
                    echo '<div class="text-center">fichier/dossier selectionné : '.$selectedFile.'</div>'; 
                    $filePath = __DIR__.DIRECTORY_SEPARATOR.$selectedFile; 
                    echo '<div class="text-center">chemin vers celui-ci : '.$filePath.'</div>'; 
                        
                    // Si il existe 
                    // realpath() : the canonicalized absolute pathname on success. The resulting path will have no symbolic link, '/./' or '/../' components.
                    if(strpos(realpath($filePath), __DIR__) === 0 && file_exists($filePath)) { 
                        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                        echo '<div class="text-center">extension : '.$fileExtension.'</div><br/>';
                        echo '<div class="container border border-3 rounded-3 py-3 px-4 border-success bg-black bg-opacity-50 text-white">';

                        if($fileExtension == null){
                            echo '<div class="text-center text-danger bg-dark"> that\'s a directory  : '.$filePath.', let\'s see what\'s inside : </div>';
                            $selectedDir = scandir($filePath);
                            $selectedDir = array_diff($selectedDir, array('.', '..'));  // Hide current file employee221.php, bagel.php for example            
                            echo '<ul class="col-4 list-group list-goup-vertical list-unstyled">';
                                foreach($selectedDir as $dirFile){
                                    echo $filePath.DIRECTORY_SEPARATOR.$dirFile;
                                    echo '<li><a class="list-group-item list-group-item-warning link-primary" href="?file='.urlencode($selectedFile . DIRECTORY_SEPARATOR . $dirFile).'"><kbd>'.$dirFile.'</kbd></a></li>';
                                }
                            echo '</ul>';
                        }
                        else{
                            if ($fileExtension === 'gif') {
                                echo '<h6>Contenu du gif '.$filePath.'</h6>';
                                echo '<img src="'.$filePath.'" alt="GIF Image">';
    
                            } elseif($fileExtension === 'mp4'){
                                echo '<h6>Contenu du mp4 '.$filePath.'</h6>';
                                echo '<video controls>';
                                    echo '<source src="'.$filePath.'" type="video/mp4">';
                                echo '</video>';
                            } else{
                                echo '<p>"'.$filePath.'"</p>';
                                echo '<div class="container p-5 text-white-50">';
                                    $result = (file_get_contents($filePath, true));
                                    echo highlight_string($result, true);
                                echo '</div>';
                            }
                        }
                    } else { // File does'nt exist
                        echo '<p class="text-center text-warning bg-secondary my-3">vardump du fichier inexistant :  ';
                        var_dump(basename($selectedFile));
                        echo 'Le fichier sélectionné n\'existe pas.</p>';
                    }
                    echo '</div>';
                }
                //Ajouter un Fichier
                ?>
            
            <div class="mb-5 container col-8 p-5 my-4 border border-2 shadow-md text-break">
                <h5 class="my-1">Ajouter un fichier depuis votre PC</h5>
                <form class="d-flex justify-content-center" method="POST" enctype="multipart/form-data"> 
                    <?php //enctype "multipart/form-data" is used if the usera wants to upload a file throught the form  ?>
                    <label class="me-2">Select a file to upload : </label>
                    <input type="file" id="file_input" name="file_input" accept=".txt, .php, .js, .csv, .odt, .pdf">
                    <input type="submit" name="submit_file" class="col-3 btn btn-sm btn-outline-warning btn-white" value="Lire ce fichier">
                </form>
                    <?php
                        if (isset($_FILES['file_input'])) {
                            $file = $_FILES['file_input'];
                            if ($file['name'] != "") {
                                $path = $file['tmp_name'];
                                if (isset($_GET['file'])) {
                                    // On récupère dans l'URL, si l'utilisateur a cliqué sur un dossier,
                                    // le chemin vers celui-ci. Et on ajoute le fichier de l'utilisateur
                                    // dedans.
                                    $selectedFile = $_GET['file'];
                                    $filePath = __DIR__.DIRECTORY_SEPARATOR.trim($selectedFile, '/');
                                    // trim () : Strip whitespace (or other characters) from the beginning and end of a string

                                    if (is_dir($filePath)) {
                                        $newFilePath = $filePath.DIRECTORY_SEPARATOR.$file['name'];
                                        if (move_uploaded_file($path, $newFilePath)) {
                                            echo '<div class="text-success fw-bold">Le fichier a été ajouté avec succès dans le dossier '.$selectedFile.' !</div>';
                                            echo "<br><div class='mt-4 p-4 fs-6 bg-secondary bg-opacity-50 rounded-1 border-white'>";
                                            echo htmlspecialchars(file_get_contents($newFilePath));
                                            echo '</div>
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
                                        /*
                                            On va répéter 2 fois le même code : 
                                            1 fois pour créer un fichier à la racine (tripking/)
                                            même si le paramètre est un fichier php (exemple : ?file=fichier.php)
                                            et non un chemin
                                            Et une 2eme fois lorsqu'il n'ya pas de paramètre 'file' dans l'URL
                                        */
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
                                    }
                                } else {
                                    // Aucun dossier cliqué, donc on ajoute dans le fichier actuel 
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
                        <img src="../images/twitter.png" alt="" width="40" height="40">
                    </button>
                    <button href="https://www.instagram.com/tripking/" class="btn">
                        <img src="../images/insta.png" alt="" width="40" height="40">
                    </button>
                    <button href="www.facebook.com/tripking/" class="btn">
                        <img src="../images/facebook.png" alt="" width="40" height="40">
                    </button>
                </div>
            </div>
        <div class="d-flex flex-column flex-sm-row justify-content-center py-4 my-4 border-top">
            <p>&copy; 2022 Company, Inc. All rights reserved.</p>      
        </div>
    </footer>
</html>
