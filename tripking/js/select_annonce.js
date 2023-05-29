function onSelectChange(){
    $annonce = document.form_modif.titre_annonce.value;
    console.log(document.form_modif.titre_annonce.value);
    document.getElementsByName("nv_titre")[0].placeholder = $annonce;
}