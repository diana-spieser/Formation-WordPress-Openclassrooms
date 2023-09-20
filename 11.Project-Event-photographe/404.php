<?php get_header(); ?>

<div class="page page-404">
  <h1>Page introuvable</h1>
  <div class="page__contenu">
    <button class="recommandations__btn bouton" onclick="window.location.href='<?php echo site_url() ?>'">
      Toutes les photos
    </button>
  </div>
</div>

<?php get_footer(); ?>
