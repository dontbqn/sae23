// Select toggler button
const btn = document.querySelector(".btn-theme");

btn.addEventListener("click", function() {
  // Toggle the bg-dark class on body
  document.body.classList.toggle("bg-dark");
  const pseudo = document.querySelector(".pseudo"); // Navbar Username
  pseudo.classList.toggle("text-light");

  const offcanvas = document.querySelector(".offcanvas"); // Sidebar body
  offcanvas.classList.toggle("bg-dark");

  const offitems = document.querySelectorAll(".nav-item.list-group-item"); // Sidebar Items

  let footlinks = document.querySelectorAll(".footlink");
  
  if (document.body.classList.contains("bg-dark")) {
    document.body.classList.add("text-light");
    footlinks.forEach((element) => {
      element.classList.replace("text-black-50","text-white-50");
    });

    offitems.forEach((element) => {
      element.classList.toggle("bg-dark");
      element.classList.add("text-light");
    });
  }
  else {
    document.body.classList.remove("text-light");
    footlinks.forEach((element) => {
      element.classList.replace("text-white-50","text-black-50");
    });
    offitems.forEach((element) => {
      element.classList.remove("bg-dark");
      element.classList.remove("text-light");
    });
    pseudo.classList.remove("text-light");
  }
});
