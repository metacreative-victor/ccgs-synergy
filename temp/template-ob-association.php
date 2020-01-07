<?php
/**
 * @package WordPress
 * @subpackage DigitalUnionInstallBase
 * @since 2011
 * Template Name: OB Association
 */
 get_header(); the_post();
?>

<div class="twocolumns">
	<div id="content">
		<article class="post add">
			<header>
				<h2><?php the_title(); ?></h2>
			</header>
			<h3>Headline</h3>
			<div class="post-content">
				<?php the_content(); ?>
			</div>
		</article>
	</div>
	<aside class="aside">
		<nav class="quick-links">
			<h2>Quick Links</h2>
			<div class="oba-image"><a href="#"><img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/img-oba.jpg" alt=""></a></div>
			<?php
			wp_nav_menu( array(
				'menu_class' => 'quick_links',
				'container' => '',
				'menu' => 'Quick Links',
				'depth' => 1
			) );
			?>
		</nav>
	</aside>
</div>
<?php get_sidebar(); ?>

<?php get_footer(); ?>