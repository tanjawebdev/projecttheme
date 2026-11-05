<?php
/** Template: Default Page */
get_header(); ?>

<main id="main" class="site-main">
  <?php
  if (have_posts()) : while (have_posts()) : the_post();

    // ACF Flexible Content vorhanden?
    if (function_exists('have_rows') && have_rows('page_modules')) {
      // Rendert alle Module der Seite
      get_template_part('templates/render', 'page-modules');
    } else {
      // Fallback: klassischer Editor-Inhalt
      echo '<section class="section py-5"><div class="container-lg">';
        the_title('<h1 class="mb-4">','</h1>');
        the_content();
      echo '</div></section>';
    }

  endwhile; endif;
  ?>
</main>

<?php get_footer(); ?>