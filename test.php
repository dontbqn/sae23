<?php
session_start();
include("./fonction12.php");

/*
Page Accueil
*/
liseret();
setup();
navbar();

?>
<head>
    <style>
            @keyframes moveText {
                0% {
                    transform: translateX(500%);
                }
                100% {
                    transform: translateX(-100%);
                }
            }

            .move-left {
                animation: moveText 10s linear infinite;
            }
            
            .navbar {
                overflow: hidden;
                white-space: nowrap;
            }
            
            .navbar-text {
                display: inline-block;
            }
    </style>
</head>
<body>



    <script>
            function moveText() {
                var text = document.querySelector('.navbar-text');
                text.classList.add('move-left');

                setTimeout(function() {
                    text.classList.remove('move-left');
                }, 10000000); // Temps en millisecondes après lequel la classe sera supprimée
            }
            moveText();
    </script>
    
    </div>
    <div class="container col-md-6 offset-md-3"style="padding-top: 15px;">
        <div class="text-center">
            <a class="navbar-brand " href="#">
                <img src="image12/presentation.png" class="img-fluid" alt="Bootstrap" width="649" height="433">
            </a>
        </div>
        <h1 class="my-4 text-start">
        Accueil
        </h1>
        <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore consequuntur voluptatibus tenetur odit, culpa itaque illo voluptates quasi incidunt soluta ex ipsam odio asperiores exercitationem minima, cumque eum cupiditate. Doloribus eveniet voluptas, itaque explicabo esse rem quis veniam iure a quo! Repellendus sed itaque rem ipsam voluptas consequuntur enim quaerat vero quia quo dignissimos voluptates dolorum accusamus odit soluta repudiandae, possimus laudantium dicta in quam voluptate maxime inventore? Optio quaerat ea voluptates nobis excepturi temporibus deserunt, aspernatur minus tempora quia. Obcaecati sint soluta accusantium asperiores odit tenetur quia omnis. Nesciunt adipisci facilis a asperiores maiores esse nisi reiciendis quidem in.
        </p>
        <h1 class="my-4 text-start">
        8247# personnes logés grâce à ...
        </h1>
        
        <br>
        <br>
        <br>
        <br>
        <br>
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: First slide" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#555" dy=".3em">First slide</text></svg>
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
                </div>
                <div class="carousel-item">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Second slide" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#666"></rect><text x="50%" y="50%" fill="#444" dy=".3em">Second slide</text></svg>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
                </div>
                <div class="carousel-item">
                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Third slide" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#555"></rect><text x="50%" y="50%" fill="#333" dy=".3em">Third slide</text></svg>
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
    




    <?php footer(); ?>
</body>

</html>