<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

// Enqueue main.css file
wp_enqueue_style( 'foce-child-style', get_stylesheet_directory_uri() . '/dist/css/main.css', array(), '1.0', 'all' );

// Enqueue swiper-bundle.min.css file
wp_enqueue_style( 'swiper-style', get_stylesheet_directory_uri() . '/dist/css/swiper-bundle.min.css' );

// Enqueue jQuery Modal script
wp_enqueue_script( 'jquery-modal', get_stylesheet_directory_uri() . '/dist/js/jquery.modal.js', array( 'jquery' ),
'0.9.2', true );

// Enqueue swiper-bundle.min.js file
wp_enqueue_script( 'swiper-element-bundle.min', get_theme_file_uri( '/dist/js/swiper-bundle.min.js'), array(), '9.2.0',
true );

// Enqueue custom-scripts.js file
wp_enqueue_script( 'order-custom-scripts', get_theme_file_uri( '/dist/js/custom-scripts.js' ), array('jquery'), '1.0.0',
true );
}

// Get customize options from the parent theme
if ( get_stylesheet() !== get_template() ) {
add_filter( 'pre_update_option_theme_mods_' . get_stylesheet(), function ( $value, $old_value ) {
update_option( 'theme_mods_' . get_template(), $value );
return $old_value; // prevent update to child theme mods
}, 10, 2 );
add_filter( 'pre_option_theme_mods_' . get_stylesheet(), function ( $default ) {
return get_option( 'theme_mods_' . get_template(), $default );
} );
}
