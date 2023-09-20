<?php
/**
 * The Header for our theme.
 *
 * @package OceanWP WordPress theme
 */

?>
<!DOCTYPE html>
<html class="<?php echo esc_attr( oceanwp_html_classes() ); ?>" <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <link rel="profile" href="https://gmpg.org/xfn/11">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php oceanwp_schema_markup( 'html' ); ?>>

  <?php wp_body_open(); ?>

  <?php do_action( 'ocean_before_outer_wrap' ); ?>

  <div id="outer-wrap" class="site clr">

    <a class="skip-link screen-reader-text"
      href="#main"><?php oceanwp_theme_strings( 'owp-string-header-skip-link', 'oceanwp' ); ?></a>

    <?php do_action( 'ocean_before_wrap' ); ?>

    <div id="wrap" class="clr">

      <?php do_action( 'ocean_top_bar' ); ?>

      <?php do_action( 'ocean_header' ); ?>

      <?php do_action( 'ocean_before_main' ); ?>

      <main id="main" class="site-main clr" <?php oceanwp_schema_markup( 'main' ); ?> role="main">

        <?php do_action( 'ocean_page_header' ); ?>
        <!-- Ajout d'une popup pour annoncer la participation au salon -->
        <?php if (is_front_page()) { ?>

        <div class="popup-overlay">
          <div class="popup-salon">
            <div class="popup-header">
              <h3>MediIT intervient au salon "World Medical" à New York !</h3>
              <span class="popup-close"><i class="fa fa-times"></i></span>
            </div>
            <p>Venez découvrir notre intervention concernant la transformation digitale dans le secteur médical.</p>
            <div class="popup-details">
              <div class="popup-address">
                <p><b>Le lieu</b></p>
                Madison Avenue<br>New York NY 10017<br>646-844-6004
                <a class="popup-link" href="https://maps.google.com/maps?q=Madison+Avenue,New+York+NY+10017"
                  target="_blank">Voir sur Google Maps</a>
              </div>
              <div class="popup-address">
                <p><b>La date</b></p>
                Du lundi 3 septembre<br>Au mercredi 5 septembre<br>Intervention le 3 à 9h
              </div>
            </div>
            <p class="popup-informations">Vous souhaitez plus d'informations concernant cet événement ?</p>
            <?php echo do_shortcode('[contact-form-7 id="910" title="Formulaire salon New York"]'); ?>
            <!-- <a href="http://localhost/medit/contact/" class="form-contact-btn">CONTACT</a> -->
          </div>
        </div>

        <?php } ?>

      </main>

      <?php do_action( 'ocean_after_main' ); ?>

      <?php do_action( 'ocean_sidebar' ); ?>

      <?php do_action( 'ocean_after_wrap' ); ?>

    </div>

    <?php do_action( 'ocean_after_outer_wrap' ); ?>

  </div>

  <?php wp_footer(); ?>

</body>

</html>
