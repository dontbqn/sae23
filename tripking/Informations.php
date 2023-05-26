<?php
session_start();
include("./fonctions_start.php");
setup();
/*
Page Informations
*/
pagenavbar("Informations.php");
?>
    <body>
            <h1 class="my-4 text-center">
                Informations
            </h1>
        <div class="d-flex div container col-9 justify-content-center border border-2 rounded-3 shadow-md mb-5">
            <div class="row col-8 p-3">
                <div class="mb-5 fs-6">
                    <h4>Fonctions du formulaire</h4>
                    <hr>
                        <div class="list-group list-group-flush text-center">
                            <a href="#setup" class="list-group-item list-group-item-action">setup()</a>
                            <a href="#header" class="list-group-item list-group-item-action">pageheader()</a>
                            <a href="#footer" class="list-group-item list-group-item-action">pagefooter()</a>
                            <a href="#navbar" class="list-group-item list-group-item-action">pagenavbar()</a>
                            <a href="#showbooks" class="list-group-item list-group-item-action">showBooks()</a>
                            <a href="#findbooks" class="list-group-item list-group-item-action">findBooks()</a>
                        </div>
                        <script>
                            const cards = document.querySelectorAll('.card');
                            cards.forEach(card => {
                                const a_link = card.querySelector('.list-group-item-action');
                                a_link.addEventListener('click', e => {
                                    e.preventDefault(); 
                                    // Désactive le comportement par défaut du navigateur, pouvant causer des erreurs
                                    card.classList.add(''); 
                                    //ajout de la class glow, relié au style css
                                    
                                    setTimeout(() => {     //Effet se dissipe au bout d'1s
                                    card.classList.remove('');
                                    }, 1000);
                                });
                            });
                        </script>
                </div>
                <h4>Mode d'emploi du Formulaire</h4>
                <p>
                    Constitué de chacune des fonctions citées, la page de Formulaire permet de rechercher vos livres préférés.
                    Ce formulaire et son traitement est sur une seule page, grâce à une instruction composée de "isset()".
                    <br/>
                    Ce formulaire de recherche ne requiert pas d'options pour être validé. Il a été formé de sorte à ce que les
                    utilisateurs puissent choisir être le plus précisémment possible, selon la base de données présentes sur le serveur.
                    Il est ainsi possible d'effectuer des recherches par mois, années, titres, auteurs, contenus, ou seulement par mots clés.
                    Un soucis pour l'instant est que si un utilisateur effectue une faute d'ortographe, les fonctions php utilisées (strcontains())
                    ne reconnaitront pas la saisie. L'algorithme de recherche peut largement être améliorer par la suite. <br>Exemple "<a class="link-underline-danger" href="#" title="Victor Hugo*">Victorius Hugod</a>" renverra le message suivant : "<em>no books could be found</em>" bien
                    que la chaîne de caractères ressemble à celle de "Victor" et  "Hugo".
                    En revanche, une requête tel que : "victo bauv blanchi mile", renverra différents livres.
                    <br/>
                    A noté que la recherche par année seulement fonctionne. Mais que si un utilisateur recherche en indiquant seulement le mois de parution,
                    le formulaire ne renverra rien. C'est une mise à jour qui sera effectué dans les prochains jours, comptez sur notre équipe.
                </p>
                <p>
                    <br/>
                    Les mots clés de type déterminants, articles, propositions ou pronoms sont omis de la recherche par expression, tout simplement car tous les livres s'afficheraient
                    si l'utilisateur recherchait un mot tel que "et".
                    <br/>
                    Lorsqu'une recherche par date (année et/ou mois) est effectuée, les livres possédant des dates de publications ultérieurs sont affichés.
                    <br/>
                    A chaque traitement, une liste contenant toutes les occurrences est formée, puis elle est triée à la fin, pour supprimé toute duplication et 
                    afficher les résultats uniques.
                    <br/>
                    Les recherches par expression (barre de recherche) nécessite au minimum 4 caractères afin d'être traité.
                    <br/>
                </p>
                <p>
                    Concernant l'aspect sécurité, il aurait fallut ajouté plus de fonctions permettant d'éviter toute injection de code, avec par exemple la fonction htmlspecialchars().
                </p>
            </div>
        </div>
            <div class="row g-2 mb-2 mx-2 p-3">
                <div class="col" id="setup">
                    <div class="card">
                        <img src="images/setup.png" class="img-fluid">
                            <div class="card-body">
                                <code class="card-title">Setup</code>
                                <p class="card-text">Cette fonction est la première appelée, car elle initialise les principales informations de la page HTML.
                                    Elle permet l'import du framework BootStrap, configure l'encodage, le titre, les fichiers Javascript et CSS.
                                </p>
                            </div>
                    </div>
                </div>
                <div class="col" id="header">
                    <div class="card">
                        <img src="images/setup.png" class="img-fluid">
                            <div class="card-body">
                                <code class="card-title">Header</code>
                                <p class="card-text">Cette fonction est appelé pour initialisé la tête du site, contenant le logo, le titre du site ainsi que  l'état de la session.
                                    Lorsqu'une session n'est pas démarré, un bouton "connect" permet aux utilisateurs de se connecter/de s'inscrire, en étant mené vers un élément BootStrap nommé Modal.
                                    Une fenêtre de connexion s'ouvre et les utilisateurs peuvent ainsi entrer leurs identifiants.<br/>
                                    Lorsqu'une session est démarré, cette fonction va chercher à identifier quel est le rôle de l'utilisateur connecté, et selon le rôle, une bouton de déconnexion s'affiche.
                                    <br/>
                                    Dans le modal, un bouton de type 'checkbox' est cochable, et permet d'instaurer un cookie, qui permettra à un utilisateur de se connecter automatiquement, lorsqu'il ouvrira son 
                                    navigateur. Ce cookie a une durée de vie limitée, déterminé à son initialisation lors de l'appel de la fonction 'setcookie()'.
                                </p>
                            </div>
                    </div>
                </div>
                <div class="col" id="footer">
                    <div class="card">
                        <img src="images/setup.png" class="img-fluid">
                            <div class="card-body">
                                <code class="card-title">Footer</code>
                                <p class="card-text">Cette fonction sert à affiché le pied de page, content les informations du propriétaire du site, et des informations pour les utilisateurs
                                    tel que leurs adresses IP, leur port utilisé sur le site, et la date du jour. Tout cela est possible grâce à la variable supergloab $_SERVER, qui récupèrent toutes
                                    ces informations et nous permet de les manipuler.
                                </p>
                            </div>
                    </div>
                </div>
            </div>
            <div class="row g-2 mb-5 mx-2 p-3">
                <div class="col" id="navbar">
                    <div class="card">
                        <img src="images/setup.png" class="img-fluid">
                            <div class="card-body">
                                <code class="card-title">Navbar</code>
                                <p class="card-text">Cette fonction permet d'afficher une barre de navigation personnalisée selon le rôle de l'utilisateur. Si un admin/superadmin est connecté, une instruction php leur affichera
                                    une page inaccessible aux utilisateurs lambdas : la page d'administration. Lorsqu'un lien est cliqué, elle devient active grâce à des class BootStrap ajoutée aux balises de liens.
                                </p>
                            </div>
                    </div>
                </div>
                <div class="col" id="showbooks">
                    <div class="card">
                        <img src="images/setup.png" class="img-fluid">
                        <div class="card-body">
                            <code class="card-title">ShowBooks</code>
                            <p class="card-text">Cette fonction récupère une base de donnée .json, qu'elle affiche grâce à une boucle 'foreach' dans un tableau HTML/BootStrap.
                                <br/>Un argument supplémentaire lui a été ajouté, permettant de déterminé si des livres ont été trouvés ou non (liste de livres vide). Dans le cas ou cette
                                argument est égal au booléen 'False', c'est que la fonction findBooks n'a pas trouvé de livres suite à la recherche de l'utilisateur.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col" id="findbooks">
                    <div class="card">
                        <img src="images/setup.png" class="img-fluid">                        
                        <div class="card-body">
                            <code class="card-title">FindBooks</code>
                            <p class="card-text">Cette fonction permet de traiter tous les éléments de recherche du formulaire. Les composants du formulaire renvoient
                                ou non des valeurs selon les choix de l'utilisateur (L'utilisateur est libre d'entrer les options de recherches qui lui plaisent, sans 'required').
                                Les valeurs retournés par l'envoie du formulaire via la méthode POST sont donc ensuite passés en arguments de la fonction : une variable keywords
                                qui traite les expressions entrés dans l'input, la liste de livres étudiés, une liste fields dans laquelle on aura entré au préalable les données tel que
                                le mois, l'année, la recherche par titres, etc.
                                <br/>
                                Pour chaque boucle de recherche, un fichier texte de log est créé, et dans lequel des informations sont écrites.
                                Avant le traitement des données, on déclare une liste de livres trouvés. Quand le traitement est terminé, la liste est triée et les doublons trouvés sont supprimés. On appelle alors la fonction
                                showBooks pour afficher le résultat obtenu à l'utilisateur.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
                <style>/* CSS styles pour animer les cartes */
                    /*   Les index ne sont pas encore configurés de sorte à ce qu'il
                        y ait un effet de zoom sur les images présentant les fonctions.    */
                
                    .card {
                        overflow: hidden;
                        z-index: 1;
                    }
                    .card-body{
                        z-index: 5;
                    }
                    .card:hover img {
                        display: inherit;
                        cursor: alias;
                        z-index: inherit; 
                        transform: scale(1.12);
                        transition-duration: 1.8s;
                    }
                
                </style>
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