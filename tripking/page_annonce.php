<?php
session_start();
include("./fonctions_start.php");
include("./annonces.php");
setup();
pagenavbar("page_annonce.php");
//newAnnonce();
$thisannonce;
?>
    <body>
        <?php 
        if(isset($_GET["id"])){ //Javascript mettre à jour le placeholder à partir de 2 ou 3 phrases
            $annonces = json_decode(file_get_contents("./annonces/annonces.json"), true);
            foreach($annonces as $annonce){
                if($_GET["id"] == $annonce['id']){
                    //var_dump($annonce);
                    $thisannonce = $annonce;
                    break;
                }
            }
            echo '
                <h1 class="mt-5 mb-3 text-center">
                    Annonce n°'.$thisannonce["id"].'
                </h1>
                <div class="mx-5 rounded-4 shadow my-2 p-3">
                    <div class="container-fluid p-3">
                        <div class="row">
                            <h1>'.$thisannonce["titre"].'</h1>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <h2 class="fs-3">&#128205;'.$thisannonce["lieu"].', '.$annonce["pays"].'</h2>
                            </div>
                            <div class="text-end p-2 me-2 link-black">
                                <button class="badge bg-dark rounded-pill text-decoration-none partage py-2 px-3">partager</button>
                                <div class="menu-partage visually-hidden" style="cursor:pointer">
                                    <a id="twitter-link" class="link-underline-danger link-dark">Twitter</a>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                                        </svg>
                                    <a id="insta-link" class="link-underline-danger link-dark">Instagram</a>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                        </svg>
                                    <a id="facebook-link" class="link-underline-danger link-dark">Facebook</a>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                        </svg>
                                </div>
                                <script src="./js/partage.js"></script>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="row border rounded-4 p-3 d-flex justify-content-center bg-gradient">
                        <div class="card col-6 ms-1 border-0">
                            <div class="card-body">';
                        // Carousel des images de la location
                        echo '
                            <div id="carouselCap" class="carousel slide rounded-5">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselCap" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>';
                                    $nb_img = count($thisannonce["images"]); //nbre d'images pour cette annonce
                                    for($i=1;$i<$nb_img;$i++){
                                        echo '<button type="button" data-bs-target="#carouselCap" data-bs-slide-to="'.$i.'" aria-label="Slide'.$i.'"></button>';
                                    }
                        echo '
                                </div>
                            <div class="carousel-inner">
                                ';
                                // Ajouter toutes les images (4 max on va dire), et qu'on puisse cliquer dessus
                                // pour déclencher un carousel
                                foreach($thisannonce["images"] as $key => $img){
                                    echo '                    
                                        <div class="carousel-item">
                                            <img src="'.$thisannonce["images"][$key].'" class="d-block w-100 rounded-4" alt="Slide'.$key.'" style="cursor: zoom-in;max-height:482px;">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5>'.$thisannonce["titre"].'</h5>
                                                <p>'.$thisannonce["lieu"].'</p>
                                            </div>
                                        </div>                                
                                        ';
                                }
                        echo '
                                <script> // Enable the first slide so the carousel works.
                                    const img1 = document.querySelectorAll(".carousel-item");
                                    console.log(img1);
                                    img1[0].classList.add("active");
                                </script>   
                            </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselCap" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselCap" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 border border-3 p-5 my-3">
                        <form method="post" action="./reservations.php">
                            <div class="d-flex justify-content-evenly">
                                    <div class="form-floating border border-1">
                                        <input type="date" class="form-control" id="floatdepart" placeholder="14/06/23">
                                        <label for="floatdepart">DEPART</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="floatarrivee" placeholder="14/06/23">
                                        <label for="floatarrivee">ARRIVEE</label>
                                    </div>
                            </div>
                            <div class="mt-3 mb-3 d-flex justify-content-evenly">
                                <label for="voyageurs" class="form-label">Voyageur(s)</label>
                                <select class="form-select" name="voyageurs" id="voyageurs" style="max-width:20px;">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                            <hr class="bg-dark">
                            <div class="d-flex justify-content-center">
                                <strong class="">TOTAL</strong>';

                                    if(isset($_POST["reserve"])){
                                        $jours = $_POST["jours"];
                                        $price = $thisannonce["prix_nuit"]*$jours;
                                        echo $price;
                                    }
                                    else{
                                        echo '<span class="ms-4">0</span>';
                                    }

                                    echo'
                            </div>
                            <div class="mt-1 text-center mx-auto">
                                <button type="submit" class="btn btn-xl bg-light border border-1 border-dark" value="reserve">RESERVER</button>
                            </div>
                        </form>
                    </div>
                    <span class="font-monospace align-self-end mt-auto">référence #'.$thisannonce["id"].'</span>
                    </div>


                        <div class="container-fluid border border-2 mt-4 p-3">
                            <h3>A propos de ce logement</h3>
                            <article>
                                '.$thisannonce["description"].'
                                
                            </article>
                            <br/>';
                            //Affichage des commentaires
                            $data_coms = json_decode(file_get_contents("./data/commentaires.json"), true);
                            $commentaires = ($thisannonce['commentaires']);
                            $somme = 0;
                            $count = count($commentaires);
                            foreach($commentaires as $id_commentaire){
                                foreach($data_coms as $commentaire){
                                    if($commentaire['id'] == $id_commentaire){
                                        $somme+=$commentaire["note"];
                                        break;
                                    }
                                }
                            }
                            echo '
                            <a class="link-underline-light link-secondary fs-4 mb-2 p-0">'.$count.' Commentaires :  <a><span class="fs-4 fw-semibold">'.number_format((float)($somme/$count), 1, '.', '').'<span class="fs-6">/5</span> &#9733;</span>
                            <div class="d-flex p-2 overflow-x-scroll">';                                                                                // Moyenne des notes enregistrées
                                //newCommentaires(); pour reinitaliser la base
                                foreach($commentaires as $id_commentaire){
                                    foreach($data_coms as $commentaire){
                                        if($commentaire['id'] == $id_commentaire){
                                            echo '<div class="card p-3 col-6 mx-2">';
                                            echo '<div class="card-header">';
                                                echo '<div class="row">';
                                                    echo '<div class="col-2 font-monospace">';
                                                        echo $commentaire["id"];
                                                    echo '</div>
                                                    <div class="col-8">';
                                                        echo '<span class="fw-bold fs-5">'.$commentaire["titre"];echo "</span><br>";
                                                    echo '</div>
                                                    <div class="col-2">';
                                                        echo $commentaire["note"].'<span class="fs-6">/5</span> &#9733;';
                                                    echo '</div>';
                                                    echo '<span class="fst-italic fs-5 p-1">'.$commentaire["auteur"];echo "</span><br>";

                                                echo '</div>';
                                                echo '</div>';
                                                echo '<div class="card-body">';
                                                    echo $commentaire["message"];echo "<br>";
                                                echo "</div>";
                                            echo "</div>";
                                        }
                                    }
                                }
                    echo '
                                </div>
                            </div>
                        </div>
                    ';

                    echo '
                        <div class="col-8 mx-auto my-5">
                            <h3 class="fs-4 text-center mt-1 pt-2">Annonces qui pourraient vous plaire</h3>
                            <div class="row g-4">
                        ';
                        $max = 5; // Nombre maximum d'annonces à afficher
                        $count = 0; // Compteur pour le nombre d'annonces affichées
                        $annonces = json_decode(file_get_contents("./annonces/annonces.json"), true);

                        foreach($annonces as $annonce){
                            if ($count >= $max) {
                                break; // Sortir de la boucle si le nombre maximum d'annonces est atteint
                            }
                            echo '
                                <div class="col-4 py-2">
                                    <a type="button" class="text-decoration-none link-dark" href="page_annonce.php?id='.$annonce['id'].'">
                                    ';
                                    echo '
                                        <img src="'.$annonce["images"][0].'" class="w-100 rounded-4" style="max-height:190px">
                                        <figcaption class="overflow-x-hidden">'.$annonce["nb_fav"].' &#10084; '.$annonce["titre"].'</figcaption>
                                    </a>
                                </div>
                            ';
                            $count++;
                        }

                        echo '
                            </div>
                        </div>
                    </div>
            </div>
                    ';
        }
        else{
            echo '
            </div><div class="text-center text-danger fw-bold mb-4 mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle mb-1" viewBox="0 0 16 16">
            <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
            </svg>Cette annonce n\'existe pas !    <br/>
            <a type="button" class="btn text-center border border-black mt-3" href="../explorer.php">Partez à la recherche d\'un nouveau trip</a></div>';
        }
        ?>
        <?php footer(); ?>
    </body>
</html>