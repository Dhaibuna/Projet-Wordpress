<footer class="site-footer">
  <div class="container">
    <img src="<?php echo get_template_directory_uri(); ?>/images/logo-wimfi.png" alt="wi m'fi records" />

    <address>
      <p>
        <?php the_field("adresse", "option"); ?>
        <br />
        <a href="tel:354543543"><?php the_field("telephone", "option"); ?></a>
        <br />
        <a href="mailto:info@bandname.com"><?php the_field("email", "option"); ?></a>
      </p>
    </address>

    <form action="#" class="newsletter-form">
      <input type="email" placeholder="Enter your email to join newsletter..." />
      <input type="submit" class="button cut-corner" value="Subscribe" />
    </form>
    <!-- .newsletter-form -->

    <div class="social-links">
      <a href="<?php the_field("rs_fb", "option"); ?>"><i class="fa fa-facebook-square"></i></a>
      <a href="<?php the_field("rs_twitter", "option"); ?>"><i class="fa fa-twitter"></i></a>
      <a href="<?php the_field("rs_gg", "option"); ?>"><i class="fa fa-google-plus"></i></a>
      <a href="<?php the_field("rs_pint", "option"); ?>"><i class="fa fa-pinterest"></i></a>
    </div>
    <!-- .social-links -->

    <p class="copy">
      <?php the_field("copyright", "option"); ?>
    </p>
  </div>
</footer>
<!-- .site-footer -->
</div>
<!-- #site-content -->

<?php wp_footer(); ?>
</body>

</html>