<?php get_header() ?>

<?php if (have_posts()) : ?>
<?php
  // On commence la boucle
  while (have_posts()) : the_post();
    get_template_part('template-parts/content', get_post_format());
  // End the loop.
  endwhile;

  // Page de navigation précédente/suivante.
  the_posts_pagination(array(
    'prev_text' => __('Previous page', 'wimfi'),
    'next_text' => __('Next page', 'wimfi'),
    'before_page_number' => '<span class ="meta-nav screen-reader-text">' . __('Page', 'wimfi') . '</span>',
  ));

// S'il n'y a pas de contenu, inclure "Aucun contenu disponible" template. active
else :
  get_template_part('template-parts/content', 'none');
endif;
?>

<?php get_footer() ?>