let checka = document.getElementById("yes");
let passwd = document.getElementsByClassName("hidden-ps");
checka.addEventListener("click", function(){
    Array.from(passwd).forEach(function(password, i) {
        if (password.getAttribute("type") === "password") {
            password.setAttribute("type", "text");
        } else {
            password.setAttribute("type", "password");
        }
    });
});