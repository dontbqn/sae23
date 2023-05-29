<?php
session_start();
include("../fonctions_start.php");

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
        <div class="container text-center">
            <h1 class="display-5 my-5">Database Table</h1>
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
                    echo '<pre>'.var_dump($group).'</pre>';
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
        <div class="container text-center">
                <?php
                    getUsers(null);
                    echo "
                        </tbody>
                        </table>
                        </div>
                    ";
                ?>
        </div>
    </body>
        
    <footer class="container mt-3 pt-5">
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
