<?php
/**
 * Child theme functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Text Domain: oceanwp
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function oceanwp_child_enqueue_parent_style() {
  // Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
  $theme   = wp_get_theme( 'OceanWP' );
  $version = $theme->get( 'Version' );
  // Load the stylesheet
  wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'oceanwp-style' ), $version );
}
add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_parent_style' );

/**
 * Enqueue custom script
 */
function oceanwp_child_enqueue_scripts() {
  // Enqueue custom script
  wp_enqueue_script( 'oceanwp-child-custom-script', get_stylesheet_directory_uri() . '/scripts/script.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'oceanwp_child_enqueue_scripts' );

/**
 * Add "Contact" button to navigation menu
 */
function contact_btn( $items, $args ) {
  $contact_url = home_url( '/contact/' );
  $items .= '<a href="' . esc_url( $contact_url ) . '" class="contact-btn">Nous contacter</a>';
  return $items;
}
add_filter( 'wp_nav_menu_items', 'contact_btn', 10, 2 );