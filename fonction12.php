<?php

function liseret(){
    echo '
    <nav class="navbar bg-secondary ">
        <div class="container-fluid ">
            <span class="navbar-text ">
                GROSSE PROMO SUR LES LOGEMENT!!! -50%
            </span>
        </div>
    </nav>
    ';
}

function setup(){
    echo '
    <!DOCTYPE HTML>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Adrien Crico">
        <link rel="icon" href="images/bugs.ico">
        <title>Site Dynamique</title>
        <meta name="viewport" content="width=device-width">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">    
        <link href="css/styledbooks.css" rel="stylesheet">
    </head>
    ';
}

function navbar(){
    echo '
  

    <div class="container-fluid" style="padding-top: 20px;">
        <div class="row ">
            <div class="col">
                <a class="navbar-brand" href="#">
                    <img src="image12/téléchargement.png" alt="Bootstrap" width="50" height="44">
                </a>
            </div>

            <div class="col">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="width: 400px;">
                    <button class="btn btn-outline-dark" type="submit">Search</button>
                </form>
            </div>
            
            <div class="col text-end">
                Pseudo
                <a class="navbar-brand" href="#">
                    <img src="image12/icone_user.png" alt="Bootstrap" width="40" height="40">
                </a>
                <a class="navbar-brand" href="#">
                    <img src="image12/icone_coeur.png" alt="Bootstrap" width="40" height="40">
                </a>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Langue
                    </button>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Fr</a></li>
                    <li><a class="dropdown-item" href="#">En</a></li>
                    </ul>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    devise
                    </button>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">€</a></li>
                    <li><a class="dropdown-item" href="#">$</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" style="padding-top: 8px;">
        <div class="row ">


            <div class="col-md-6 offset-md-3 text-center">
                <button type="button" class="btn btn-danger">texte</button>
                <button type="button" class="btn btn-danger"style="margin-left: 20px;">texte</button>
                <button type="button" class="btn btn-danger"style="margin-left: 20px;">texte</button>
            </div>
            

        </div>
    </div>
    


    


    ';
}

function footer(){
    echo '
    <div class="b-example-divider"></div>


    <div class="container">
        <footer class="py-5"style="padding-bottom: 0px;">
            <div class="row">
            <div class="col-6 col-md-2 mb-3">
                <h5>Entrepise</h5>
                <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">A propos</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Partenaires</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Rejoignez-vous</a></li>
                </ul>
                <br>
                
            </div>

            <div class="col-6 col-md-2 mb-3">
                <h5>Contact</h5>
                <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Aide / Support</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Informations complémentaires</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Remboursement</a></li>
                </ul>
            </div>

            

            <div class="col-md-5 offset-md-1 mb-3">
                <form>
                <h5>Subscribe to our newsletter</h5>
                <p>Monthly digest of what exciting from us.</p>
                <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                    <label for="newsletter1" class="visually-hidden">Email address</label>
                    <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                    <button class="btn btn-primary" type="button">Subscribe</button>
                </div>
                </form>
                <p>Avenue Jean Moulin – 7, 40221 Saint-Malo, France</p>
            </div>
            </div>

            <div class="container text-center">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="btn-group" role="group">
                                <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Langue
                                </button>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Fr</a></li>
                                <li><a class="dropdown-item" href="#">En</a></li>
                                </ul>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                devise
                                </button>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">€</a></li>
                                <li><a class="dropdown-item" href="#">$</a></li>
                                </ul>
                        </div>
                    </div>
                    <div class="col-sm-8 ">
                        <div>
                            <a class="" href="#">
                                <img src="image12/insta.png" alt="Bootstrap" width="40" height="40">
                            </a>
                            <a class="" href="#">
                                <img src="image12/insta.png" alt="Bootstrap" width="40" height="40">
                            </a>
                            <a class="" href="#">
                                <img src="image12/insta.png" alt="Bootstrap" width="40" height="40">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
            <p>&copy; 2022 Company, Inc. All rights reserved.</p>
            <ul class="list-unstyled d-flex">          
            </div>
        </footer>

    </div>
    ';
}




?>


