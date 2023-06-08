function signal_annonce(report) {  
  /*
    Difficulté rencontrée : lors de l'envoie, le post n'avait pas le temps de s'envoyer 
    Solution : Modifier la balise <a> => par exemple ajouter target="_blank" 
    https://stackoverflow.com/questions/13085158/ns-binding-aborted-error-for-ajax-function
  */
  var xhr = new XMLHttpRequest();  // Préparation de l'objet XHR  
  console.log(report.href);
  var urlParams = new URLSearchParams(new URL(report.href).search); 
  // Récupération de la valeur du paramètre
  var paramValue = urlParams.get("id");
  console.log(paramValue);


  // Ouverture de l'objet XHR, préparation à l'envoi
  xhr.open("POST", "./annonces/signalements.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    //Even Listener d'AJAX
    if (xhr.readyState === 4 && xhr.status === 200) {
        if(xhr.responseText.trim() === ""){
          // trim() : Si la réponse nettoyée ne contient que des espaces vides, 
          //le message sera affiché dans la console
          console.log("Aucune réponse du fichier php");
        }
        else{
          console.log(xhr.responseText);
        }
    }
};
//console.log("id="+encodeURIComponent(paramValue));
xhr.send("id="+encodeURIComponent(paramValue));
}