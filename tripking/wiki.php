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
        <hr class="border border-warning border-3 opacity-75">
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
                    ses informations selon le paramètre "?id" situé dans l'URL.
                    Une fois les détails de l'annonce obtenus, la page les affiche de manière structurée et conviviale pour l'utilisateur. Les informations telles que le titre, la description, le prix, la localisation et d'autres détails pertinents sont affichées.

                    De plus, la page "Annonce" permet à l'utilisateur d'interagir avec l'annonce. Par exemple, il peut laisser des commentaires ou des avis sur l'annonce, poser des questions au vendeur, ou encore partager l'annonce sur les réseaux sociaux.

                    La page offre également des fonctionnalités supplémentaires telles que la possibilité de signaler une annonce inappropriée ou frauduleuse, de contacter directement le vendeur via un formulaire de contact, ou même de sauvegarder l'annonce pour une consultation ultérieure.
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
                                <p class="card-text">Cette fonction est appelée lorsque l'on souhaite tester notre site, car elle initialise les premieres annonces créées manuellement, sans formulaire, et leurs attributs.</p>
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
                            <p class="card-text overflow-auto mt-2 p-2" style="max-height: 200px;">
                                La fonction getAnnonces récupère une liste d'annonces et affiche les détails de chaque annonce dans un tableau. Si la liste d'annonces n'est pas définie, la fonction charge les annonces à partir d'un fichier JSON. Le nombre total d'annonces est affiché, suivi d'un titre et du nombre de résultats correspondants.

                                La fonction crée un conteneur avec une classe CSS pour l'affichage des annonces. À l'intérieur du conteneur, un en-tête de tableau est créé avec les titres des colonnes. Ensuite, pour chaque annonce, une ligne est ajoutée au tableau avec les détails tels que l'ID, le titre, le lieu, le pays, le prix par nuit, le nombre de favoris, le statut de bon plan et un lien vers les images de l'annonce.

                                Si l'utilisateur connecté a les droits d'administration, un bouton de suppression est ajouté pour chaque annonce.

                                Enfin, la fonction ferme le tableau et le conteneur, et l'ensemble du contenu est renvoyé pour affichage.

                                Note : La fonction nécessite des modifications pour assurer la sécurité des données et la prévention des attaques, telles que l'injection de code malveillant.
                            </p>
                            </div>
                        </div>
                    </div>
                    <div class="col" id="findann">
                        <div class="card">
                            <img src="images/fonctions_ray.so/findann.png" class="img-fluid">
                                <div class="card-body">
                                <code class="card-title">findAnnonces()</code>
                            <p class="card-text overflow-auto mt-2 p-2" style="max-height: 200px;">
                                La fonction findAnnonces permet de rechercher et afficher des annonces en fonction de divers critères. Les paramètres d'entrée incluent les mots-clés de recherche, le type de recherche, le type de transport, le prix maximum par nuit et l'option "bons plans".

                                Les mots-clés de recherche sont utilisés pour trouver des correspondances dans les titres, lieux et contenus des annonces. Le type de recherche peut être spécifié en choisissant parmi les options "titre", "lieu_pays" et "contenu". Le type de transport peut être filtré en sélectionnant une option telle que "train".

                                Le critère de prix maximum par nuit est utilisé pour limiter les annonces affichées. Les annonces dont le prix est inférieur ou égal à ce montant sont incluses dans les résultats.

                                L'option "bons plans" permet de filtrer les annonces en affichant uniquement celles qui sont considérées comme des bons plans.

                                La fonction parcourt les annonces disponibles en utilisant les critères spécifiés et retourne les résultats correspondants. Les résultats sont affichés de manière structurée pour une meilleure lisibilité.
                            </p>
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
        <hr class="border border-primary border-3 opacity-75 my-5">
        <div class="d-flex div container col-9 justify-content-center border border-2 rounded-3 shadow-md mb-5">
            <div class="row col-8 p-3">
                <div class="mb-5 fs-6">
                    <h4>Fonctions de sessions</h4>
                    <hr>
                        <div class="list-group list-group-flush text-center">
                            <a href="#newuser" class="list-group-item list-group-item-action">newUsers()</a>
                            <a href="#adduser" class="list-group-item list-group-item-action">addUser()</a>
                            <a href="#deluser" class="list-group-item list-group-item-action">deleteUser()</a>
                            <a href="#deco" class="list-group-item list-group-item-action">deconnexion()</a>
                            <a href="#co" class="list-group-item list-group-item-action">connexion()</a>
                            <a href="#getuser" class="list-group-item list-group-item-action">getUsers()</a>
                            <a href="#finduser" class="list-group-item list-group-item-action">findUsers()</a>
                        </div>
                </div>
                <h4 class="mb-4">Mode d'emploi de la Gestion de Session et des Utilisateurs</h4>
                <h5>Fonctionnalités</h5>
                <p class="">
                    La page administrateur (page06.php) est celle qui regroupe le plus de fonctionnalités.
                    Elle permet aux administrateurs et au super-administreur.
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
                    Elle va en plus de cela,et selon les arguments entrés, initaliser une session en y intégrant les informations de l'utilisateur et créé deux cookies.
                    Ces cookies d'une durée de 3 jours permettront, à l'aide du TokenID des utilisateurs, de reformer une session depuis le cache du
                    navigateur. Les utilisateurs n'auront pas à se connecter, ni à re-entrer leurs envies quant à leurs préférences de cookies (pop-up choix de cookies; marketing, analisys)
                    <br/>
                    La fonction getUsers() permet d'afficher dans un 'container' la liste d'utilisateurs. Si l'argument 'null' est placé, c'est la base de données située 
                    dans le dossier data qui est renvoyer au format tableau HTML.
                    Autrement, on entre une base de donnée en argument. C'est utile lorsque l'on souhaite afficher une liste des utilisateurs trouvés.
                    <br/>
                    La fonction findUsers() cherche dans la base d'utilisateurs les utilisateurs correspondant, grâce à la fonction de compraison str_contains()
                </p>
            </div>
        </div>
        <div class="container">
            <div class="row g-2 mb-2 mx-2 p-3">
                <div class="col" id="newuser">
                    <div class="card">
                        <img src="images/fonctions_ray.so/newuser.png" class="card-img-top" alt="NewUsers()">
                        <div class="card-body">
                            <h5 class="card-title">newUsers()</h5>
                            <p class="card-text">Cette fonction permet d'ajouter de nouveaux utilisateurs au système.</p>
                        </div>
                    </div>
                </div>
                <div class="col" id="adduser">
                    <div class="card">
                        <img src="images/fonctions_ray.so/adduser.png" class="card-img-top" alt="AddUser()">
                        <div class="card-body">
                            <h5 class="card-title">addUser()</h5>
                            <p class="card-text">Cette fonction permet d'ajouter un utilisateur spécifié au système.</p>
                        </div>
                    </div>
                </div>
                <div class="col" id="deluser">
                    <div class="card">
                        <img src="images/fonctions_ray.so/deluser.png" class="card-img-top" alt="DeleteUser()">
                        <div class="card-body">
                            <h5 class="card-title">deleteUser()</h5>
                            <p class="card-text">Cette fonction permet de supprimer un utilisateur spécifié du système.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-2 mb-2 mx-2 p-3">
                <div class="col" id="deco">
                    <div class="card">
                        <img src="images/fonctions_ray.so/deco.png" class="card-img-top" alt="Déconnexion()">
                        <div class="card-body">
                            <h5 class="card-title">deconnexion()</h5>
                            <p class="card-text">Cette fonction permet à un utilisateur de se déconnecter du système.</p>
                        </div>
                    </div>
                </div>

                <div class="col" id="co">
                    <div class="card">
                        <img src="images/fonctions_ray.so/co.png" class="card-img-top" alt="Connexion()">
                        <div class="card-body">
                            <h5 class="card-title">connexion()</h5>
                            <p class="card-text">Cette fonction permet à un utilisateur de se connecter au système.</p>
                        </div>
                    </div>
                </div>
                <div class="col" id="getuser">
                    <div class="card">
                        <img src="images/fonctions_ray.so/getuser.png" class="card-img-top" alt="GetUsers()">
                        <div class="card-body">
                            <h5 class="card-title">getUsers()</h5>
                            <p class="card-text">Cette fonction permet d'obtenir la liste des utilisateurs du système.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-2 mb-2 mx-2 p-3">
                <div class="col" id="finduser">
                    <div class="card">
                        <img src="images/fonctions_ray.so/finduser.png" class="card-img-top" alt="FindUsers()">
                        <div class="card-body">
                            <h5 class="card-title">findUsers()</h5>
                            <p class="card-text">Cette fonction permet de rechercher des utilisateurs dans le système.</p>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <hr class="border border-success border-3 opacity-75 my-5">
        <div class="d-flex div container col-9 justify-content-center border border-2 rounded-3 shadow-md mb-5">
            <div class="row col-8 p-3">
            <h4 class="mb-4">Mode d'emploi de l'Intranet de TripKing</h4>
                <h5>Fonctionnalités</h5>
                <p class="">
                    La page administrateur (page06.php) est celle qui regroupe le plus de fonctionnalités.
                    Elle permet aux administrateurs et au super-administreur.
                    Le super-administrateur est le "chef de tous les chefs", le seul propriétaire du site ayant même les droits de supprimer
                    des utilisateurs admins.
                    <br/>
                    Page d'Intranet possède une plateforme de reconfirmation de connexion par formulaire. Cette fonctionnalité (non-fonctionnelle)
                    a été introduite dans l'idée où les employés utiliseraientt d'autres identifiants que ceux du site.
                    Leurs identifiants seraient cette fois-ci liés à une base de données DB sur le serveur Apache2, et la gestion
                    des droits et utilisateurs s'effectuerait alors dans la configuration du service Apache.
                    On utiliserait AuthDBMUserFile, voici un aperçu de ce que l'on ajouterait dans notre configuration Apache :
                    <br>
                    <div class="col-7">
                        <kbd class="">
                            <\Directory "/home/*/public_html/intra-tripking"><br>
                            AuthType Basic
                            AuthName "Tripking Intra Files"
                            AuthBasicProvider dbm

                            # combined user/group database
                            AuthDBMUserFile  "/usr/local/apache2/etc/.htdbm-all"
                            AuthDBMGroupFile "/usr/local/apache2/etc/.htdbm-all"

                            Satisfy All
                            Require file-group<br>
                            <\/Directory>
                        </kbd>
                    </div>
                    <br>
                        Nous n'avons pu implémenter la technologie d'AJAX que très rapidement dans le Portal des Partenaires.
                        Dans une page depuis laquelle ils peuvent modifier les données associées à leur société, qui sont affichés
                        dans la page publique des Partenaires. Il n'y a pas de boutons de validation, on entre les données que l'on souhaite
                        modifier/ajouter et une "preview" dynamique apparait dans la colonne située à droite du formulaire.
                    <br>
                </p>
            </div>
        </div>


    </body>
    <?php footer(); ?>
</html>