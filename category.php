<?php
/**
 * @package DU
 * @subpackage Digital Union
 * @since 2012
 */

$categories = get_the_category();
if (!empty($categories)){
  $category_id = get_query_var('cat');
}
else {
  $category_id = 5;
}
$post_type = 'post';

get_header(); ?>


<section class="paddit sectionit">
  <div class="wrap-large">

    <?php get_sidebar('news'); ?>

    <div id="content" class="full_width">
          <section class="news_articles">

            <?php $counter = 0; while ( have_posts() ) : the_post();?>
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
              <?php
            $counter++;
          endwhile;?>
          </section>
          <?php the_posts_pagination(); ?>
          <?php
            wp_reset_query();
            ?>



    </div>
  </div>
</section>
<?php get_footer(); ?>
