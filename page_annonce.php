<?php
session_start();
include("./fonctions_start.php");
include("./annonces.php");
setup();
pagenavbar("page_annonce.php");
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
                <div class="mx-5 border border-2 rounded-4 shadow my-2 p-3">
                    <div class="row">
                        <div class="col-9">
                            <div class="row">
                                <h1 class="">'.$thisannonce["titre"].'</h1>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h2 class="fs-3">&#128205;'.$thisannonce["lieu"].', '.$annonce["pays"].'</h2>
                                </div>
                                <div class="text-end p-2 me-2 link-black">
                                    <button class="badge bg-dark rounded-pill text-decoration-none partage">partager</button>
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
                        <div class="card col-7 ms-1">
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
                                            <img src="'.$thisannonce["images"][$key].'" class="d-block w-100 rounded-4" alt="Slide'.$key.'" style="cursor: zoom-in;">
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
                        <div class="col-4 border border-black border-4 p-4">
                            NUIT + ARRIVE / DEPART DATES + NBRE VOYAGEur + RESERVER
                            <form method="post" action="./reservations.php">
                                <div class="">
                                    <label for="voyageurs"> Voyageur(s) </label>
                                    <select>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                                <div class="btn btn-lg">
                                    <button type="submit" value="reserve">RESERVER</button>
                                </div>
                            </form>
                        </div>



                            
                            <div>
                                <h3>A propos de ce logement</h3>
                                <article>
                                    annonce description
                                    
                                </article>
                                <br/>
                                <h5 class="link-dark">Commentaires :<h5>
                                <div>';
                                    //Affichage des commentaires
                                    $commentaires = ($thisannonce['commentaires']);
                                    foreach($commentaires as $id_commentaire){
                                        $data_coms = json_decode(file_get_contents("./data/commentaires.json"), true);
                                        foreach($data_coms as $commentaire){
                                            if($commentaire['id'] == $id_commentaire){
                                                echo '<div class="card p-3 col-6">';
                                                echo $commentaire["id"];
                                                echo "<br>note : ".$commentaire["note"];
                                                echo '<div class="card-header">';
                                                echo $commentaire["titre"];
                                                echo '</div>';
                                                echo "auteur : ".$commentaire["auteur"];echo "<br>";
                                                echo "message : ".$commentaire["message"];echo "<br>";
                                                echo "</div>";
                                            }
                                        }
                                    }

                        echo '
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <h3 class="fs-4 text-center">Annonces qui pourraient vous plaire</h3>
                            <div class="list-group list-group-flush">
                        ';
                        // Annonces qui pourraient vous plaire
                            $max = count($annonces);
                            $ints = [];
                            $j=1;
                            foreach($annonces as $ann){
                                if($thisannonce["id"]!=$j){
                                    echo '
                                    <div class="list-group-item">
                                        <img src="'.$ann["images"][0].'" class="d-block w-100 rounded-4">
                                    </div>
                                        ';
                                }
                                $j++;
                            }
                            //$j = random_int(0, $max);
                            //array_push($ints, $j);
                            //array_unique($ints);

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