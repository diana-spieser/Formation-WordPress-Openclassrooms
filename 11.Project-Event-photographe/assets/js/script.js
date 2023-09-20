(function ($) {
  'use strict';

  $('.wpcf7-submit').addClass('bouton');

  var dureeTransitionPopup = 500;
  var modale = document.getElementById('modale-container');
  var lightbox = document.getElementById('lightbox-container');
  var btnFermetureModale = document.getElementById('close-modale');
  var btnFermetureLightbox = document.getElementById('close-lightbox');

  $('.btn-modale').click(function () {
    transitionPopup($('.modale'), 1);
  });
  btnFermetureModale.onclick = function () {
    transitionPopup($('.modale'), 0);
  };
  window.onclick = function (event) {
    if (event.target == modale) {
      transitionPopup($('.modale'), 0);
    }
  };

  $(document).on('click', '.btn-plein-ecran', function () {
    var image = $(this).parent().parent().prev();
    var urlImage = image.attr('src');
    var creerImage = '<img src="' + urlImage + '" alt="Image agrandie">';
    $('.lightbox__image').html(creerImage);
    transitionPopup($('.lightbox'), 1);
  });
  btnFermetureLightbox.onclick = function () {
    transitionPopup($('.lightbox'), 0);
  };

  function transitionPopup(element, opacity) {
    if (opacity == 1) {
      $(element).css('display', 'flex');
    } else if (opacity == 0) {
      setTimeout(function () {
        $(element).css('display', 'none');
      }, dureeTransitionPopup);
    }
    $(element).animate(
      {
        opacity: opacity,
      },
      dureeTransitionPopup
    );
  }

  let menuMobileOrigine = $('.header-mobile').height() * -1;
  let menuOuvert = -1;
  $('.header-mobile').css('margin-top', menuMobileOrigine);

  $('.header__btn-menu').click(function () {
    if (menuOuvert == -1) {
      $('.header-mobile').css('opacity', '1');
      effetMenu(0, 0);
    } else {
      effetMenu(1, menuMobileOrigine);
      setTimeout(function () {
        $('.header-mobile').css('opacity', '0');
      }, dureeTransitionPopup);
    }
  });

  function effetMenu(opacite, position) {
    setTimeout(function () {
      $('.header-desktop').css('opacity', opacite);
    }, dureeTransitionPopup / 2);
    $('.header-mobile').animate(
      {
        'margin-top': position,
      },
      dureeTransitionPopup
    );
    menuOuvert = menuOuvert * -1;
  }

  jQuery(document).ready(function ($) {
    $('.interaction-photo__btn').click(function () {
      var reference = $('#reference-photo').text();
      $('#reference-form-field').val(reference);
    });
  });

  navigationPhotos($('.arrow-gauche'), $('.previous-image'));
  navigationPhotos($('.arrow-droite'), $('.next-image'));

  function navigationPhotos(arrow, image) {
    arrow.hover(
      function () {
        image.css('opacity', '1');
      },
      function () {
        image.css('opacity', '0');
      }
    );
  }

  let pageActuelle = 1;

  $('#btn-load-more').on('click', function () {
    pageActuelle++;
    ajaxRequest(true);
  });

  $(document).on('change', '.js-filter-form', function (e) {
    e.preventDefault();
    pageActuelle = 1;
    ajaxRequest(false);
  });

  function ajaxRequest(chargerPlus) {
    var categorieSelection = $('#select-categorie').val();
    var formatSelection = $('#select-format').val();
    var ordre = $('#select-ordre').val();

    $.ajax({
      type: 'POST',
      url: my_ajax_obj.ajax_url,
      dataType: 'html',
      data: {
        action: 'filter',
        categorieTaxonomie: 'categories_photo',
        categorieSelection: categorieSelection,
        formatTaxonomie: 'format',
        formatSelection: formatSelection,
        orderDirection: ordre,
        page: pageActuelle,
      },
      success: function (resultat) {
        if (chargerPlus) {
          $('.galerie__photos').append(resultat);
        } else {
          $('.galerie__photos').html(resultat);
        }

        if (categorieSelection === 'mariage' && pageActuelle >= 3) {
          $('#galerie__btn').attr('style', 'display: none;');
        } else if (pageActuelle === 5) {
          $('#galerie__btn').attr('style', 'display: none;');
        } else if (
          (categorieSelection === 'concert' ||
            categorieSelection === 'reception' || categorieSelection === 'television') &&
          pageActuelle === 1
        ) {
          $('#galerie__btn').attr('style', 'display: none;');
        } else {
          $('#galerie__btn').attr('style', 'display: block;');
        }
      },
      error: function (result) {
        console.warn(result);
      },
    });
    }







})(jQuery);
