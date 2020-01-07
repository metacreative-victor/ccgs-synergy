<div class="online_payment_list">

  <?php if (!have_posts()) : ?>

    <p>No <?php echo get_queried_object()->name != '' ? str_replace('_',' ',strtolower( get_queried_object()->name )) : 'payments';?> yet.</p>

  <?php endif; ?>

  <?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <!--<?php echo the_post_thumbnail('thumbnail');?>-->

      <div class="read_more">
        <a href="<?php the_permalink(); ?>" class='np_more'><b>read more</b></a>
      </div>

      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

      <div class="meta">
          <?php $years = wp_get_post_terms($post->ID,'payment_year');
          foreach ($years as $year) {
            echo '<span>' . $year->name . '</span>';
          }
          ?>
      </div>

      <!--<div class="excert">
        <?php echo get_the_excerpt();?>
      </div>-->



    </article>
  <?php endwhile; ?>

</div>
