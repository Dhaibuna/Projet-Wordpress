<?php get_header() ?>
<main class="main-content">
  <div class="fullwidth-block inner-content">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <div class="content">
            <h2 class="entry-title"><?php single_post_title(); ?></h2>
            <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/content', 'single'); ?>
            <?php endwhile; ?>
          </div>
        </div>
        <div class=" col-md-4 col-md-push-1">
          <aside class="sidebar">
            <div class="widget">
              <h3 class="widget-title">Discographie</h3>
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
</main>
<?php get_footer() ?>