<aside id="sidebar">
  <nav class="sidenav">
    <ul>
      <!--<li><a href="<?php echo home_url(); ?>/online-payments/" <?php echo is_page('online-payments') ? 'class="active"' : '' ;?>>All</a></li>-->
    <?php
    $args = array(
      'taxonomy' => 'payment_type',
      'hide_empty' => false,
      'title_li' => false,
      //'parent' => 0,
    );

    wp_list_categories($args)

    //pre ($terms);
    /*
    foreach ( get_terms( $args ) as $term ) {
      $term_link = get_term_link( $term );
      $active = is_tax( 'payment_type', $term->slug ) ? ' class="active"' : '';
      echo '<li><a href="'. esc_url( $term_link ) .'"'.$active.'>' . $term->name . '</a></li>';
      $args = array(
        'taxonomy' => 'payment_type',
        'hide_empty' => false,
        'parent' => $term->term_id,
      );
      foreach ( get_terms( $args ) as $term_child ) {
        $term_link = get_term_link( $term_child );
        $active = is_tax( 'payment_type', $term_link->slug ) ? ' class="active"' : '';
        echo '<li><a href="'. esc_url( $term_link ) .'"'.$active.'>' . $term_child->name . '</a></li>';
      }

    }*/
    ?>

    </ul>
  </nav>
</aside>
