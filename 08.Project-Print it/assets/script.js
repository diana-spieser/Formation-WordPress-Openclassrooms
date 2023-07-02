// Déclaration et initialisation du tableau des diapositives
const slides = [
  {
    image: 'slide1.jpg',
    tagLine: 'Impressions tous formats <span>en boutique et en ligne</span>',
  },
  {
    image: 'slide2.jpg',
    tagLine:
      'Tirages haute définition grand format <span>pour vos bureaux et events</span>',
  },
  {
    image: 'slide3.jpg',
    tagLine: 'Grand choix de couleurs <span>de CMJN aux pantones</span>',
  },
  {
    image: 'slide4.png',
    tagLine: 'Autocollants <span>avec découpe laser sur mesure</span>',
  },
];

// Sélection des éléments du DOM nécessaires
const carrouselImages = document.querySelectorAll('#banner .banner-img');
const dotsContainer = document.querySelector('#banner .dots');
  // const tagLine = document.querySelector('#banner p');
// Variable pour suivre l'index de la diapositive actuellement affichée
let currentSlideIndex = 0;

// Fonction pour mettre à jour la diapositive en fonction de l'index fourni
function updateSlide(index) {
  carrouselImages.forEach((image, i) => {
    // Mise à jour de chaque image du carrousel avec la nouvelle image et l'attribut alt
    image.src = `./assets/images/slideshow/${slides[index].image}`;
    image.alt = `Banner Print-it${slides[index].image}`;
  });

  // updateSlide(0); // Met à jour les images avec les informations de la première diapositive
  // updateSlide(2); // Met à jour les images avec les informations de la troisième diapositive

  // Mise à jour de la ligne de texte correspondante à la diapositive
  const tagLine = document.querySelector('#banner p');
  tagLine.innerHTML = slides[index].tagLine;

  // Mise à jour des points du carrousel
  const dots = document.querySelectorAll('#banner .dots .dot');
  dots.forEach((dot, i) => {
    // Ajout de la classe dot_selected pour le point correspondant à la diapositive actuelle
    if (i === index) {
      dot.classList.add('dot_selected');
    } else {
      dot.classList.remove('dot_selected');
    }
  });
}

function changeSlides(direction) {
  if (direction === 'next') {
    currentSlideIndex = (currentSlideIndex + 1) % slides.length;
  } else if (direction === 'prev') {
    currentSlideIndex = (currentSlideIndex - 1 + slides.length) % slides.length;
  }
  updateSlide(currentSlideIndex);
}

// Boucle pour créer un point pour chaque image du carrousel
slides.forEach((slide, index) => {
  const dot = document.createElement('div');
  dot.classList.add('dot');
  // Ajout de la classe dot_selected pour le premier point (diapositive actuelle)
  if (index === 0) {
    dot.classList.add('dot_selected');
  }
  // Ajout du point au conteneur des points du carrousel
  dotsContainer.appendChild(dot);
});

// Sélection de tous les points du carrousel
const dots = document.querySelectorAll('#banner .dots .dot');
dots.forEach((dot, index) => {
  // Ajout d'un event listener à chaque point
  dot.addEventListener('click', () => {
    // Mise à jour de la diapositive en fonction de l'index du point cliqué
    currentSlideIndex = index;
    updateSlide(currentSlideIndex);
  });
});

// Sélection des flèches du carrousel
const leftArrow = document.querySelector('#banner .arrow_left');
const rightArrow = document.querySelector('#banner .arrow_right');

// Ajout d'un gestionnaire d'événement click à la flèche gauche
leftArrow.addEventListener('click', () => {
  // Appel de la fonction changeSlides avec l'argument 'prev' pour passer à la diapositive précédente
  changeSlides('prev');
});

// Ajout d'un gestionnaire d'événement click à la flèche droite
rightArrow.addEventListener('click', () => {
  // Appel de la fonction changeSlides avec l'argument 'next' pour passer à la diapositive suivante
  changeSlides('next');
});
