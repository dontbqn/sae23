<?php
session_start();
include("./fonctions_start.php");
/*
Page Accueil
*/
setup();
pagenavbar("about.php");
?>
<body>
    <div class="container my-5">
        <h2 class="text-primary">Histoire de l’entreprise (Qui sommes-nous ?)</h2>
        <hr class="my-4">
            <p class="lead">TripKing est une entreprise de location de biens immobiliers intervenant dans toute l’Europe. Elle intervient depuis plus de 50 ans auprès de toutes les villes importantes ainsi que dans certains villages. Soucieux de répondre aux besoins et aux enjeux de nos clients, nous construisons avec chacun d'entre vous une relation de proximité basée sur vos demandes et vos critères.</p>
            <p>TripKing cherche à satisfaire chacun d'entre vous en vous proposant des logements de location hors du commun.</p>

        <h4 class="text-primary">TripKing : une entreprise familiale indépendante</h4>
            <p class="mb-4">Originaire de Marseille dans le 92 et passionnée par l’immobilier, TripKing est une entreprise familiale indépendante. Nous choisissons nos logements avec soin afin de satisfaire toute notre clientèle.</p>

        <h4 class="text-primary">Notre Mission</h4>
            <p class="mb-4">Nous vous accompagnons vers les nouveaux logements d’aujourd’hui et de demain en vous proposant des solutions adaptées à vos besoins.</p>
        
        <blockquote class="blockquote mb-4">
            <p class="mb-0">"Votre satisfaction est notre priorité absolue. Nous nous efforçons de vous offrir une expérience unique dans la location de biens immobiliers."</p>
            <footer class="blockquote-footer my-2">
                L'équipe de TripKing
            </footer>
        </blockquote>
    </div>


</body>
    <?php footer(); ?>
</html>