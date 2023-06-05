function onSelectChange() {
    var annonce = document.form_modif.titre_annonce.value;
    console.log(document.form_modif.titre_annonce.value);
    document.getElementsByName("nv_titre")[0].placeholder = annonce;
    fetch('./annonces/annonces.json')
        .then(response => response.json())
        .then((json) => console.log(json))
        .then((data) => {
            // Avec data => la base de donnée json récupérer via javascript
            //https://www.freecodecamp.org/news/how-to-read-json-file-in-javascript/
            for (var i = 0; i < data.length; i++) {
                if (data[i].annonce === annonce) {
                    annonceTrouvee = true;
                    console.log("Annonce trouvée : ", data[i]);
                    document.getElementsByName("nv_lieu")[0].placeholder = data[i].lieu;
                    document.getElementsByName("nv_titre")[0].placeholder = data[i].titre;
                    break;
                }
            }

        });
    

}
