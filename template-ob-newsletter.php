<?php
/**
 * @package WordPress
 * @subpackage DigitalUnionInstallBase
 * @since 2011
 * Template Name: OB Newsletter
 */
 get_header(); the_post();

$tag = get_post_meta(get_the_ID(), 'du_archive_tags', true);
?>

<section class="paddit sectionit">
  <div class="wrap-large">

    <div class="twocolumns has_third_column">
    	<div id="content">
    		<article class="post add">
    			<header>
    				<h2 class="left">Old Boys' Newsletter</h2>
    				<h2 class="right"><?php the_title(); ?></h2>
    			</header>
    			<div class="post-content ob-newsletter">
    			<?php
    			/*
    			 * Get OB Newsletter
    			 */
    			$post_args = array(
    				'posts_per_page'	=> -1,
    				'category'			=> 97,
    				'post_type'			=> 'ob-newsletter',
    				'orderby'			=> 'menu_order',
    				'order'				=> 'ASC',
    				'tax_query' => array(
    					array(
    						'taxonomy' => 'post_tag',
    						'field' => 'slug',
    						'terms' => $tag
    					)
    				)
    			);
    			$posts_array = get_posts($post_args);
    			$counter = 0;

    			if(count($posts_array) > 0):
    				foreach($posts_array as $post):
    					$counter++;
    					setup_postdata($post);
    					if($counter > 1) echo '<h3>' . the_title('', '', false) . '</h3>';
    						// Featured Image 1
                $thumb_image_id = get_field('post_newsimage1_thumbnail_id');
                if( $thumb_image_id > 0 ) :
                  echo '<div class="img-frame">';
                    //$url = wp_get_attachment_image_src( $thumb_image_id, 'sideimage1' );
                    //$sideimage1 = '<div class="visual"><img src="' . $url[0] . '" /></div>';
                    if($counter == 1) echo '' . wp_get_attachment_image( $thumb_image_id, 'medium' ) . '</div>';
      							if($counter > 1) echo '' . wp_get_attachment_image( $thumb_image_id, 'medium' ) . '</div>';
                endif;

                $thumb_image_id =  get_field('post_newsimage2_thumbnail_id');
                if( $thumb_image_id > 0 ) :
                    //$url = wp_get_attachment_image_src( $thumb_image_id, 'sideimage2' );
                    ///$sideimage2 = '<div class="visual"><img src="' . $url[0] . '" /></div>';
                    echo '<div class="img-frame">' . wp_get_attachment_image( $thumb_image_id, 'medium' ) . '</div>';
                endif;

    					the_content();
    					?>
    					<div class="clear"></div>
    					<div class="border-line"></div>
    					<?php
    				endforeach;
    				wp_reset_postdata();
    			endif;
    			?>
    			</div>
    		</article>
    	<aside class="aside updates">
    		<h2>Member updates</h2>
    		<?php
    		/*
    		 * Get OB Newsletter
    		 */
    		$post_args = array(
    			'posts_per_page'	=> -1,
    			'category'			=> 98,
    			'post_type'			=> 'ob-newsletter',
    			'orderby'			=> 'menu_order',
    			'order'				=> 'ASC',
    			'tax_query' => array(
    				array(
    					'taxonomy' => 'post_tag',
    					'field' => 'slug',
    					'terms' => $tag
    				)
    			)
    		);
    		$posts_array = get_posts($post_args);
    		$counter = 0;

    		if(count($posts_array) > 0):
    			foreach($posts_array as $post):
    				setup_postdata($post);
    					$counter++;
    					// Featured Image 1
    					$thumb_image_id = get_field('post_newsimage1_thumbnail_id');
    					if( $thumb_image_id > 0 ) :
    						echo '<div class="img-frame"';
    						if($counter == 2) {
    							echo ' style="float:right;"';
    							$counter = 0;
    						}
    						echo '>' .wp_get_attachment_image( $thumb_image_id, 'medium' ) . '</div>';
    					endif;
    				the_content();
    			endforeach;
    			wp_reset_postdata();
    		endif;
    		?>
    	</aside>
    	</div>
    </div>
    <aside id="sidebar" class="old_boys_newsletter_sidebar">
    	<nav class="quick-links">
    		<h2>Quick Links</h2>
    		<div class="social_icons">
    			<a href="https://www.facebook.com/groups/CCGSOBA/?fref=ts" target="_blank" class="facebook_sb">Join us on Facebook</a>
    			<a href="http://www.linkedin.com/groups?gid=3937491&mostPopular=&trk=tyah&trkInfo=tarId%3A1398655259742%2Ctas%3Achrist%20church%20old%20boys%2Cidx%3A1-1-1" target="_blank" class="linkedin_sb">Join us on Linkedin</a>
    			<a href="https://twitter.com/CCGS_OldBoys" target="_blank" class="twitter_sb">Follow us on Twitter</a>
    		</div>
    		<div class="oba-image"><a href="http://oldboys.ccgs.wa.edu.au"><img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/img-oba.jpg" alt=""></a></div>
    		<?php
    		wp_nav_menu( array(
    			'menu_class' => 'quick_links',
    			'container' => '',
    			'menu' => 'Old Boys Quick Links',
    			'depth' => 1
    		) );
    		?>
    	</nav>
    	<section class="events">
    		<h2>Calendar of Events</h2>

    		<ul>
    			<li>
    			<?php
    			/*
    			 * Get OB Newsletter
    			 */
    			$post_args = array(
    				'posts_per_page'	=> -1,
    				'category'			=> 100,
    				'post_type'			=> 'ob-newsletter',
    				'orderby'			=> 'menu_order',
    				'order'				=> 'ASC',
    				'tax_query' => array(
    					array(
    						'taxonomy' => 'post_tag',
    						'field' => 'slug',
    						'terms' => $tag
    					)
    				)
    			);
    			$posts_array = get_posts($post_args);

    			if(count($posts_array) > 0):
    				foreach($posts_array as $post):
    					setup_postdata($post);
    					the_content();
    				endforeach;
    				wp_reset_postdata();
    			endif;
    			?>
    			</li>
    		</ul>
    	</section>
    </aside>

  </div>
</section>
<?php get_footer(); ?>
