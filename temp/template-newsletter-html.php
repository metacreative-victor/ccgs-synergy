<?php
/**
 * @package WordPress
 * @subpackage DigitalUnionInstallBase
 * @since 2011
 * Template Name: Newsletter HTML
 */
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title( '|', true, 'right' ); ?> Christ Church Grammar School</title>
<?php if(is_front_page()): ?>
	<link media="all" href="<?php bloginfo( 'template_directory' ); ?>/assets/css/home.css" rel="stylesheet">
<?php else: ?>
	<link media="all" href="<?php bloginfo( 'template_directory' ); ?>/assets/css/all.css" rel="stylesheet">
<?php endif; ?>
	<link media="all" href="<?php bloginfo( 'template_directory' ); ?>/assets/css/smoothDivScroll.css" rel="stylesheet">
	<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/assets/js/jquery-1.8.3.min.js"></script>
	<!--[if IE]><script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/assets/js/ie.js"></script><![endif]-->
	<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo( 'template_directory' ); ?>/assets/img/favicon.ico">
	<?php wp_head(); ?>
	<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/assets/js/jquery.main.js"></script>
	<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/assets/js/yrcalc.js"></script>

	<!-- non-retina iPhone pre iOS 7 -->
	<link rel="apple-touch-icon" href="<?php bloginfo( 'template_directory' ); ?>/assets/img/apple-touch-icon-57×57-precomposed.png" sizes="57x57">
	<!-- non-retina iPad pre iOS 7 -->
	<link rel="apple-touch-icon" href="<?php bloginfo( 'template_directory' ); ?>/assets/img/apple-touch-icon-72×72-precomposed.png" sizes="72x72">
	<!-- retina iPhone pre iOS 7 -->
	<link rel="apple-touch-icon" href="<?php bloginfo( 'template_directory' ); ?>/assets/img/apple-touch-icon-114×114-precomposed.png" sizes="114x114">
</head>
<body <?php body_class($class); ?>>

<div id="wrapper">

<div class="twocolumns">
	<div id="content">

		<?php
		/*
		 * Get featured news posts
		 */

$category_id = 8;
$options = get_option('du_ccgs');

// get the week number for this week
$week_number = 'week-' . ltrim(week_number(), '0');
$week_number = 'week-6';
		$post_args = array(
			'posts_per_page'	=> 10,
			'category'			=> $category_id,
			'post_type'			=> 'news',
			'meta_key'			=> 'featured',
			'meta_value'		=> 'yes',
			'orderby'			=> 'menu_order',
			'order'				=> 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'post_tag',
					'field' => 'slug',
					'terms' => $week_number
				)
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
						<time><?php echo the_subtitle(); ?></time>
						<h2>CCGS World Edition</h2>
					</header>
					<div class="next-edition">Next Edition: <?php echo $options['next_date']; ?></div>
					<?php
					endif;
					?>
					<?php if($layout == 'image'): ?>
						<?php the_content('Read more >>'); ?>
					<?php else: ?>
						<h3><?php echo $post->post_title; ?></h3>
						<div class="post-content">
							<?php
								$thumb_image_id = get_field('post_newsimage1_thumbnail_id');
								if( $thumb_image_id > 0 ) :
									echo '<div class="img-frame"><a href="';
									the_permalink();
									echo '">' . wp_get_attachment_image( $thumb_image_id, 'medium' ) . '</a></div>';
								endif;
							?>
							<?php the_content('Read more >>'); ?>
						</div>
					<?php endif; ?>
				</article>
			<?php
				endforeach;
				wp_reset_postdata();
			endif;
			?>
	</div>
	<aside class="aside">
		<div class="latest-news">
			<h2>News Headlines</h2>
			<ul>
			<?php
			/*
			 * Get list of news posts
			 */
			$post_args = array(
				'posts_per_page'	=> 3,
				'category'			=> 5,
				'post_type'			=> 'post'
			);
			$posts_array = get_posts($post_args);
			$counter = 0;

			if(count($posts_array) > 0):
				foreach($posts_array as $post):
					setup_postdata($post);
					$counter=1;
				?>
				<li<?php if($counter == 1) echo ' class="featured-news"';?>>
					<?php
						$thumb_image_id = get_field('post_newsimage1_thumbnail_id');
						if( $thumb_image_id > 0 ) :
							echo '<div class="img-frame"><a href="';
							the_permalink();
							if($counter == 1) echo '">' . wp_get_attachment_image( $thumb_image_id, 'medium' ) . '</a></div>';
							if($counter > 1) echo '">' . wp_get_attachment_image( $thumb_image_id, 'medium' ) . '</a></div>';
						endif;
					?>
					<div class="holder">
						<strong class="title"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></strong>
					</div>
				</li>
				<?php
				endforeach;
				wp_reset_postdata();
			endif;
			?>
			</ul>
		</div>
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
			?>
				<?php echo the_content(); ?>
			<?php
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

		<?php get_template_part( 'calendar-events-today' ); ?>
	</aside>
</div>

<?php get_sidebar('ccgs'); ?>

</div>

<?php wp_footer(); ?>

</body>
</html>
