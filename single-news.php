<?php get_header(); ?>

<?php
$category_id = 5;
$post_type = 'post';
$post_categories = wp_get_post_categories($post->ID);
$options = get_option('du_ccgs');
$week_number = strtolower($options['week_tag']);
?>

<section class="paddit sectionit">
  <div class="wrap-large">

		<div class="twocolumns has_third_column">

		  <div class="ccgs_world_wrap">

				<article class="post">
					<header>
						<time><?php echo the_subtitle(); ?></time>
						<h2>CCGS World Edition</h2>
					</header>
		      <div class="next-edition">Next Edition: <?php echo $options['next_date']; ?></div>
					<?php if( have_posts() ) while( have_posts() ): the_post(); ?>
					<h3><?php the_title(); ?></h3>
					<div class="post-content">
						<p>Published on: <?php echo the_date('j F Y'); ?></p>
						<?php the_content(); ?>
					</div>
					<?php endwhile;?>
				</article>

		  </div>

			<?php include(locate_template('templates/ccgs-world-quick-links.php')); ?>

		</div>

		<?php get_sidebar('ccgs'); ?>

	</div>
</section>
<?php get_footer(); ?>
