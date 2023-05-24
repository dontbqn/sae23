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
                    <a href="#utilisateurs" class="list-group-item list-group-item-action">Gestion Utilisateurs</a>
                    <a href="#annonces" class="list-group-item list-group-item-action">Gestion Annonces</a>
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
                                <input type="password" class="form-control list-group-item form-floating shadow-none passwords" id="mdp" name="mdp" placeholder="password" required>
                                <label class="text-muted" for="mdp">password</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control list-group-item form-floating shadow-none passwords" id="mdpverif" name="mdpverif" placeholder="repeat password" required>
                                <label class="text-muted" for="mdpverif">repeat password</label>
                            </div>
                            <div class="form-check form-switch">
                                <input type="checkbox" name="mdp_check" class="form-check-input my-2 p-2" id="dontwatchme">
                                <label for="mdp_check"> rendre visible</label>
                                <script src="js/pass_verif.js"></script>
                            </div>
                            <button type="submit" name="add_user" class="btn btn-success">+</button>
                        </form>
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
                            <input type="password" class="form-control list-group-item form-floating shadow-none passwords" id="mdp" name="mdp" placeholder="password" required>
                            <label class="text-muted" for="mdp">password</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control list-group-item form-floating shadow-none passwords" id="mdpverif" name="mdpverif" placeholder="repeat password" required>
                            <label class="text-muted" for="mdpverif">repeat password</label>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox" name="mdp_check" class="form-check-input my-2 p-2" id="dontwatchme">
                            <label for="mdp_check"> rendre visible</label>
                            <script src="js/pass_verif.js"></script>
                        </div>
                        <button type="submit" name="add_user" class="btn btn-success">+</button>
                    </form>
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
    </body>
    <?php footer(); ?>
</html>