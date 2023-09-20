<?php get_header();
/* if (have_posts()) { */
    /* while (have_posts()) {
        the_post(); */
?>

<div class="page-photo bloc-page">

  <section class="bloc-photo colonnes">
    <div class="bloc-photo__description colonne">
      <h1><?php the_title() ?></h1>
      <p>Référence : <span id="reference-photo"><?php echo get_field('reference_photo'); ?></span></p>
      <p>Catégorie : <?php echo strip_tags(get_the_term_list($post->ID, 'categories_photo')); ?></p>
      <p>Format : <?php echo strip_tags(get_the_term_list($post->ID, 'format')); ?></p>
      <p>Type : <?php echo get_field('type_photo'); ?></p>
      <p>Année : <?php echo get_the_date('Y'); ?></p>
    </div>
    <img class="bloc-photo__image colonne" src="<?php the_post_thumbnail_url(); ?>">
  </section>

  <section class="interaction-photo colonnes">
    <div>
      <p class="texte">Cette photo vous intéresse ?</p>
      <input class="interaction-photo__btn bouton btn-modale" type="button" value="Contact">
    </div>
    <div class="interaction-photo__navigation">
      <?php
                    $prevPost = get_previous_post();
                    $nextPost = get_next_post();
                ?>
      <div class="arrows">
        <?php if (!empty($prevPost)) {
                        $prevThumbnail = get_the_post_thumbnail_url( $prevPost->ID );
                        $prevLink = get_permalink($prevPost); ?>
        <a href="<?php echo $prevLink; ?>">
          <img class="arrow arrow-gauche" src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow_left.png"
            alt="Flèche pointant vers la gauche" />
        </a>
        <?php } else { ?>
        <img style="opacity:0; cursor: auto;" class="arrow "
          src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow_left.png" />
        <?php } if (!empty($nextPost)) {
                        $nextThumbnail = get_the_post_thumbnail_url( $nextPost->ID );
                        $nextLink = get_permalink($nextPost); ?>
        <a href="<?php echo $nextLink; ?>">
          <img class="arrow arrow-droite"
            src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow_right.png"
            alt="Flèche pointant vers la droite" />
        </a>
        <?php } ?>
      </div>
      <div class="preview">
        <img class="previous-image" src="<?php echo $prevThumbnail; ?>" alt="Prévisualisation image précédente">
      </div>
      <div class="preview">
        <img class="next-image" src="<?php echo $nextThumbnail; ?>" alt="Prévisualisation image suivante">
      </div>
    </div>
  </section>

  <section class="recommandations">
    <h2>Vous aimerez aussi</h2>
    <div class="recommandations__images colonnes">
      <?php
                $categorie = strip_tags(get_the_term_list($post->ID, 'categories_photo'));
                $random_images = new WP_Query(array (
                    'post_type' => 'photos',
                    'post__not_in' => array($post->ID),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'categories_photo',
                            'field' => 'slug',
                            'terms' => $categorie,
                        ),
                    ),
                    'orderby' => 'rand',
                    'posts_per_page' => '2'));

                $numberOfSimilarPictures = $random_images->post_count;
                if ($numberOfSimilarPictures > 0) {
                    displayImages($random_images, false);
                }
                else {
                    echo '<p class="texte">Il n\'y a pas encore d\'autres photos à afficher dans cette catégorie.</p>';
                }
                /* wp_reset_postdata(); */
            ?>

    </div>
    <button class="recommandations__btn bouton" onclick="window.location.href='<?php echo site_url() ?>'">
      Toutes les photos
    </button>

  </section>

</div>

<?php

/* }
else {

} */

get_footer(); ?>
