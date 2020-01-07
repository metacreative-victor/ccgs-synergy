<section id="home-slider">
  <div class="home-slider-inner">
    <?php
    if( have_rows('video_slider') ) :
      while ( have_rows('video_slider') ) : the_row();

        $video_url = get_sub_field('video_url');
        $width = get_sub_field('video_width');
        $height = get_sub_field('video_height');
        if( !empty( $video_url ) ) {
          echo '<div class="slick-slide">';
          echo '<div class="slide-video" data-width="' .trim( $width ). '" data-height="' .trim( $height ). '">';
          echo '<video loop muted playsinline preload="metadata"><source src="' .esc_url( $video_url ). '" type="video/mp4"></video>';
          echo '</div><!-- .slide-video -->';
          echo '</div>';
        }

      endwhile;
    endif;
    ?>
  </div>
  <button type="button" class="audio-controls"><i class="fa fa-volume-off" aria-hidden="true"></i></button>
</section>