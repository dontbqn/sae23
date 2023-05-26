<?php
session_start();
include("./fonctions_start.php");
include("./annonces.php");
setup();
pagenavbar("explorer.php");
?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
 <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

    <body>
        <h1 class="my-4 text-center">
        Restrictions
        </h1>
        
        <div class="container col-11 border border-2 rounded-4 shadow mt-4 mb-5 p-3">
            <div id="map" class="p-3 w-100" style="height: 500px"></div>
            <script>

                //  https://leafletjs.com/examples/quick-start/
                //
                //  Credits : OpenStreetMap
                //  data is available under the Open Database License.
                //  https://www.openstreetmap.org/copyright

                var map = L.map('map').setView([52.27, 22.24], 4); //49.55/26.46/4 => Englobe presque toute l'Europe
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                L.marker([51.5, -0.09]).addTo(map) // => Pointeur sur Londres avec popup associé
                .bindPopup('Londres, voyage interdit aux touristes jusqu\'au 17/06/23')
                .openPopup();

                // Cercle vert France
                var circle = L.circle([46.2452, 2.2931], {
                    color: 'green',
                    fillColor: '#f08',
                    fillOpacity: 0.5,
                    radius: 400000
                }).addTo(map);

                // Cercle rouge Russie
                var circle = L.circle([55.7558, 37.6176], {
                    color: 'red',
                    fillColor: '#f05',
                    fillOpacity: 0.5,
                    radius: 800000
                }).addTo(map);

                var popup = L.popup();
                function onMapClick(e) {

                    popup
                        .setLatLng(e.latlng)
                        .setContent("You clicked the map at " + e.latlng.toString() +" it correspond to the country :"+$lat)
                        .openOn(map);
                    
                    //grid.getCode (e.lat, e.lng, callback (error, code));
                }
                map.on('click', onMapClick);
            </script>

            
        </div>
    </body>
    <?php footer(); ?>
</html>