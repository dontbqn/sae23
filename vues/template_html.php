<?php 

function setup($role){
    echo '
    <!DOCTYPE HTML>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Bastien, Aronn, Clément, Adrien">
        <link rel="icon" href="images/iconetk.ico">
        <title>TripKing</title>
        <meta name="viewport" content="width=device-width">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">    
        <link href="css/liseret.css" rel="stylesheet">
    </head>
    ';
    liseret();
    navbar();
}
function liseret(){
    echo '
    <nav class="navbar bg-secondary">
        <div class="container-fluid">
            <a class="navbar-text text-decoration-none link-light" href="./bons_plans.php">
            &#128722;&#127939; GROSSE PROMO SUR LES LOGEMENTS !! -50% PARTOUT
            </a>
        </div>
    </nav>
    ';
}
function navbar(){
    echo "<nav></nav>";
} 
function footer(){

} 

?>