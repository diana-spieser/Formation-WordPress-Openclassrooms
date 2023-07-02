<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));

    // Ajouter du CSS pour form_container
    wp_enqueue_style(
        'custom-form-container-style',
        get_stylesheet_directory_uri() . '/css/shortcodes/custom-form-container.css',
        array(),
        filemtime(get_stylesheet_directory() . '/css/shortcodes/custom-form-container.css')
    );


    // Ajouter le js pour le formulaire de commandes
    wp_enqueue_script('form-script', get_stylesheet_directory_uri() . '/js/form-script.js', array(), filemtime(get_stylesheet_directory() . '/js/form-script.js'), true);
}


//Ajouter le menu custom
function register_custom_menu() {
    register_nav_menu('primary', 'Menu Rencontrer');
}
add_action('init', 'register_custom_menu');

//Ajouter le logo
function add_menu_logo() {
    ?>
<div class="menu-logo">
  <a href="<?php echo home_url(); ?>">
    <img src="<?php echo get_stylesheet_directory_uri() . '/logo.png'; ?>" alt="Logo" />
  </a>
</div>
<?php
}
add_action('wp_nav_menu', 'add_menu_logo');

//Afficher le bouton Admin
function display_admin( $items, $args ) {
    if (current_user_can('manage_options') && $args->theme_location == 'main_menu') {
        $admin_item = '<li id="menu-admin" class=""><a href="http://localhost/Planty/wp-admin/" class="menu-link"><span class="text-wrap">Admin</span></a></li>';
        $menu_items = preg_split('/<\ /li>/', $items);
        array_splice($menu_items, 1, 0, array($admin_item));
        $items = implode('</li>', $menu_items) . '</li>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'display_admin', 10, 2);


//Shortcode container-avis

function align_photos_shortcode() {
    ob_start();
    ?>
<div class="container-avis">
  <div class="image-container">
    <img src="http://localhost/planty/wp-content/uploads/2023/05/Fathia.png" alt="Fathia">
  </div>
  <div class="image-container">
    <img src="http://localhost/planty/wp-content/uploads/2023/05/Véro.png" alt="Véro">
  </div>
  <div class="image-container">
    <img src="http://localhost/planty/wp-content/uploads/2023/05/Marc.png" alt="Marc">
  </div>
</div>
<?php
    return ob_get_clean();
}
add_shortcode('align_photos', 'align_photos_shortcode');


//Shortcode formulaire de contact
function custom_form_shortcode() {
    ob_start();
?>

<div id="order-form">
  <div class="btns-container">
    <div class="btns-increment-container">
      <input type="number" name="quantite1" class="input-num" min="1" max="100" value="1" />
      <div class="btns-increment">
        <button type="button" class="btn-plus">+</button>
        <button type="button" class="btn-moins">-</button>
      </div>
      <input type="submit" class="submit-btn" value="Ok" />
    </div>
    <div class="btns-increment-container">
      <input type="number" name="quantite2" class="input-num" min="1" max="100" value="1" />
      <div class="btns-increment">
        <button type="button" class="btn-plus">+</button>
        <button type="button" class="btn-moins">-</button>
      </div>
      <input type="submit" class="submit-btn" value="Ok" />
    </div>
    <div class="btns-increment-container">
      <input type="number" name="quantite3" class="input-num" min="1" max="100" value="1" />
      <div class="btns-increment">
        <button type="button" class="btn-plus">+</button>
        <button type="button" class="btn-moins">-</button>
      </div>
      <input type="submit" class="submit-btn" value="Ok" />
    </div>
    <div class="btns-increment-container">
      <input type="number" name="quantite3" class="input-num" min="1" max="100" value="1" />
      <div class="btns-increment">
        <button type="button" class="btn-plus">+</button>
        <button type="button" class="btn-moins">-</button>
      </div>
      <input type="submit" class="submit-btn" value="Ok" />
    </div>
  </div>
  <div class="ligne-vericale"></div>
  <div class="col-container">
    <div class="col-left">
      <h2>Vos informations</h2>
      <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required />
      </div>
      <div class="form-group">
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required />
      </div>
      <div class="form-group">
        <label for="email">E-mail :</label>
        <input type="email" name="email" id="email" required />
      </div>
    </div>
    <div class="col-right">
      <h2>Livraison</h2>
      <div class="form-group">
        <label for="adresse">Adresse :</label>
        <input type="text" name="adresse" id="adresse" required />
      </div>
      <div class="form-group">
        <label for="code-postal">Code postal :</label>
        <input type="text" name="code-postal" id="code-postal" required />
      </div>
      <div class="form-group">
        <label for="ville">Ville :</label>
        <input type="text" name="ville" id="ville" required />
      </div>
    </div>
  </div>
  <div class="col-btn">
    <input type="submit" class="btn-submit" name="btn-submit" value=" Envoyer" />
  </div>
  <div class="confirmation-container">
  </div>
  <?php
    return ob_get_clean();
}
add_shortcode('custom_form', 'custom_form_shortcode');
?>
