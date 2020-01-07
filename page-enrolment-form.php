<?php
 get_header(); the_post();
?>
<section class="paddit sectionit">
  <div class="wrap-large">
    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>
  </div>
</section>

<?php get_footer(); ?>
