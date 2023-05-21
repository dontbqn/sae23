<?php
session_start();
include("./fonctions.php");
include("./annonces.php");
setup();
pageheader();
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
                <h1 class="my-2 text-center">
                    Annonce n°'.$thisannonce["id"].'
                </h1>
                <div class="container border border-2 rounded-4 shadow my-2 p-3">
                    <div class="row">
                        <div class="col-9">
                            <div class="row">
                                <div class="">
                                    <h1>'.$thisannonce["titre"].'</h1><h2>&#128205;'.$thisannonce["lieu"].', '.$annonce["pays"].'</h2>
                                </div>
                                <div class="align-items-end">
                                    <button class="badge bg-primary rounded-pill text-decoration-none partage">partager</button>
                                    
                                    <div class="menu-partage visually-hidden" style="cursor:pointer">
                                        <a id="twitter-link" class="link-underline-danger">Twitter</a>
                                        <a id="insta-link" class="link-underline-danger">Instagram</a>
                                        <a id="facebook-link" class="link-underline-danger">Facebook</a>
                                    </div>
                                    <script src="./js/partage.js"></script>
                                </div>
                            </div>
                            <hr>
                            <div class="card">
                                <div class="card-body">';
                            // Ajouter toutes les images (4 max on va dire), et qu'on puisse cliquer dessus
                            // pour déclencher un carousel
                            foreach($thisannonce["images"] as $img){
                                echo '<img src="'.$img.'" width="200" height="200" title="cliquez pour zoomer" style="cursor: zoom-in;"/>';
                            }

                            echo '
                                </div>
                            </div>
                            <div class="col-6 border border-black border-4 p-4">
                                NUIT + ARRIVE / DEPART DATES + NBRE VOYAGEur + RESERVVER
                                <form method="post">
                                    <div class="">
                                        <label for="voyageurs"> Voyageur(s) </label>
                                        <select>
                                            <option value="1">
                                            <option value="2">
                                            <option value="3">
                                            <option value="4">
                                        </select>
                                    </div>
                                    <div class="">
                                        <button type="submit" value="reserve">RESERVER</button>
                                    </div>
                                </form>
                            </div>
                            
                            <div>
                                <h3>A propos de ce logement</h3>
                                <article>
                                    annonce description
                                    
                                </article>
                                <h5 class="link-dark">Commentaires :<h5>
                                <div>';
                                    //Affichage des commentaires
                                    $commentaires = ($thisannonce['commentaires']);
                                    foreach($commentaires as $id_commentaire){
                                        $data_coms = json_decode(file_get_contents("./data/commentaires.json"), true);
                                        foreach($data_coms as $commentaire){
                                            if($commentaire['id'] == $id_commentaire){
                                                echo $commentaire["id"];
                                                echo "<br>";
                                                echo $commentaire["titre"];echo "<br>";
                                                echo "auteur : ".$commentaire["auteur"];echo "<br>";
                                                echo "note : ".$commentaire["note"];echo "<br>";
                                                echo "message : ".$commentaire["message"];echo "<br>";
                                            }
                                        }
                                    }

                                echo '
                                </div>
                            </div>







                        </div>
                        <div class="col-3">
                            <h3>Annonces au hasard</h3>
                            déterminé selon id et randint()
                            <div class="list-group-item">
                                <div class="card">
                                    1
                                </div>
                                <div class="card">
                                    2
                                </div>
                                <div class="card">
                                    3
                                </div>
                                <div class="card">
                                    4
                                </div>
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
        
    </body>
</html>