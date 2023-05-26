// Select the button
const btn = document.querySelector(".btn-theme");
 
// Listen for a click on the button 
btn.addEventListener("click", function() {
  // Toggle the .dark-theme class on the body
  document.body.classList.toggle("bg-dark");
  
  // Let's say the theme is equal to light
  let theme = "light";
  // If the body contains the .dark-theme class...
  if (document.body.classList.contains("bg-black")) {
    // ...then let's make the theme dark
    theme = "bg-light";
  }
  // Then save the choice in a cookie
  document.cookie = "theme=" + theme;
});