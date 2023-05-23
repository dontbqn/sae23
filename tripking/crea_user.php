<?php
session_start();

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
        include("./fonctions.php");
        setup();bbgdbg
        /*
        Page Créa-User
        */
        pagenavbar("crea_user.php");
        newUsers();
        header("Location: page06.php");
    }
}

?>