<?php
/*
Template Name: Generic Title
*/
?>

<?php get_header() ?>
<?php while (have_posts()) : the_post(); ?>
<main class="main-content">
  <div class="fullwidth-block inner-content">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="content">
            <h2 class="entry-title" style="color:#FD5921;"><?php the_title(); ?></h2>
            <?php the_content(); ?>
            <a href=" <?php the_field("link_url"); ?>" class="button"><i class="fa fa-link"></i>
              <?php the_field("link_title"); ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main> <!-- .main-content -->
<?php endwhile; ?>
<?php get_footer() ?>