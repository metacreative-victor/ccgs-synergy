<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage DigitalUnionInstallBase
 * @since 2011
 */
 get_header(); the_post();
?>

<section class="paddit sectionit">
  <div class="wrap-large">
		<article class="post add">
			<header>
				<h2><?php the_title(); ?></h2>
			</header>
			<div class="post-content">
				<?php the_content(); ?>
			</div>
		</article>
  </div>
</section>

<?php get_footer(); ?>
