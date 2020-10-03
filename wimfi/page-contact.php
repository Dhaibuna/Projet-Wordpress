<?php get_header() ?>
<?php while (have_posts()) : the_post(); ?>
<main class="main-content">
  <div class="fullwidth-block inner-content">
    <div class="container">
      <h2 class="page-title">Contactez-nous</h2>
      <div class="row">
        <div class="col-md-6">
          <form action="#" class="contact-form">
            <?php get_field("relation"); ?>
            <?php echo do_shortcode('[contact-form-7 id="173" title="Contactez-nous"]'); ?>
          </form>
        </div>
        <div class="col-md-6">
          <div class="map-wrapper">
            <?php the_field("map"); ?>
            <address>
              <div class="row">
                <div class="col-sm-6">
                  <strong> <?php the_field("nom"); ?></strong>
                  <span> <?php the_field("adresse"); ?></span>
                </div>
                <div class="col-sm-6">
                  <a href="mailto:office@companyname.com">
                    <?php the_field("adresse_mail"); ?>
                  </a>
                  <br />
                  <a href="tel:532930098891"> <?php the_field("telephone"); ?></a>
                </div>
              </div>
            </address>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- .testimonial-section -->
</main>
<!-- .main-content -->
<?php endwhile; ?>
<?php get_footer() ?>