<?php
session_start();
$data = json_decode(file_get_contents("../data/roles.json"), true); //Database des roles
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
        <h1 class="text-center pt-4 pb-3 my-3">Groupes</h1>
        <div class="container text-center">
            <table class="table table-hover table-striped table-borderless table-responsive">
                <thead class="table-dark">
                    <tr>
                        <th>Rôle</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Accès</th>
                    </tr>
                </thead>
                <?php
                echo '<tbody>';

                foreach ($data as $key => $group) {
                    $access = '';                
                    if($key != 'salaries'){ // sinon c'est la liste salarie qui est observée
                        switch ($group['access']) {
                            case 'ALL':
                                $access = 'table-danger';
                                break;
                            case 'INTRA':
                                $access = 'table-success';
                                break;
                            case 'PARTENAIRE':
                                $access = 'table-primary';
                                break;
                            default:
                                $access = '';
                                break;
                        }   
                        echo '<tr class="'.$access.'">';
                        echo '<td>' . $key . '</td>';
                        echo '<td>' . $group['name'] . '</td>';
                        echo '<td>' . $group['description'] . '</td>';
                        echo '<td>' . $group['access'] . '</td>';
                        echo '</tr>';
                    }   
                    else{
                        foreach ($group as $subKey => $subgroup) {
                            switch($subgroup["name"])
                            {
                                case 'direction':
                                    $access = 'table-warning';
                                    break;
                                case 'manager':
                                    $access = 'table-secondary';
                                    break;
                                case 'salarie':
                                    $access = 'table-success';
                                    break;
                            }
                            echo '<tr class="'.$access.'">';
                            echo '<td>' . $key . ' - ' . $subKey . '</td>';
                            echo '<td>'.$subgroup['name'].'</td>';
                            echo '<td>' . $subgroup['description'] . '</td>';
                            echo '<td>' . $subgroup['access'] . '</td>';
                            echo '</tr>';
                        }   
                    }
                }
                echo '</tbody>'; ?>
            </table>
        </div>
        <div class="container pt-4 pb-3 my-5">
                    <h4 class="pt-4 pb-3 my-3 fw-semibold">Rôles extraits de JSON</h4>
                    <?php 
                    print_r($data);
                    // Modification du rôle
                    if(isset($_POST['modif'])) {
                        echo '
                        <div class="d-flex justify-content-center my-5">
                            <form method="post" class="bg-secondary bg-opacity-25 col-3 p-3 border border-2 border-black">
                                <span class="badge bg-dark rounded-pill text-center p-3 ms-2 mb-2 text-wrap">modification du rôle suivant : '.$_POST["role"].'</span>
                        ';
                            echo '
                                    <input placeholder="nouveau nom du rôle : '.$_POST["role"].'" class="form-control my-1 shadow-none border border-warning" id="nv_role" name="nv_role">
                                    <button type="submit" class="form-control btn btn-sm btn-warning my-1" id="modif_role" name="modif_role" >modifier le rôle</button>
                                ';
                        echo '
                            </form>
                        </div>
                        ';
                        if(isset($_POST['modif_role'])){
                            foreach($data as $role){
                                if($role["name"] == $_POST["nv_role"]){
                                    $role["name"] = $_POST["nv_role"];
                                }
                            }
                            //$res = json_encode($roles_updated, JSON_PRETTY_PRINT); // base json à jour
                            echo $res;
                            file_put_contents("./data/roles.json",$res); // résultat dans roles.json  
                            //header("Refresh: 0");                  
                        }
                    }
                    else{
                        echo '
                        <div class="col-9 mb-5">
                            <form class="text-center my-4" method="post">
                                <label for="select">Modifier un rôle</label>
                                <select id="select" name="role">
                                    <optgroup label="Vos Rôles">                  
                                ';
                                foreach ($data as $key => $role) {
                                    if($key != 'salaries'){
                                        echo '<option type="button" value="'.$role["name"].'">'.$role["name"].'</option>';
                                    }
                                    else{
                                        foreach ($role as $subroleKey => $subRole) {
                                            echo '<option type="button" value="'.$subRole["name"].'">'.$subRole["name"].'</option>';
                                        }
                                    }
                                }
                                echo '
                                    </optgroup>
                                </select>
                                <button type="submit" class="btn btn-dark btn-outline-warning" name="modif">Choisir</button>
                            </form>
                        </div>
                        ';
                    }
                    ?>
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
