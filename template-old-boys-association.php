<?php
/**
 * @package WordPress
 * @subpackage DigitalUnionInstallBase
 * @since 2011
 * Template Name: OB Newsletter Archives
 */
 get_header(); the_post();
?>

<div id="inner_banner">
	<?php
	if (!is_page_template('template-ob-association.php')) :

        $thumb_image_id = get_field('page_featuredimage1_thumbnail_id');
        if( $thumb_image_id > 0 ) :
            $url = wp_get_attachment_image_src( $thumb_image_id, 'large' );
            echo '<div class="ib_left"><img src="' . $url[0] . '" alt="Featured image" /></div>';
        else:
            ?>
            <div class="ib_left"><img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/img-1.jpg" alt="Image Description"></div>
            <?php

        endif;
        $thumb_image_id = get_field('page_featuredimage2_thumbnail_id');
        if( $thumb_image_id > 0 ) :
            $url = wp_get_attachment_image_src( $thumb_image_id, 'large' );
            echo '<div class="ib_right"><img src="' . $url[0] . '" /></div>';
        else:
            ?>
            <div class="ib_right"><img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/img-visual2.jpg" alt=""></div>
            <?php
        endif;

	endif;
	?>
</div>

<section class="paddit sectionit">
  <div class="wrap-large">

    <div class="twocolumns">
    	<article class="intro-box">
    		<div class="textbox">
    			<h1><?php the_title(); ?></h1>
    			<?php the_content(); ?>
    			<?php
    			$args = array(
    				'sort_order' => 'DESC',
    				'sort_column' => 'post_date',
    				'hierarchical' => 0,
    				//'child_of' => $post->ID,
    				'parent' => $post->ID
    			);
    			$pages = get_pages($args);
    			$counter = 0;

    			if(count($pages) > 0):
    				foreach($pages as $page):
    			?>
    				<p><a href="<?php echo get_page_link( $page->ID ); ?>"><?php echo $page->post_title; ?></a><br />
    				<?php echo the_subtitle($page->ID); ?></p>
    			<?php
    				endforeach;
    			endif;
    			?>
    		</div>
    		<div class="images-col">
    			<?php the_block( 'Right Column' ); ?>
    		</div>
    	</article>
    </div>
    <aside id="sidebar">
    	<nav class="sidenav">
    		<?php
    		if ($post->post_parent) {
    			// get depth of current page
    			$children = array();

    			if(empty($children)) $children = wp_list_pages("title_li=&child_of=" . $post->post_parent . "&echo=0&depth=1");
    		} else {
    			$children = wp_list_pages("title_li=&child_of=" . $post->ID . "&echo=0&depth=1");
    		}
    		if ($children) {
    		?>
    		<ul>
    			<?php echo $children; ?>
    		</ul>
    		<?php } ?>
    	</nav>
    </aside>
  </div>
</section>
<?php get_footer(); ?>
