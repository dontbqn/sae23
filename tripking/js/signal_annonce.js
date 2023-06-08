function signal_annonce(report) {//./contact/aide.php
  var xhr = new XMLHttpRequest();  // Préparation de l'objet XHR  
  console.log(report.href);
  var urlParams = new URLSearchParams(new URL(report.href).search); 
  // Récupération de la valeur du paramètre
  var paramValue = urlParams.get("id");
  console.log(paramValue);


  // Envoie de l'objet XHR  
  xhr.open("POST", "./annonces/signalements.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
}