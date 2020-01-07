<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage DigitalUnionInstallBase
 * @since 2011
 */

$post_type = 'post';

get_header(); ?>

<section class="paddit">
  <div class="wrap-large">

	<?php get_sidebar('news'); ?>

	<div class="onecolumn">
		<div id="content">
			<article class="post" id="news_content">
				<?php if( have_posts() ) while( have_posts() ): the_post(); ?>
				<header>
					<h1><?php the_title(); ?></h1>
				</header>
				<div class="post-content">
					<p class="publish_date">Published on: <?php echo the_date('j F Y '); ?></p>
					<?php the_content(); ?>
				</div>
	            <?php
	            $categories = get_the_category();
	            $post_id = get_the_ID();
	            ?>
				<?php endwhile; ?>
			</article>
	      <p class="view_all_news"><a href="<?php echo get_category_link(5); ?>">View all news</a></p>

		</div>
	</div>
	</div>
</section>

<section class="news_articles">

	<section class="paddit">
	  <div class="wrap-large">
  <h3 class="related">Related</h3>
        <?php
        if (!empty($categories)){
          $category_id = $categories[0]->term_id;
        }
        else {
          $category_id = 5;
        }
        $post_type = 'post';
        $args = array(
          'post__not_in' => array($post_id),
          'posts_per_page' => '4',
          'cat' => $category_id,
          'post_type' => $post_type,
          'exclude' => '240'
        );
        $counter = 1;
        $my_query = new WP_Query($args);
        while ($my_query->have_posts()) : $my_query->the_post();
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
        endwhile;
        wp_reset_query();
        ?>
			</div>
	</section>
</section>

<?php get_footer(); ?>
