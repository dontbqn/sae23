// Lorsqu'une annonce est cliquée
function onSelectChange(){ 
    $annonce = document.form_modif.titre_annonce.value;
    //console.log(document.form_modif.titre_annonce.value);
    document.getElementsByName("nv_titre")[0].placeholder = $annonce;
    fetch('./annonces/annonces.json')
        .then(response => response.json())
        .then(data => {
            // Parcours des données pour trouver la correspondance
            var annonceTrouvee = false;
            for (var i = 0; i < data.length; i++) {
                if (data[i].annonce === annonce) {
                    annonceTrouvee = true;
                    console.log("Annonce trouvée : ", data[i]);
                    document.getElementsByName("nv_lieu")[0].placeholder = data[i]["lieu"];
                    //document.getElementsByName("nv_titre")[0].placeholder;
                    break;
                }
            }
            if (!annonceTrouvee) {
            console.log("Annonce non trouvée.");
            }
        })
    .catch(error => {
        console.error("Erreur lors du chargement de annonces.json : ", error);
    });

}