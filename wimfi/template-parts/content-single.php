<div class="post">
  <div class="entry-date">

    <div class="date"> <?php echo get_the_date('d'); ?></div>
    <span class="month"> <?php echo get_the_date('M'); ?></span>


  </div>
  <div class="featured-image">
    <!-- Là je modifie la taille d'affichage de mon thumbnail -->
    <?php the_post_thumbnail('medium_large') ?>
  </div>
  <h2 class="entry-title">
    <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h2>

  <?php the_excerpt(); ?>


</div>