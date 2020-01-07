<?php get_header(); ?>

<?php get_sidebar('news'); ?>


<div class="full_width">
      <section class="news_articles">
        <?php while ( have_posts() ) : the_post();?>
        <?php //while ($my_query->have_posts()) : $my_query->the_post();
          if (in_category('241')){ $class = "yellow"; } else { $class = ""; }
          $imageHTML = "";
          if ( has_post_thumbnail() ) {
            $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
            $imageHTML = '<span class="np_image full_size"><img src="' . $url[0] . '" /></span>';
          }
          else {
              $thumb_image_id = get_field('post_newsimage1_thumbnail_id');
              if ( $thumb_image_id > 0 ) :
                $url = wp_get_attachment_image_src( $thumb_image_id, 'medium' );
                $imageHTML = '<span class="np_image"><img src="' . $url[0] . '" /></span>';
              else :
                $thumb_image_id = get_field('post_newsimage2_thumbnail_id');
                if ( $thumb_image_id > 0 ) :
                  $url = wp_get_attachment_image_src( $thumb_image_id, 'medium' );
                  $imageHTML = '<span class="np_image"><img src="' . $url[0] . '" /></span>';
                endif;
              endif;
          }
          ?>
          <a class="news_panel <?php echo $class; ?>" href="<?php the_permalink(); ?>">
            <?php echo $imageHTML; ?>
            <span class="np_title"><?php the_title(); ?></span>
            <?php
            if (strlen(get_the_subtitle()) > 0) {
              echo "<span class='np_intro'>";
              the_subtitle();
              echo "</span>";
            }
            ?>
            <?php echo "<span class='np_more'><b>read more</b></span>"; ?>
          </a>

          <?php endwhile; ?>

      </section>
      <?php the_posts_pagination(); ?>
</div>

<?php get_footer(); ?>
