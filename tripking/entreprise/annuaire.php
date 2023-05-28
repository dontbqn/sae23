<?php
session_start();
include("../fonctions_start.php");
setup();
$data = json_decode(file_get_contents("../data/roles.json"), true); //Database des roles
?>
<!DOCTYPE html>
<html>
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
    </body>
</html>
