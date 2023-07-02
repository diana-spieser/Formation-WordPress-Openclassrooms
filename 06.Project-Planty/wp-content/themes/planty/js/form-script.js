// JavaScript pour modifier la quantité des produits avec les buttons + et -
const incrementContainers = document.querySelectorAll(
  '.btns-increment-container'
);

incrementContainers.forEach((container) => {
  const input = container.querySelector('.input-num');
  const plusBtn = container.querySelector('.btn-plus');
  const minusBtn = container.querySelector('.btn-moins');

  plusBtn.addEventListener('click', () => {
    input.stepUp();
  });

  minusBtn.addEventListener('click', () => {
    input.stepDown();
  });
});

// Empêche le comportement par défaut du bouton
const okBtns = document.querySelectorAll(
  '.btns-increment-container .submit-btn'
);
okBtns.forEach((btn) => {
  btn.addEventListener('click', function (event) {
    event.preventDefault();
  });
});


document.addEventListener('DOMContentLoaded', function () {
  const submitBtn = document.querySelector('#order-form .btn-submit');

  submitBtn.addEventListener('click', function (event) {
    event.preventDefault();

    // Vérifier si tous les champs obligatoires sont remplis
    const nom = document.querySelector('#nom').value;
    const prenom = document.querySelector('#prenom').value;
    const email = document.querySelector('#email').value;
    const adresse = document.querySelector('#adresse').value;
    const codePostal = document.querySelector('#code-postal').value;
    const ville = document.querySelector('#ville').value;

    if (
      nom === '' ||
      prenom === '' ||
      email === '' ||
      adresse === '' ||
      codePostal === '' ||
      ville === ''
    ) {
      // Afficher un message d'erreur si les champs obligatoires sont vides
      const errorContainer = document.querySelector('.confirmation-container');
      errorContainer.innerHTML =
        '<div class="error-message">Veuillez remplir tous les champs obligatoires.</div>';
    } else {
      // Afficher la confirmation encadrée
      const confirmationContainer = document.querySelector(
        '.confirmation-container'
      );
      confirmationContainer.innerHTML =
        '<div class="confirmation-message">Votre commande a été envoyée.</div>';

      // Rafraîchir la page après 3 secondes
      setTimeout(function () {
        location.reload();
      }, 3000);
    }
  });
});
