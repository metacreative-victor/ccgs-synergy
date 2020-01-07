<?php
$category_id = 8;
?>
<aside id="sidebar">
	<div class="notices">
		<h2>Notices</h2>
		<ul>
		<?php
		/*
		 * Get list of categories
		 * Loop through categories and get posts
		 */
		$args = array(
			'type'			=> 'post',
			'child_of'		=> $category_id,
			'parent'		=> '',
			'orderby'		=> 'term_order',
			'order'			=> 'ASC',
			'hide_empty'	=> 0
		);
		$categories = get_categories($args);
		?>

		<?php

		$cat_counter = 0;
		$in_sub = false;

		// get the week number for this week
		$options = get_option('du_ccgs');
		$week_number = strtolower($options['week_tag']);

		foreach($categories as $category):
			$cats_str = get_category_parents($category, false, '%#%');
			$cats_array = explode('%#%', $cats_str);
			$cat_depth = sizeof($cats_array)-2;

			$posts_array = array();
			$category_images_array = array();
			// Get the posts for the sub category

			if($cat_depth == 2) {

				$cat_post_args = array(
					'posts_per_page'	=> -1,
					'category'			=> $category->cat_ID,
					'post_type'			=> 'notice',
					'suppress_filters' => false,
					'tax_query' => array(
						array(
							'taxonomy' => 'post_tag',
							'field' => 'slug',
							'terms' => $week_number
						),
						array(
							'taxonomy' => 'post_tag',
							'field' => 'slug',
							'terms' => date("Y")
						)
					),
					'meta_query' => array(
						array(
							'key' => 'du_notice_category_image',
							'value' => 'on'
						)
					)
				);
				$category_images_array = get_posts( $cat_post_args );
				$exclude_catIDs = array();

				if(count($category_images_array) > 0) {
					foreach($category_images_array as $post) {
						$exclude_catIDs[] = $post->ID;
					}
				}

				$post_args = array(
					'posts_per_page'	=> -1,
					'category'			=> $category->cat_ID,
					'post_type'			=> 'notice',
					'suppress_filters' => false,
					'exclude' => $exclude_catIDs,
					'tax_query' => array(
						array(
							'taxonomy' => 'post_tag',
							'field' => 'slug',
							'terms' => $week_number
						),
						array(
							'taxonomy' => 'post_tag',
							'field' => 'slug',
							'terms' => date("Y")
						)
					)
				);
				$posts_array = get_posts( $post_args );

			}

			if($cat_depth == 1) {
				$args = array(
					'post_type' => 'notice',
					'category__in' => array($category->cat_ID),
					'tag'=>$week_number
				);
				$posts_array = query_posts($args);
			}

		?>
			<?php
			if($cat_depth == 2 && !$in_sub) {
				$in_sub = true;
			?>
			<ul class="children children-of-<?php print $category->parent; ?>">
			<?php } ?>
			<?php
			if($cat_depth == 1 && $in_sub){
				$in_sub = false;
			?>
			</ul>
			<?php } ?>

			<?php if($cat_depth == 1){ ?>
			<li>
				<a class="opener" href="#"><?php echo $category->name; ?></a>
					<?php
					if(count($posts_array) > 0) {
						foreach($posts_array as $post){
							setup_postdata($post);
					?>
							<div class="category-image"><?php the_content(); ?>
								<?php echo get_the_permalink();?>
							</div>
					<?php
						}
						wp_reset_postdata();
					?>
					<?php } ?>
			</li>
			<?php } ?>

			<?php if($cat_depth == 2 && count($posts_array) > 0): ?>
			<li>
				<a class="opener" href="#" data-fancybox="" data-options='{"src": "#<?php echo $category->slug; ?>", "touch": false, "smallBtn" : false}'><?php echo $category->name ?></a>
				<?php
				if(count($category_images_array) > 0) {
					foreach($category_images_array as $post){
						setup_postdata($post);
				?>
						<div class="category-image"><?php the_content(); ?></div>
				<?php
					}
					wp_reset_postdata();
				?>
				<?php } ?>
				<div class="slide fancybox-inline" id="<?php echo $category->slug; ?>">
					<div class="header">
						<img src="<?php echo THEME_URL ?>/assets/img/ccgs-logo.svg" alt="Christ Church Grammar School Perth, Western Australia"/>
					</div>
					<a title="Print View" class="print" data-print="<?php echo $category->slug; ?>">Print</a>
					<?php
					if(count($posts_array) > 0):
						foreach($posts_array as $post):
							setup_postdata($post);
							?>
							<p class="notice-title"><strong><?php the_title(); ?></strong></p>
							<?php the_content(); ?>
					<?php
						endforeach;
						wp_reset_postdata();
					else:
					?>
						<span>There are no posts at this time.</span>
					<?php endif; ?>
				</div>
			</li>
			<?php endif; ?>

		<?php
			$cat_counter++;
			wp_reset_query();
		endforeach;
		?>
		</ul>
	</div>

</aside>
