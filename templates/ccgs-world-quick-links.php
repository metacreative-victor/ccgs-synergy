<aside class="aside">

  <?php get_template_part( 'calendar-events-today-ccgs' ); ?>

  <?php
  // get the postcards

  $post_args = array(
    'posts_per_page'	=> -1,
    'category'			=> 80,
    'post_type'			=> 'notice',
    'suppress_filters' => false,
    'tax_query' => array(
      array(
        'taxonomy' => 'post_tag',
        'field' => 'slug',
        'terms' => $week_number
      )
    )
  );
  $posts_array = get_posts( $post_args );

  if(count($posts_array) > 0):
    foreach($posts_array as $post):
      setup_postdata($post);
      echo the_content();
    endforeach;
    wp_reset_postdata();
  endif;
  ?>

  <nav class="quick-links">
    <h2>Quick Links</h2>
    <?php

    wp_nav_menu( array(

      'menu_class' => 'quick_links',
      'container' => '',
      'menu' => 'Quick Links',
      'depth' => 1

    ) );

    ?>
  </nav>
</aside>
