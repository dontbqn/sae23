function moveText() {
    var text = document.querySelector('.navbar-text');
    text.classList.add('move-left');

    setTimeout(function() {
        text.classList.remove('move-left');
    }, 10000000); // Temps en millisecondes après lequel la classe sera supprimée
}
moveText();