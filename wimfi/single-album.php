<?php get_header(); ?>


<div class="content">

  <h2 class="entry-title"><?php the_title(); ?></h2>
  <?php the_post_thumbnail('medium'); ?>
  <?php the_content(); ?>
</div>


<?php get_footer(); ?>