<?php
session_start();
include("./fonctions_start.php");
setup();
pagenavbar("inscription.php");
?>
    <body>
        <h1 class="my-4 text-center">
            Rejoignez-nous !
            <hr class="position-relative translate-middle text-warning border-5 rounded-circle col-6 top-50 start-50">
        </h1>
        <div class="d-flex container-fluid justify-content-center">
            <div class="col-5 mb-5 border border-2 rounded-4 p-3">
            <?php if(!isset($_POST['inscription_btn'])){ 
                echo '
                <form method="post">
                        <div class="form-group">
                            <label for="roleinp">Role</label>
                            <input type="text" class="form-control shadow-none" id="roleinp" name="roleinp" placeholder="visitor" value="visitor" readonly>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control shadow-none" id="username" name="username" placeholder="Xx_DarcoxXx96" required>
                        </div>
                        <div class="form-group">
                            <label for="motdepasse" class="col-form-label">Password</label>
                            <input type="password" class="form-control shadow-none password" name="motdepasse" id="motdepasse" required>
                        </div>  
                        <div class="form-group form-check form-switch my-2">
                            <input type="checkbox" name="visible_box" class="form-check-input my-2 p-2 shadow-none" id="yes">
                            <label for="visible_box" class="pt-1"> rendre visible</label>
                        </div>
                        <div class="form-group mt-2 mb-4">
                        <input type="submit" class="form-control btn btn-lg btn-warning" id="inscription_btn" name="inscription_btn">
                    </div>
                </form>';
            }
            else{
                var_dump($_POST);

            } ?>
            </div>
        </div>
    </body>
<?php footer(); ?>
</html>