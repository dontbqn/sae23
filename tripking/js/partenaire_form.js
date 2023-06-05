var imageFileInput = document.getElementById('imageFile');
var imagePreview = document.getElementById('imagePreview');
var previewTitle = document.getElementById('previewTitle');
var previewDesc = document.getElementById('previewDesc');
var form = document.getElementById('partenaireForm');

imageFileInput.addEventListener('change', function(e) {
  if (imageFileInput.files && imageFileInput.files[0]) { // Vérifie si un fichier est entré par le partenair
    var reader = new FileReader();
    reader.onload = function(e) {
        imagePreview.src = e.target.result; //FileReader.result
        imagePreview.style.display = 'block';
        previewTitle.textContent = document.getElementById('part_entr').value;
        previewDesc.textContent = document.getElementById('part_descr').value;
        // Soumission automatique
        var formData = new FormData(form);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', './modif_part.php', true);
        xhr.send(formData);
    };
    reader.readAsDataURL(imageFileInput.files[0]);
  } 
  else {
    imagePreview.src = "#";
    imagePreview.style.display = 'block';
    previewTitle.textContent = '';
    previewDesc.textContent = '';
  }
});

