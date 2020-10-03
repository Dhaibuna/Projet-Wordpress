<?php get_header(); ?>

<div class="hero">
  <div class="slider">
    <?php if (have_rows('main_slides')) : ?>
    <ul class="slides">
      <?php while (have_rows('main_slides')) : the_row();
          $slide_image = get_sub_field('slide_image'); ?>
      ?>
      <!--Voilà la boucle: Dans le if, on va chercher chaque slides et dans le while on va faire une boucle dans chaque
      slide.-->
      <!--Là on va assigner les variables-->

      <li class="lazy-bg" data-background="<?php echo $slide_image['url']; ?>">
        <?php // var_dump($slide_image);
            ?>
        <div class=" container">
          <h2 class="slide-title"><?php the_sub_field('slide_title'); ?></h2>
          <h3 class=" slide-subtitle"><?php the_sub_field('slide_subtitle'); ?></h3>
          <p class="slide-desc"><?php the_sub_field('slide_description'); ?></p>
          <a href="<?php the_sub_field('slide_link'); ?>" class="button cut-corner">Read More</a>
        </div>

      </li>
      <?php endwhile; ?>
    </ul>
    <?php endif; ?>
  </div>
</div>


<!-- Fin des slides -->


<!-- .testimonial-section -->

<main class="main-content">
  <div class="fullwidth-block testimonial-section">
    <div class="container">
      <?php if (have_rows('citation_slides')) : ?>
      <div class="quote-slider">
        <ul class="slides">
          <?php while (have_rows('citation_slides')) : the_row(); ?>
          <li>
            <blockquote>
              <p>
                <?php the_sub_field('slide_citation'); ?>
              </p>
              <cite><?php the_sub_field('slide_author'); ?></cite>
              <span><?php the_sub_field('slide_function'); ?></span>
            </blockquote>
          </li>
          <?php endwhile; ?>
        </ul>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Fin de testimonial-section -->


  <!-- Upcoming event section -->

  <div class="fullwidth-block upcoming-event-section" data-bg-color="#191919">
    <div class="container">
      <header class="section-header">
        <h2 class="section-title">Evènements à venir </h2>

        <!-- J'utilise la fonction WP_Query pour aller rechercher mes posts -->

        <?php $args = array('post_type' => 'event');
        $events = new WP_Query($args);
        ?>


        <div class="event-nav">
          <a class="prev" id="event-prev" href="#">
            <i class="fa fa-caret-left"></i>
          </a>
          <a class="next" id="event-next" href="#">
            <i class="fa fa-caret-right"></i>
          </a>
        </div>
        <!-- .event-nav -->
      </header>

      <!-- .event -->

      <div class="event-carousel">
        <?php if ($events->have_posts()) : ?>
        <?php while ($events->have_posts()) : $events->the_post(); ?>

        <div class="event">

          <div class="entry-date">
            <?php
                $date_string = get_field('event_date');
                $date_day = substr($date_string, 0, 2);
                $date_month = substr($date_string, 2, 4);

                //echo $date;
                ?>
            <div class="date"><?php echo $date_day = substr($date_string, 0, 2); ?></div>
            <span class="month"> <?php echo $date_month = substr($date_string, 2, 4); ?></span>
          </div>
          <h2 class="entry-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>
          <p>
            <?php the_excerpt(); ?>
          </p>

        </div>
        <!-- .event -->
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
        <?php endif; ?>


      </div>
      <!-- .event-carousel -->

    </div>

    <!-- .container -->
  </div>
  <!-- .upcoming-event-section -->

  <div class="fullwidth-block why-chooseus-section">
    <div class="container">

      <h2 class="section-title"> Envie d'une petite collaboration ? </h2>


      <div class="row">
        <?php if (have_rows('collaboration_field')) :
          while (have_rows('collaboration_field')) : the_row();
        ?>
        <div class="col-md-4">
          <div class="feature">
            <figure class="cut-corner">
              <img src="<?php echo get_sub_field("image_collaboration")["url"]; ?>" alt="" />
            </figure>
            <h3 class=" feature-title">
              <?php
                  the_sub_field('title_collaboration');


                  ?>
            </h3>
            <p>
              <?php the_sub_field('text_collaboration'); ?>
            </p>
          </div>
          <!-- .feature -->
        </div>
        <?php endwhile;
          ?>
        <?php endif;
        ?>
        <!-- .feature -->
      </div>
    </div>
  </div>
  <!-- .container -->
  <!-- .why-chooseus-section -->
</main>
<!-- .main-content -->
<?php get_footer() ?>