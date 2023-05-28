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




