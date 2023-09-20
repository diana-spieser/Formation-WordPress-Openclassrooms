<?php

// Ajout des fonctionnalités du thème
add_action('after_setup_theme', function() {
    // Prise en charge des balises de titre <title> du thème
    add_theme_support('title-tag');

    // Prise en charge des menus personnalisés
    add_theme_support('menus');

    // Enregistrement des emplacements de menus : Menu principal et Menu pied de page
    register_nav_menus(array(
        'primary_menu' => __('Menu Principal'),
	'footer_menu'  => __('Menu Pied de Page'),
    ));
});

// Enqueue les styles du thème parent et le style personnalisé généré à partir de Sass
function theme_enqueue_styles() {
    // Ajout du style du thème parent
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

    // Ajout du style personnalisé généré à partir de Sass, dépendant du style du thème parent
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/styles/style.css', array('parent-style'), '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

// Enqueue le script "script.js" dépendant de jQuery et utilise AJAX
function custom_enqueue_scripts() {
    wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '', true);

    // Localize the script with the AJAX URL
    wp_localize_script('script', 'my_ajax_obj', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');
// Prise en charge des images mises en avant
add_theme_support('post-thumbnails');

function displayTaxonomies($nomTaxonomie) {
    if($terms = get_terms(array(
        'taxonomy' => $nomTaxonomie,
        'orderby' => 'name'
    ))) {
        foreach ( $terms as $term ) {
            echo '<option class="js-filter-item" value="' . $term->slug . '">' . $term->name . '</option>';
        }
    }
}



function filter() {
    $myAjaxRequest = new WP_Query(array(
        'post_type' => 'photos',
        'orderby' => 'date',
        'order' => $_POST['orderDirection'],
        'posts_per_page' => 4,
        'paged' => $_POST['page'],
        'tax_query' =>
            array(
                'relation' => 'AND',
                $_POST['categorieSelection'] != "all" ?
                    array(
                        'taxonomy' => $_POST['categorieTaxonomie'],
                        'field' => 'slug',
                        'terms' => $_POST['categorieSelection'],
                    )
                : '',
                $_POST['formatSelection'] != "all" ?
                    array(
                        'taxonomy' => $_POST['formatTaxonomie'],
                        'field' => 'slug',
                        'terms' => $_POST['formatSelection'],
                    )
                : '',
            )
        )
    );
    displayImages($myAjaxRequest, true);
}
add_action('wp_ajax_nopriv_filter', 'filter');
add_action('wp_ajax_filter', 'filter');



function displayImages($galerie, $exit) {
    if($galerie->have_posts()) {
        while ($galerie->have_posts()) { ?>
<?php $galerie->the_post(); ?>
<div class="colonne">
  <div class="rangee">
    <img class="img-medium" src="<?php echo the_post_thumbnail_url(); ?>" />
    <div>
      <div class="img-hover">
        <img class="btn-plein-ecran" src="<?php echo get_template_directory_uri(); ?>/assets/images/fullscreen.png"
          alt="Icône de plein écran" />
        <a href="<?php echo get_post_permalink(); ?>">
          <img class="btn-oeil" src="<?php echo get_template_directory_uri(); ?>/assets/images/eye_icon.png"
            alt="Icône en fome d'oeil" />
        </a>
        <div class="img-infos">
          <p><?php the_title(); ?></p>
          <p><?php echo strip_tags(get_the_term_list($galerie->ID, 'categories_photo')); ?></p>
        </div>
      </div>
    </div>
  </div>
</div> <?php
        }
    }
    else {
        echo "";
    }
    wp_reset_postdata();
    if ($exit) {
        exit();
    }
}
