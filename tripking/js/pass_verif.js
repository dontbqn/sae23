let checkb = document.getElementById("dontwatchme");
let passwds = document.getElementsByClassName("passwords");


checkb.addEventListener("click", function(){
    Array.from(passwds).forEach(function(password, i) {
        if (password.getAttribute("type") === "password") {
            password.setAttribute("type", "text");
        } else {
            password.setAttribute("type", "password");
        }
    });
});


// Work in progress .. 
// Pour éviter d'avoir le bouton 'rendre visible' inutilisable sur la page inscription.php ou page06 (admin page),
// Dans lesquelles on utilise aussi un bouton 'rendre visible'

let checka = document.getElementById("yes");
let passwd = document.getElementsByClassName("password");
checka.addEventListener("click", function(){
    if (passwd[0].getAttribute("type") === "password") {
        passwd[0].setAttribute("type", "text");
    } else {
        passwd[0].setAttribute("type", "password");
    }
});


