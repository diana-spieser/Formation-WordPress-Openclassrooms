</main>

<?php
    get_template_part('modale');
    get_template_part('lightbox');
?>

<footer class="footer">
  <nav class="footer__nav">
    <?php
        if (has_nav_menu('primary_menu')) {
            wp_nav_menu(array('theme_location' => 'footer_menu',));
        } ?>
    <ul>
      <li>Tous droits réservés</li>
    </ul>
  </nav>
  <?php wp_footer() ?>
</footer>

</body>

</html>
