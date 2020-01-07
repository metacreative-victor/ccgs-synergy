<?php get_header(); ?>
<section class="paddit sectionit">
  <div class="wrap-large">
    <div class="twocolumns">

      <?php get_template_part('templates/part','online_payment_loop'); ?>

      <?php get_template_part('templates/part','pagination'); ?>

    </div>

    <?php get_template_part('templates/part','online_payment_navigation'); ?>
  </div>
</section>

<?php get_footer(); ?>
