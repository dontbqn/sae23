<?php
session_start();
include("./fonctions.php");
setup();
/*
Page Accueil
*/
pageheader();
var_dump($_SERVER['PHP_SELF']);
pagenavbar("page01.php");

?>
<body>
    <h1 class="my-4 text-center">
        Accueil
    </h1>
    </div>
    <div class="container col-7">
        <div class="text-center">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore consequuntur voluptatibus tenetur odit, culpa itaque illo voluptates quasi incidunt soluta ex ipsam odio asperiores exercitationem minima, cumque eum cupiditate. Doloribus eveniet voluptas, itaque explicabo esse rem quis veniam iure a quo! Repellendus sed itaque rem ipsam voluptas consequuntur enim quaerat vero quia quo dignissimos voluptates dolorum accusamus odit soluta repudiandae, possimus laudantium dicta in quam voluptate maxime inventore? Optio quaerat ea voluptates nobis excepturi temporibus deserunt, aspernatur minus tempora quia. Obcaecati sint soluta accusantium asperiores odit tenetur quia omnis. Nesciunt adipisci facilis a asperiores maiores esse nisi reiciendis quidem in.</p>
            <p>Reprehenderit tempore similique aperiam ducimus magnam corporis voluptate nesciunt porro, molestiae temporibus obcaecati sit voluptatibus, mollitia sed sint quod aliquid expedita ea ad? Id odit repellat numquam voluptas quis quod mollitia. Quod dicta porro quae ut iure dolorem autem nulla voluptatem et hic dignissimos qui non error debitis, eum architecto voluptates, temporibus nostrum maxime omnis suscipit ipsum. Beatae labore blanditiis unde laboriosam! Ab voluptatem eum quas non nobis, officiis deleniti dolore, iure voluptatum soluta sint? Deleniti ad quidem earum fuga soluta hic. Alias ab nam earum. Recusandae corporis officiis in, ut similique vitae nam consequatur enim, placeat eveniet necessitatibus minima!</p>
        </div>
        <h3 class="m-2">Retrouvez sur notre site</h3>
    <hr>
    </div>

    <div class="container mb-5 col-7 bg-dark bg-gradient bg-opacity-75 overflow-scroll rounded-5">
        <div class="m-3">
        <?php
            $livres = json_decode(file_get_contents("data/data.json"), true);
            showBooks($livres, $found=False);
        ?>
        </div>
    </div>


    <?php pagefooter(); ?>
</body>

</html>