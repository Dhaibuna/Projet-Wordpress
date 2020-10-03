<li>
  <figure class="cover">
    <?php the_post_thumbnail('medium'); ?>
  </figure>
  <div class="detail">
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <span class="year"><?php the_field("discography_year"); ?></span>
    <span class="track">17 tracks</span>
  </div>
</li>