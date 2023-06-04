<?php
session_start();
include('./annonces.php');
if(!isset($_SESSION)){
    echo '<script>alert("You don\'t have the rights");</script>';
    sleep(2);
    header("Location: page01.php");
}
else{
    if(!(isset($_SESSION['role']) && ($_SESSION['role']=="admin" || $_SESSION['role']=="superadmin"))){
        echo '<script>alert("You don\'t have the rights");</script>';
        sleep(2);
        header("Location: page01.php");
    }
    else{
        include("./fonctions_start.php");
        setup();
        /*
        Page Accueil
        */
        pagenavbar("page06.php");
        $users = json_decode(file_get_contents("data/users.json"), true);
        echo '
            <body>
            <div class="container mb-1 col-10">
                <h1 class="my-4 text-center">Administration</h1>
                <hr>
                <div class="list-group list-group-flush text-center">
                    <a href="#utilisateurs" class="list-group-item list-group-item-action bg-light bg-gradient bg-opacity-25">Gestion Utilisateurs</a>
                    <a href="#annonces" class="list-group-item list-group-item-action bg-light bg-gradient bg-opacity-25">Gestion Annonces</a>
                </div>
                <hr>
                ';
        echo '<div class="mt-2 fw-bold text-center">$_SESSION array content<pre>';
        echo print_r($_SESSION).'</pre></div>';
        echo '
            <h4>Recherchez des utilisateurs</h4>
                <form method="post" class="mb-2">
                    <input type="search" name="input_user" class="shadow-none form_control" placeholder="partie du pseudo">
                    <button type="submit" name="which_user" class="btn badge text-wrap bg-primary">Rechercher</button>
                </form>
        </div>';

        if(!isset($_POST['which_user'])){
                if(!isset($_POST["delete_usr"])){
                    getUsers(null);
                }
                else{
                    $nom = $_POST["username"];
                    $mdp = $_POST["usermdp"];
                    //First verifying who he's in the database
                    $database = json_decode(file_get_contents('data/users.json', true), true);
                    foreach($database as $user){
                        if($user["user"] == $nom && $mdp == $user["mdp"]){
                            deleteUser($user); 
                            getUsers(null);
                            footer();
                            die();
                        }
                    }
                    echo '
                    </div><div class="text-center text-danger fw-bold mb-4 mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle mb-1" viewBox="0 0 16 16">
                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                    </svg> An error might have occurred    <br/>
                    <a type="button" class="btn text-center border border-black mt-3" href="page06.php">reload page</a></div>';

                    
                }
            echo '
                    </tbody>
                    </table>
                    </div>
                </div>';

            if(!isset($_POST["add_user"])){
                echo '
                <h5 class="text-center my-4">Création Utilisateur</h5>
                    <div class="container col-3 d-flex justify-content-center border-4 border mt-2 mb-4 utilisateurs">
                        <form method="post" class="row g-1 p-3 list-group list-group-flush mt-2 mb-3">
                            <div class="form-floating">
                                <select class="form-select form-control list-group-item shadow-none" id="role" name="role" placeholder="role" required>
                ';              echo "<option selected>Choix du rôle</option>";
                                $roles = json_decode(file_get_contents("data/roles.json", true), true);
                                foreach($roles as $role){
                                    $role = $role["name"];
                                    echo "<option value='$role'>$role</option>";
                                }
                                echo '
                                </select>
                                <label class="text-muted" for="role">role</label>
                            </div>
                            <div class="form-floating">
                                <input type="text" class="form-control list-group-item form-floating shadow-none" id="user" name="user" placeholder="username" required>
                                <label class="text-muted" for="user">username</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control list-group-item form-floating shadow-none hidden-ps" id="mdp" name="mdp" placeholder="password" required>
                                <label class="text-muted" for="mdp">password</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control list-group-item form-floating shadow-none hidden-ps" id="mdpverif" name="mdpverif" placeholder="repeat password" required>
                                <label class="text-muted" for="mdpverif">repeat password</label>
                            </div>
                            <div class="form-check form-switch">
                                <input type="checkbox" name="mdp_check" class="form-check-input my-2 p-2" id="yes">
                                <label for="mdp_check"> rendre visible</label>
                            </div>
                            <button type="submit" name="add_user" class="btn btn-success">+</button>
                        </form>
                        <script src="js/pass_verif_admin.js"></script>
                    </div>';
                    echo '<br><br>
                    <div class="position-relative">
                        <div role="alert" aria-live="assertive" aria-atomic="true" class="toast position-absolute show top-50 start-50 translate-middle" data-bs-autohide="false">
                            <div class="toast-header">
                                <img src="images/louis.png" class="rounded ms-1 me-2" alt="bugslogo" width="20" height="20">
                                <strong class="me-auto">Need a reboot ?</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body text-center">
                                <a type="button" href="crea_user.php" class="btn btn-outline-danger" name="resetall">Reset all database (crea_user)</a>
                            </div>
                        </div>
                    </div><br><br>
                    <script src="js/toaster.js"></script>
                    ';
            }
            else{
                if (!isset($_POST["user"]) || !($_POST["mdp"]==$_POST["mdpverif"])) {
                    echo '
                    </div><div class="text-center text-danger fw-bold mb-4 mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle mb-1" viewBox="0 0 16 16">
                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                    </svg> Le mot de passe n\'est pas correct !<br/>
                    <a type="button" class="btn text-center border border-black mt-3" href="page06.php">reload page</a></div>';
                }
                elseif($_POST['role'] == "Choix du rôle"){
                    addUser($_POST['user'],$_POST['mdp']);
                }
                else{
                    addUser($_POST['user'],$_POST['mdp'], $_POST['role']);
                }
            }

        /****************************** The exact same page, after the searching button was clicked (if isset(button))***************************************** */          
        }
        else{
            findUsers($_POST['input_user']);
            echo '
            </tbody>
            </table>
            </div>
        </div>';
        if(!isset($_POST["add_user"])){
            echo '
                <div class="container col-3 d-flex justify-content-center border-4 border mt-2 mb-4 utilisateurs">
                    <form method="post" class="row g-1 p-3 list-group list-group-flush mt-3 mb-3">
                        <div class="form-floating">
                            <select class="form-select form-control list-group-item shadow-none" id="role" name="role" placeholder="role" required>
            ';              echo "<option selected>Choix du rôle</option>";
                            $roles = json_decode(file_get_contents("data/roles.json", true), true);
                            foreach($roles as $role){
                                $role = $role["name"];
                                echo "<option value='$role'>$role</option>";
                            }
                            echo '
                            </select>
                            <label class="text-muted" for="role">role</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control list-group-item form-floating shadow-none" id="user" name="user" placeholder="username" required>
                            <label class="text-muted" for="user">username</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control list-group-item form-floating shadow-none hidden-ps" id="mdp" name="mdp" placeholder="password" required>
                            <label class="text-muted" for="mdp">password</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control list-group-item form-floating shadow-none hidden-ps" id="mdpverif" name="mdpverif" placeholder="repeat password" required>
                            <label class="text-muted" for="mdpverif">repeat password</label>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox" name="mdp_check" class="form-check-input my-2 p-2" id="yes">
                            <label for="mdp_check"> rendre visible</label>
                        </div>
                        <button type="submit" name="add_user" class="btn btn-success">+</button>
                    </form>
                    <script src="js/pass_verif_admin.js"></script>
                </div>';
                echo '
                <div role="alert" aria-live="assertive" aria-atomic="true" class="toast position-static show top-0 end-0" data-bs-autohide="false">
                <div class="toast-header">
                    <img src="images/louis.png" class="rounded ms-1 me-2" alt="bugslogo" width="20" height="20">
                    <strong class="me-auto">Need a reboot ?</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body text-center">
                <form method="post">
                    <a type="button" href="crea_user" class="btn btn-outline-danger" name="resetall">Reset all the user\'s database to default</a>
                </form>
                </div>
            </div>
            <script src="js/toaster.js"></script>
            ';
            }
            else{
                if (!isset($_POST["user"]) || !($_POST["mdp"]==$_POST["mdpverif"])) {
                    echo '
                    </div><div class="text-center text-danger fw-bold mb-4 mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle mb-1" viewBox="0 0 16 16">
                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                    </svg> Le mot de passe n\'est pas correct !<br/>
                    <a type="button" class="btn text-center border border-black mt-3" href="page06.php">reload page</a></div>';
                }
                elseif($_POST['role'] == "Choix du rôle"){
                    addUser($_POST['user'],$_POST['mdp']);
                }
                else{
                    addUser($_POST['user'],$_POST['mdp'], $_POST['role']);
                }
            }
        }
    }
}
    //ANNONCES
    $annonces = json_decode(file_get_contents("annonces/annonces.json"), true);
    getAnnonces($annonces);
    echo '
        <br><br>
        <div class="position-relative mb-3">
            <div role="alert" aria-live="assertive" aria-atomic="true" class="toast position-absolute show top-50 start-50 translate-middle show" data-bs-autohide="false">
                <div class="toast-header">
                    <img src="images/louis.png" class="rounded ms-1 me-2" alt="bugslogo" width="20" height="20">
                    <strong class="me-auto">Need a reboot ?</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body text-center">
                    <a type="button" href="" class="btn btn-outline-danger" name="resetall">Reinitialiser les annonces (newAnnonces)</a>
                </div>
            </div>
        </div><br><br>
    ';
