<?php get_header(); ?>

<section class="sectionit paddit">
  <div class="wrap-large">

    <div class="twocolumns">

      <h1><?php echo get_queried_object()->name;?></h1>

      <?php get_template_part('templates/part','online_payment_loop'); ?>

      <?php get_template_part('templates/part','pagination'); ?>

    </div>

    <?php get_template_part('templates/part','online_payment_navigation'); ?>

  </div>
</section>
<?php get_footer(); ?>
