<?php get_header(); ?>
<main class="main-content">
  <div class="fullwidth-block gallery">
    <div class="container">
      <div class="content fullwidth">
        <h2 class="entry-title">Gallery</h2>
        <div class="filter-links filterable-nav">
          <select class="mobile-filter">
            <option value="*">Tous</option>
            <?php
            //On va chercher et on récupère les catégories
            $media_categories = get_terms(array(
              'taxonomy' => 'media_category',
              'orderby' => 'slug',
              'hide_empty' => false,
            )); ?>
            <!--On construit la requête pour chaque catégorie-->
            <?php foreach ($media_categories as $media_category) :
              $category_slug = $media_category->slug;
            ?>
            <!-- for each pour l'affichage des catégories -->
            <option value=".<?php echo $category_slug; ?>"><?php echo $category_slug; ?></option>
            <?php endforeach ?>
          </select>
          <a href="#" class="current" data-filter="*">Tous</a>
          <?php foreach ($media_categories as $media_category) : ?>
          <?php $category_slug = $media_category->slug; ?>
          <a href=" #" class=" current" data-filter=".<?php echo $category_slug; ?>"><?php echo $category_slug; ?>
          </a>
          <?php endforeach; ?>
          <div class=" filterable-items">
            <?php
            $images = get_field('gallery');
            if ($images) : ?>
            <!-- for each qui va rechercher les images-->
            <?php foreach ($images as $image) :
                $terms = wp_get_post_terms($image["id"], "media_category");
                $termsId = "";
                // for each qui va rechercher les catégories associée à chaque image dans l'admin de WP
                foreach ($terms as $term) {
                  $termsId .= $term->slug . ""; ?>
            <div class="filterable-item <?php echo $termsId; ?>">
              <?php } ?>
              <a href="<?php echo $images['url']; ?>">
                <figure>
                  <img src=" <?php echo esc_url($image['url']); ?>" alt="" />
                </figure>
              </a>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
</main>
<!-- .main-content -->
<?php get_footer(); ?>