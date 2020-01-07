<?php if( have_rows('intro_blocks') ): ?>

<section class="intro">

  <div class="wrap-large pods-wrapper">
    <?php while( have_rows('intro_blocks') ): the_row(); ?>
      <?php
      $title = get_sub_field('title');
      $content = get_sub_field('content');
      $image = get_sub_field('image');
      $link = get_sub_field('link');
      
      ?>
      <div class="intro-item col">
        <div class="intro-item-inner">
          <?php
          if( !empty( $link ) && isset( $link['url'] ) ) {
            echo '<a href="' .esc_url( $link['url'] ). '" class="intro-item-link">';
          }

          if( !empty( $image ) && isset( $image['sizes']['large'] ) ) {
            echo '<div class="image" style="background-image: url(' .esc_url( $image['sizes']['large'] ). ');"></div>';
          }

          if( !empty( $title ) ) {
            echo '<div class="over">';
            echo '<div class="inner">';
            echo '<h2>' .$title. '</h2>';
            if( !empty( $content ) ) {
              echo wpautop( $content );
            }
            echo '</div>';
            echo '</div><!-- .over --></a>';
          }
          ?>
        </div>
        <!-- .intro-item-inner -->
      </div>
      <!-- .intro-item -->
    <?php endwhile; ?>
  </div>

</section>

<?php endif; ?>
