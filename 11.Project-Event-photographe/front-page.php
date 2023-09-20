<?php get_header() ?>

<section class="hero">
  <h1>Photographe event</h1>
  <?php
        $random_image = new WP_Query(array (
            'post_type' => 'photos',
            'tax_query' => array(
                array(
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => 'paysage',
                ),
            ),
            'orderby' => 'rand',
            'posts_per_page' => '1'));
        if ($random_image->have_posts()) {
            while ($random_image->have_posts()) {
                $random_image->the_post();
                echo '<img class="hero__background" src="';
                echo the_post_thumbnail_url();
                echo '" />';
            }
        }
        wp_reset_postdata();
    ?>
</section>

<section class="galerie bloc-page">

  <div class="filtres colonnes">

    <div class="filtres__taxonomie colonnes colonne">
      <form id="categories_photo" class="js-filter-form filtres__taxonomie_categories filtre colonne">
        <label for="select-categorie">Catégories</label>
        <select id="select-categorie" name="categories_photos">
          <option value="all" hidden></option>
          <option value="all">Toutes les catégories</option>
          <?php displayTaxonomies('categories_photo'); ?>
        </select>
      </form>
      <form id="format" class="js-filter-form filtres_taxonomie__formats filtre colonne">
        <label for="select-format">Formats</label>
        <select id="select-format" name="format">
          <option value="all" hidden></option>
          <option value="all">Tous les formats</option>
          <?php displayTaxonomies('format'); ?>
        </select>
      </form>
    </div>

    <div class="filtres__tri colonnes colonne">
      <div class="colonne">
      </div>
      <form id="ordre" class="js-filter-form filtres_taxonomie__formats filtre colonne">
        <label for="select-ordre">Trier par</label>
        <select id="select-ordre" name="ordre">
          <option class="js-ordre-item" value="DESC">Nouveautés</option>
          <option class="js-ordre-item" value="ASC">Les plus anciens</option>
        </select>
      </form>
    </div>

  </div>

  <div class="galerie__photos colonnes">
    <?php
            $galerie = new WP_Query(array (
                'post_type' => 'photos',
                'orderby' => 'date',
                'order' => 'DESC',
                'posts_per_page' => 4,
                'paged' => 1)
            );
            displayImages($galerie, false);
        ?>
  </div>
  <div class="galerie__btn" id="galerie__btn">
    <input type=" button" style="text-align: center;" value="Charger plus">
    <img id="btn-load-more" src="<?php echo get_template_directory_uri(); ?>/assets/images/camera_icon.png"
      alt="Icône d'appareil photo" />
  </div>

</section>

<?php get_footer() ?>