?>      
        <div class="d-flex container-fluid justify-content-evenly">
            <div class="col-5 mb-5 border-dark border border-2 rounded-4 p-3">
                <h5 class="text-center my-4 bg-success p-3">Publier une Offre</h5>
            <?php if(!isset($_POST['annonce_btn'])){ 
                echo '
                <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" class="form-control shadow-none" id="titre" name="titre" placeholder="Barcelone T4 vue sur Mer Thalasso" required>
                        </div>
                        <div class="form-group">
                            <label for="lieu">Lieu</label>
                            <input type="text" class="form-control shadow-none" id="lieu" name="lieu" placeholder="Barcelone" required>
                        </div>
                        <div class="form-group">
                            <label for="pays">Pays</label>
                            <input type="text" class="form-control shadow-none" id="pays" name="pays" placeholder="Espagne" required>
                        </div>
                        <div class="form-group">
                            <label for="prixnuit" class="col-form-label">Prix d\'une nuit</label>
                            <input type="number" class="form-control shadow-none password" name="prixnuit" id="prixnuit" placeholder="23€" min="5" max="50" required>
                        </div>  
                        <div class="form-group form-check form-switch my-2">
                            <input type="checkbox" name="bonplan" class="form-check-input my-2 p-2 shadow-none" id="bonplan">
                            <label for="bonplan" class="pt-1"> Bon Plan &#128293; </label>
                        </div>';
                        //Selection d'images de l'annonce
                        echo '
                        <div class="my-3 form-group">
                        <div class="row offset-2 col-8 p-5 border text-wrap bg-transparent border-2 shadow-md text-break">
                                <label class="me-2">Selectectionnez des photos</label>
                                <input type="file" id="img_files" name="img_files" accept=".jpg,.png">';
                        echo '
                        </div>
                    </div>
                        <div class="mt-2 mb-4">
                            <input type="submit" class="form-control btn btn-warning" id="annonce_btn" name="annonce_btn">
                        </div>
                </form>
                ';
            }
            else{
                //Création de la nouvelle annonce
                //addAnnonce();
                //Redirection vers la page d'annonce nouvellement créée grâce à son id
                var_dump($_FILES["img_files"]);
                $images = $_FILES['img_files']["name"]!= "" ? $_FILES['img_files'] : False;
                                if($images == False){
                                    echo '<div class="text-danger fw-bold">Entrez une photo valide !</div>';
                                }
                                else{
                                    $path = $images['tmp_name'];
                                    //stock file temporary in file
                                    $newfilePath = $images['name'];
                                    //move_uploaded_file($path, $newfilePath);
                                    echo "<br> <div class='mt-4 p-3 bg-secondary bg-opacity-50 rounded-1 border-white'>";
                                    print($newfilePath);
                                    echo '</div>';
                                }
                //addAnnonce($_POST["titre"], $_POST["lieu"], $_POST["pays"], $_POST["prixnuit"], $_POST["description"], $_POST["bon_plan"], $images);
            } ?>
            </div>

            
            <div class="col-5 mb-5 border border-dark border-2 rounded-4 p-3">
                <h5 class="text-center my-4 bg-warning p-3">Modifier une Offre</h5>
                <?php if(!isset($_POST['modif_annonce'])){  // Modifier une Annonce
                    echo '
                        <form name="form_modif" method="post" action="'.$_SERVER['PHP_SELF'].'">
                                <div class="form-group">
                                    <div class="form-floating">
                                        <select  class="form-select form-control list-group-item shadow-none" id="titre_annonce" name="titre_annonce" placeholder="Annonce à modifier" required>';              
                                        foreach($annonces as $annonce){
                                            $annonce = $annonce["titre"];
                                            echo '<option onclick="onSelectChange();" value="'.$annonce.'">'.$annonce.'</option>';
                                        }
                                        echo '
                                        </select>
                                        <label class="text-muted" for="titre_annonce">Annonce à modifier</label>
                                    </div>
                                <script src="js/select_annonce.js"></script>
                                </div>
                                <div class="form-group">
                                    <label for="nv_titre">Titre</label>';
                                    if(isset($_POST["titre_annonce"])){
                                        print_r($_POST["titre_annonce"]);
                                    }
                                    echo '
                                    <input type="text" class="form-control shadow-none" id="nv_titre" name="nv_titre" placeholder="" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nv_lieu">Nouveau Lieu</label>
                                    <input type="text" class="form-control shadow-none" id="nv_lieu" name="nv_lieu" placeholder="" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nv_pays">Nouveau Pays</label>
                                    <input type="text" class="form-control shadow-none" id="nv_pays" name="nv_pays" placeholder="" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nv_prixnuit" class="col-form-label">Nouveau Prix d\'une nuit</label>
                                    <input type="text" class="form-control shadow-none password" name="nv_prixnuit" id="nv_prixnuit" readonly>
                                </div>  
                                <div class="form-group form-check form-switch my-2">
                                    <input type="checkbox" name="bonplan" class="form-check-input my-2 p-2 shadow-none" id="bonplan">
                                    <label for="bonplan" class="pt-1"> Bon Plan &#128293; </label>
                                </div>
                                <div class="my-3 form-group">
                                    <div class="row offset-2 col-8 p-5 border text-wrap bg-transparent border-2 shadow-md text-break">
                                        <form class="d-flex justify-content-center" method="POST" enctype="multipart/form-data">
                                            <label class="me-2">Selectectionnez des photos</label>
                                            <input type="file" id="file_txt" name="file_txt" accept=".jpg,.png">
                                        </form>
                                    </div>
                                </div>
                                <div class="mt-2 mb-4">
                                    <input type="submit" class="form-control btn btn-warning" id="modif_annonce" name="modif_annonce">
                                </div>
                        </form>
                     ';
                }
                else{
                    // Affichage de la nouvelle annonce
                    // Quand l'admin choisit l'annonce avec le <select>



                } ?>
            </div>
        </div>
    </body>
    <?php footer(); ?>
</html>