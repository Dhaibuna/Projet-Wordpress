<?php get_header() ?>

<?php
// Je déclare deux variables dont j'ai été chercher les données avec un var_dump juste avant
$about_image = get_field("about_image");
$about_url = $about_image["url"];
$about_alt = $about_image["alt"];
?>
<main class="main-content">
  <div class="fullwidth-block inner-content">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <div class="content">
            <h2 class="entry-title">Our History</h2>
            <figure class="featured-image">
              <!-- Là je vais rechercher mon image déclarée dans ma variable -->
              <img src="<?php echo $about_url; ?>" alt="<?php echo $about_alt; ?>" />
            </figure>
            <?php the_field("about_description"); ?>
          </div>
        </div>
        <div class=" col-md-4 col-md-push-1">
          <aside class="sidebar">
            <div class="widget">
              <h3 class="widget-title">Discography</h3>
              <ul class="discography-list">
                <!-- Je vais récupérer les posts de dans l'admin wordpress avec JQuery -->
                <?php
                $args = array('post_type' => 'album');
                $albums = new WP_Query($args);
                ?>
                <!-- Je fais une boucle sur les albums en créant, pour chaque article, une balise <li>. J'ai donc deux boucles. -->
                <?php if ($albums->have_posts()) : ?>

                <?php while ($albums->have_posts()) : $albums->the_post(); ?>
                <?php get_template_part("template-parts/content", "single-album"); ?>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                <?php endif; ?>
              </ul>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </div>
  <!-- .testimonial-section -->
</main>
<!-- .main-content -->


<?php get_footer() ?>