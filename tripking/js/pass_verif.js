let checkb = document.getElementById("dontwatchme");
let checka = document.getElementById("yes");
let passwds = document.getElementsByClassName("passwords");
let passwd = document.getElementsByClassName("password");
checkb.addEventListener("click", function(){
    Array.from(passwds).forEach(function(password, i) {
        if (password.getAttribute("type") === "password") {
            password.setAttribute("type", "text");
        } else {
            password.setAttribute("type", "password");
        }
    });
});
checka.addEventListener("click", function(){
    if (passwd[0].getAttribute("type") === "password") {
        passwd[0].setAttribute("type", "text");
    } else {
        passwd[0].setAttribute("type", "password");
    }
});


