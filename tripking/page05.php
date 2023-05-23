<?php
session_start();
include("./fonctions_start.php");
setup();
/*
Page Fichier Utilisateur
*/
pagenavbar("page05.php");
?>
    <body>

        <h1 class="my-4 text-center bg-black bg-opacity-25" style="color:<?php $session = isset($_SESSION['favcolor']) ? $_SESSION['favcolor'] : "" ?>;">
            Fichier Utilisateur
        </h1>
        <div class="d-flex mb-5 container justify-content-center p-5 border text-wrap border-2 col-7 shadow-md text-break rounded-2 bg-secondary bg-gradient bg-opacity-25">
                <?php

        if(isset($_SESSION['user']) && isset($_SESSION['mdp'])){
            //User name and mail as input placeholder
            echo '
                <div class="col-10 g-3 border-secondary border-2">
                    <form method="post">
                        <div class="form-group">
                            <label for="roleInput">Role</label>
                            <input type="text" class="form-control shadow-none" id="roleInput" name="role" placeholder="'.$_SESSION["role"].'" readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label for="nomUtilisateurInput">Username</label>
                            <input type="text" class="form-control shadow-none" id="nomUtilisateurInput" name="user" placeholder="'.$_SESSION["user"].'">
                        </div>
                        <div class="form-group">
                            <label for="mdpInput">Password</label>
                            <input type="password" class="form-control shadow-none" id="mdpInput" name="mdp" value="'.$_SESSION["mdp"].'">
                        </div>  
                        <div class="form-group">
                            <label for="aProposInputArea">A propos de moi</label>
                            <textarea class="form-control" id="aProposInputArea" rows="3" name="apropos" disabled>'.$_SESSION["role"].'</textarea>
                        </div>
                        <div class="form-group my-2 p-2">
                            <label for="favcolor" class="me-3">Theme Color : </label>';
                            if(!isset($_SESSION['favcolor'])){
                                $_SESSION['favcolor'] = "#ffffff";
                                echo '<input type="color" id="favcolor" name="favcolor" value="'.$_SESSION["favcolor"].'">';
                            }
                            else{
                                echo '<input type="color" class="btn border border-black rounded-pill" id="favcolor" name="favcolor" value="'.$_SESSION['favcolor'].'">';
                            }
                            echo '
                        </div>
                        <div class="form-group mt-2 mb-3">
                            <input type="submit" class="form-control btn btn-lg border border-3 border-warning" id="modify_user" rows="3" name="modify_user" style="background-color:'.$_SESSION['favcolor'].';">
                        </div>
                    </form>';
                    if(isset($_POST["modify_user"])){
                        if($_POST['user'] == ""){$usr = False;}
                        else{$usr = $_POST['user'];}
                        if($_POST['mdp'] == $_SESSION["mdp"]){$mdp = False;}
                        else{$mdp = $_POST['mdp'];}
                        if($mdp == False && $usr == False){
                            echo "Aucun changement de mdp / user demandé";
                            $_SESSION['favcolor'] = $_POST['favcolor']; //on suppose changement de couleur
                            header("Refresh:0");
                        }
                        else{
                            modifyUser($_SESSION['user'], $usr, $mdp, $_SESSION['role'], $_POST['favcolor']);
                        }
                    }
                    echo '<br><div class="text-success">Session en cours : </div>';
                    var_dump($_SESSION);
            echo '
                    </div>
                </div>
            </div>';
            }
            else{    
                echo '    
                <div class="col-10 g-3 border-secondary border-2">
                    <form method="post">
                        <div class="text-center text-danger fw-bold"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle mb-1" viewBox="0 0 16 16">
                            <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                            </svg> Vous n\'êtes pas connecté<br/>
                         </div>
                        <div class="form-group">
                            <label for="roleInput">Role</label>
                            <input type="text" class="form-control shadow-none" id="roleInput" name="role" placeholder="" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nomUtilisateurInput">Username</label>
                            <input type="text" class="form-control shadow-none" id="nomUtilisateurInput" name="user" placeholder="" disabled>
                        </div>
                        <div class="form-group">
                            <label for="mdpInput">Password</label>
                            <input type="password" class="form-control shadow-none" id="mdpInput" name="mdp" value="" disabled>
                        </div>  
                        <div class="form-group">
                            <label for="aProposInputArea">A propos de moi</label>
                            <textarea class="form-control" id="aProposInputArea" rows="3" name="apropos" disabled></textarea>
                        </div>
                        <div class="form-group my-2 p-2">
                        <label for="favcolor">Color Theme :</label>
                        <input type="color" id="favcolor" disabled name="favcolor" value="#ff0000">
                    </div>
                        <div class="form-group mt-2 mb-3">
                        <input type="submit" class="form-control btn btn-lg btn-warning disabled" id="modify_user" rows="3" name="modify_user" style="background-color:'.$session = isset($_SESSION['favcolor']) ? $_SESSION['favcolor'] : "".'">
                    </div>
                    </form>';                    
                    if(isset($_POST["modify_user"])){
                        if($_POST['user'] == ""){$usr = False;}
                        else{$usr = $_POST['user'];}
                        if($_POST['mdp'] == $_SESSION["mdp"]){$mdp = False;}
                        else{$mdp = $_POST['mdp'];}
                        if($mdp == False && $usr == False){
                            echo "Aucun changement de mdp / user demandé";
                            $_SESSION['favcolor'] = $_POST['favcolor']; //on suppose changement de couleur
                            header("Refresh:0");
                        }
                        else{
                            modifyUser($_SESSION['user'], $usr, $mdp, $_SESSION['role'], $_POST['favcolor']);
                        }
                    }
                    echo '<br><div class="text-success">Session en cours : </div>';
                    var_dump($_SESSION);
                    
                echo '
                </div>
            </div>
        </div>';
            }


?>
        </div>



    </body>
    <?php footer(); ?>
</html>



