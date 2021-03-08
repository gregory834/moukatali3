
// MODAL SUPPRESSION UTILISATEUR
btn = document.getElementById('confirm');

popup = document.getElementById('popup');

btn.addEventListener('click', evt => {
    popup.classList.remove('hidden')
    popup.classList.add('visibility')
})


// AFFICHAGE IMAGE TOPIC LORS DE LA CREATION
function triggerClick(e) {
    document.querySelector('#picture').click();
  }
  function displayImage(e) {
    if (e.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e){
        document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
      }
      reader.readAsDataURL(e.files[0]);
    }
  }

  