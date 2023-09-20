jQuery(document).ready(function ($) {
  $('.popup-close').click(function () {
    $(this).closest('.popup-salon').hide();
    $('.popup-overlay').css('z-index', 'initial');
  });
});
