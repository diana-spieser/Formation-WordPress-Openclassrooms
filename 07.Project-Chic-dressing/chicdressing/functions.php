<?php

add_action( 'wp_enqueue_scripts', 'chicdressing_enqueue_styles' );
function chicdressing_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

add_filter( 'big_image_size_threshold', '__return_false' );


function deregister_child_theme_fonts() {
    wp_dequeue_style( 'ashe-playfair-font' );
    wp_dequeue_style( 'ashe-opensans-font' );
    wp_dequeue_style( 'ashe-kalam-font' );
    wp_dequeue_style( 'ashe-rokkitt-font' );
}
add_action( 'wp_enqueue_scripts', 'deregister_child_theme_fonts', 20 );

// function my_custom_csp() {
//     $csp_directives = "script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' http://0.gravatar.com;";
//     header("Content-Security-Policy: " . $csp_directives);
// }
// add_action('wp_enqueue_scripts', 'my_custom_csp');
