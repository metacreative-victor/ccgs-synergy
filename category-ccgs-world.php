<?php get_header(); ?>

<?php
$category_id = 8;

// get the week number for this week
$options = get_option('du_ccgs');
$week_number = strtolower($options['week_tag']);
?>

<section class="paddit sectionit">
  <div class="wrap-large">

		<div class="twocolumns has_third_column">

      <div class="ccgs_world_wrap">

			<?php
				/*
				 * Get featured news posts
				 */
    $thisYear = date('Y');

    if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false){
		  //$thisYear = 2018; //Set to last data import year
		}
				$post_args = array(
					'posts_per_page'	=> 10,
					//'category'			=> $category_id,
					'post_type'			=> 'news',
					'orderby'			=> 'menu_order',
					'order'				=> 'ASC',
					'meta_query' => array(
						array(
							'key' => '_is_featured',
              'compare' => '=',
							'value' => '1',
						)
					),
					'tax_query' => array(
						/*array(
							'taxonomy' => 'post_tag',
							'field' => 'slug',
							'terms' => $week_number
						),
						array(
							'taxonomy' => 'post_tag',
							'field' => 'slug',
							'terms' => $thisYear
						)*/
					)
				);

				$posts_array = get_posts($post_args);
				$counter = 0;

				if(count($posts_array) > 0):

					foreach($posts_array as $post):
						$counter++;
						setup_postdata($post);
						$layout = get_post_meta($post->ID, 'du_post_layout', true);
				?>
						<article class="post<?php echo ' ' . $layout . ' post-'.$counter; ?>">
							<?php
							if($counter == 1):
							?>
							<header>
								<time><?php echo get_field('post_subtitle') ? get_field('post_subtitle'): '' ; ?></time>
								<h2>CCGS World Edition</h2>
							</header>
							<?php if (!empty($options['next_date'])): ?>
							  <div class="next-edition">Next Edition: <?php echo $options['next_date']; ?></div>
		          <?php endif; ?>
							<?php
							endif;
							?>
							<?php if($layout == 'image'): ?>
								<?php the_content('Read more'); ?>
							<?php else: ?>
                <a class="opener" href="#" data-fancybox="" data-options='{"src": "#bb-<?php echo $post->ID; ?>", "touch": false, "smallBtn" : false}'>
								<h3><?php echo $post->post_title; ?></h3>
								<span class="post-content">
									<?php
										$thumb_image_id = get_post_thumbnail_id($post->ID);
										if( $thumb_image_id > 0 ) :
											echo '<span class="img-frame">' . wp_get_attachment_image( $thumb_image_id, 'medium' ) . '</span>';
										endif;
									?>
									<?php
                  $content = get_the_content('');
                  echo strip_tags($content,'<ul><li><p><br>');
                  echo '<p><strong>Read More</strong></p>';
                  ?>
								</span>
                </a>
                <div class="slide fancybox-inline" id="bb-<?php echo $post->ID; ?>">
        					<div class="header">
        						<img src="<?php echo THEME_URL ?>/assets/img/ccgs-logo.svg" alt="Christ Church Grammar School Perth, Western Australia"/>
        					</div>
        					<a title="Print View" class="print" data-print="bb-<?php echo $post->ID;?>">Print</a>
        					<?php echo apply_filters('the_content', $post->post_content); ?>
        				</div>
							<?php endif; ?>
						</article>
					<?php
						endforeach;
						wp_reset_postdata();
					endif;
					?>
		  </div>

      <?php include(locate_template('templates/ccgs-world-quick-links.php')); ?>

		</div>

		<?php get_sidebar('ccgs'); ?>

	</div>
</section>

<?php get_footer(); ?>
