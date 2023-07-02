<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
</body> <?php wp_body_open(); ?>
<header>
  <nav>

    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-links' ) ); ?>
    <ul class="nav-links">
      <li><a href="<?php echo esc_url( home_url( '/index.php/nous-rencontrer/' ) ); ?>">Nous rencontrer</a></li>
      <?php if ( is_user_logged_in() ) { ?>
      <li><a href="<?php echo esc_url( admin_url() ); ?>">Admin</a></li>
      <?php } ?>
      <li><a href="<?php echo esc_url( home_url( '/index.php/commander/' ) ); ?>">Commander</a></li>
    </ul>
  </nav>
</header>