<?php
session_start();
include("./fonctions_start.php");
/*
Page Accueil
*/
setup();
pagenavbar("page01.php");

?>
<body class="">
    <div class="container pt-4 pb-3 my-5">
        <div class="text-center">
            <a class="navbar-brand" href="#">
                <img src="images/presentation.png" class="img my-2" alt="Presentation Picture" width="800" height="433">
            </a>
        </div>
        <div class="container text-start my-5">
            <h1 class="display-5">    
                L'Aventure Trip King commence ici !
            </h1>
            <p class="col-7 p-2">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore consequuntur voluptatibus tenetur odit, culpa itaque illo voluptates quasi incidunt soluta ex ipsam odio asperiores exercitationem minima, cumque eum cupiditate. Doloribus eveniet voluptas, itaque explicabo esse rem quis veniam iure a quo! Repellendus sed itaque rem ipsam voluptas consequuntur enim quaerat vero quia quo dignissimos voluptates dolorum accusamus odit soluta repudiandae, possimus laudantium dicta in quam voluptate maxime inventore? Optio quaerat ea voluptates nobis excepturi temporibus deserunt, aspernatur minus tempora quia. Obcaecati sint soluta accusantium asperiores odit tenetur quia omnis. Nesciunt adipisci facilis a asperiores maiores esse nisi reiciendis quidem in.
            </p>
        </div>
        <div class="container my-5 text-end">
            <h1 class="display-6">
                8247.. personnes logés grâce à TripKing !
            </h1>
            <p class="text-end p-2">
                Avec nos logements disponibles dans toutes l'Europe, Tripking a su emerveiller vos vacances et week-ends toute l'année. Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore consequuntur voluptatibus tenetur odit, culpa itaque illo voluptates quasi incidunt soluta ex ipsam odio asperiores exercitationem minima, cumque eum cupiditate. Doloribus eveniet voluptas, itaque explicabo esse rem quis veniam iure a quo! Repellendus sed itaque rem ipsam voluptas consequuntur enim quaerat vero quia quo dignissimos voluptates dolorum accusamus odit soluta repudiandae, possimus laudantium dicta in quam voluptate maxime inventore? Optio quaerat ea voluptates nobis excepturi temporibus deserunt, aspernatur minus tempora quia. Obcaecati sin
            </p>
        </div>
        <div class="container w-50 my-5">
            <div id="carouselExampleCaptions" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./images/louis.png" class="w-100">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>First slide label</h5>
                            <p>Some representative placeholder content for the first slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="./images/louis.png" class="w-100">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Second slide label</h5>
                            <p>Some representative placeholder content for the second slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="./images/louis.png" class="w-100">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Third slide label</h5>
                            <p>Some representative placeholder content for the third slide.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    




    <?php footer(); ?>
</body>

</html>