<?php
session_start();
include("./fonctions_start.php");
setup();
/*
Page Informations
*/
pagenavbar("wiki.php");
?>
    <body>
            <h1 class="my-4 text-center">
                Informations
            </h1>
        <div class="d-flex div container col-9 justify-content-center border border-2 rounded-3 shadow-md mb-5">
            <div class="row col-8 p-3">
                <div class="mb-5 fs-6">
                    <h4>Fonctions des annonces</h4>
                    <hr>
                        <div class="list-group list-group-flush text-center">
                            <a href="#newann" class="list-group-item list-group-item-action">newAnnonce()</a>
                            <a href="#showann" class="list-group-item list-group-item-action">showAnnonces()</a>
                            <a href="#addann" class="list-group-item list-group-item-action">addAnnonce()</a>
                            <a href="#delann" class="list-group-item list-group-item-action">deleteAnnonce()</a>
                            <a href="#getann" class="list-group-item list-group-item-action">getAnnonces()</a>
                            <a href="#findann" class="list-group-item list-group-item-action">findAnnonces()</a>
                            <a href="#modifann" class="list-group-item list-group-item-action">modifyAnnonce()</a>
                            <a href="#newcoms" class="list-group-item list-group-item-action">newCommentaires()</a>
                        </div>
                </div>
                <h4>Mode d'emploi des annonces </h4>
                <p>
                    Constitué de chacune des fonctions citées, la page Explorer permet de rechercher les annonces de votre choix.
                    Ce formulaire et son traitement est sur une seule page, grâce à une instruction composée de "isset()".
                    <br/>
                    Il est ainsi possible d'effectuer des recherches par titres, lieux ou pays, contenus, seulement par mots clés, par
                    prix, ou encore par transports disponibles.
                    <br/>
                    A la recherche effectuée, une liste des annonces s'affichent, nos critères de recherches aussi. On peut alors observer parmis les 
                    cartes d'annnonces celle qui nous intéresse, les quelques informations dessus, puis se rendre sur page.
                </p>
                <p>
                    En se rendant sur la page, on se rend vite compte que c'est une unique page pour toute les annonces, qui met à jour
                    ses informations selon le paramètre "?id" situé dans l'URL
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                </p>
                <p>
                </p>
            </div>
        </div>
            <div class="row g-2 mb-2 mx-2 p-3">
                    <div class="col" id="newann">
                        <div class="card">
                            <img src="images/fonctions_ray.so/newann.png" class="img-fluid">
                            <div class="card-body">
                            <code class="card-title">newAnnonce()</code>
                            <p class="card-text">Cette fonction est la première appelée, car elle initialise les principales informations de la page HTML. Elle permet l'import du framework BootStrap, configure l'encodage, le titre, les fichiers Javascript et CSS.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col" id="showann">
                        <div class="card">
                            <img src="images/fonctions_ray.so/showann.png" class="img-fluid">
                            <div class="card-body">
                            <code class="card-title">showAnnonces()</code>
                            <p class="card-text">Cette fonction est appelée pour initialiser la tête du site, contenant le logo, le titre du site ainsi que l'état de la session. Lorsqu'une session n'est pas démarrée, un bouton "connect" permet aux utilisateurs de se connecter/de s'inscrire, en étant mené vers un élément BootStrap nommé Modal. Une fenêtre de connexion s'ouvre et les utilisateurs peuvent ainsi entrer leurs identifiants.<br/>Lorsqu'une session est démarrée, cette fonction va chercher à identifier quel est le rôle de l'utilisateur connecté, et selon le rôle, un bouton de déconnexion s'affiche.<br/>Dans le modal, un bouton de type 'checkbox' est cochable, et permet d'instaurer un cookie, qui permettra à un utilisateur de se connecter automatiquement lorsqu'il ouvrira son navigateur. Ce cookie a une durée de vie limitée, déterminée à son initialisation lors de l'appel de la fonction 'setcookie()'.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col" id="addann">
                        <div class="card">
                            <img src="images/fonctions_ray.so/addann.png" class="img-fluid">
                            <div class="card-body">
                            <code class="card-title">addAnnonce()</code>
                            <p class="card-text">Cette fonction permet de gérer l'ajout d'une nouvelle annonce. Elle traite les informations saisies par l'utilisateur dans un formulaire et effectue les validations nécessaires avant d'ajouter l'annonce à la base de données.</p>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row g-2 mb-2 mx-2 p-3">
                    <div class="col" id="delann">
                        <div class="card">
                            <img src="images/fonctions_ray.so/deleteann.png" class="img-fluid" style="max-height:200px">
                            <div class="card-body">
                            <code class="card-title">deleteAnnonce()</code>
                            <p class="card-text">Cette fonction permet de supprimer une annonce de la base de données. Elle prend en paramètre l'ID de l'annonce à supprimer et effectue les opérations nécessaires pour la suppression.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col" id="getann">
                        <div class="card">
                            <img src="images/fonctions_ray.so/getann.png" class="img-fluid">
                            <div class="card-body">
                            <code class="card-title">getAnnonces()</code>
                            <p class="card-text"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col" id="findann">
                        <div class="card">
                            <img src="images/fonctions_ray.so/findann.png" class="img-fluid">
                            <div class="card-body">
                            <code class="card-title">findAnnonces()</code>
                            <p class="card-text">Cette fonction permet à l'utilisateur de rechercher des annonces en fonction de certains critères tels que le titre, le lieu, le prix, etc. Elle traite les valeurs saisies dans un formulaire de recherche et affiche les annonces correspondantes.</p>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row g-2 mb-2 mx-2 p-3">
                    <div class="col" id="modifann">
                        <div class="card">
                            <img src="images/fonctions_ray.so/modifann.png" class="img-fluid">
                            <div class="card-body">
                            <code class="card-title">modifyAnnonce()</code>
                            <p class="card-text">Cette fonction permet de modifier les informations d'une annonce existante. Elle prend en paramètre l'ID de l'annonce à modifier et permet à l'utilisateur de mettre à jour les détails de l'annonce dans un formulaire.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col" id="newcoms">
                        <div class="card">
                            <img src="images/fonctions_ray.so/newcoms.png" class="img-fluid">
                            <div class="card-body">
                            <code class="card-title">newCommentaires()</code>
                            <p class="card-text">Cette fonction permet aux utilisateurs de laisser des commentaires sur une annonce spécifique. Elle traite les commentaires soumis dans un formulaire et les ajoute à la base de données des commentaires associés à l'annonce correspondante.</p>
                            </div>
                        </div>
                    </div>
            </div>
    <div class="d-flex div container col-9 justify-content-center border border-2 rounded-3 shadow-md mb-5">
            <div class="row col-8 p-3">
                <div class="mb-5 fs-6">
                    <h4>Fonctions de sessions</h4>
                    <hr>
                        <div class="list-group list-group-flush text-center">
                            <a href="#newUsers" class="list-group-item list-group-item-action">newUsers()</a>
                            <a href="#addUser" class="list-group-item list-group-item-action">addUser()</a>
                            <a href="#deleteUser" class="list-group-item list-group-item-action">deleteUser()</a>
                            <a href="#deconnexion" class="list-group-item list-group-item-action">deconnexion()</a>
                            <a href="#connexion" class="list-group-item list-group-item-action">connexion()</a>
                            <a href="#getUsers" class="list-group-item list-group-item-action">getUsers()</a>
                            <a href="#findUsers" class="list-group-item list-group-item-action">findUsers()</a>
                        </div>
                </div>
                <h4 class="mb-4">Mode d'emploi de la Gestion de Session et des Utilisateurs</h4>
                <h5>Fonctionnalités</h5>
                <p class="">
                    La page administrateur (page06.php) est celle qui regroupe le plus de fonctionnalités.
                    Elle permet aux adminsitreurs et au super-administreur.
                    Le super-adminisitrateur est le "chef de tous les chefs", le seul propriétaire du site ayant les droits de supprimer
                    des utilisateurs admins. Il est forcément ajouter manuellement.
                    <br/>
                    La fonction newUsers() est appelée dans la page crea_user.php, et permet de regénérer la liste des utilisateurs par défaut, à partir
                    d'une liste php encodée au format json. Cette fonction peut être appelée depuis la page admin, en appuyant sur un toaster situé en bas de page.
                    <br/>
                    La fonction addUser() permet aux administrateur de crééer des utilisateurs grâce à une petite case de formulaire. L'utilisateur par défaut aura pour rôle 'user' si l'administrateur
                    n'entre pas de rôle et envoie le formulaire. La création demande une confirmation de mot de passe, et un bouton est présent pour afficher les inputs de mots de passe (EventListener JS).
                    <br/>
                    La fonction deleteUser() est appelé sur la page d'administration, l'utilisateur choisit, si il est éligible, verra ses identifiants supprimés et donc son 'compte' être désactivé du fichier
                    utilisateurs. La liste mise à jour sera re-encodée et le fichier sera donc mise à jour.
                    <br/>
                    La fonction deconnexion() permet de supprimé la session de l'utilisateur et de la détruire, puis de renvoyer l'utilisateur à la page d'accueil.
                    <br/>
                    La fonction connexion() permet de vérifier, en comparant l'utilisateur de la base de données, les identifiants entrés.
                    <br/>
                    La fonction getUsers() permet d'afficher dans un 'container' la liste d'utilisateurs. Si l'argument 'null' est placé, c'est la base de données située 
                    dans le dossier data qui est renvoyer au format tableau HTML.
                    Autrement, on entre une base de donnée en argument. C'est utile lorsque l'on souhaite afficher une liste des utilisateurs trouvés.
                    <br/>
                    La fonction findUsers() cherche dans la base d'utilisateurs les utilisateurs correspondant, grâce à la fonction de compraison str_contains()
                </p>
            </div>
        </div>
    </body>
    <?php footer(); ?>
</html>