// SAE 23
//

const shareButton = document.querySelector('.partage');
const menuPartage = document.querySelector('.menu-partage');

shareButton.addEventListener('mouseover', () => {
  menuPartage.classList.remove("visually-hidden");
});

shareButton.addEventListener('mouseout', () => {
  setTimeout(() => {
    menuPartage.classList.add("visually-hidden");
  }, 2000);
});

// Lien de partage Twitter
const twitterLink = document.getElementById('twitter-link');
twitterLink.addEventListener('click', () => {
    const message = encodeURIComponent("Découvrez cette annonce en ligne. C'est incroyable !");
    window.open(('https://twitter.com/intent/tweet?text='+ message), '_blank');
  });

const facebookLink = document.getElementById('facebook-link');
facebookLink.addEventListener('click', () => {
  const message = encodeURIComponent("Découvrez cette annonce en ligne. Vous n'allez pas en croire vos yeux, tellement c'est incroyable ! O_o ");
  const url = encodeURIComponent("www.tripkingcom/page_annonce.php");
  const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}&quote=${message}`;
  window.open(facebookUrl, '_blank');
});
