<?php get_header(); ?>

<section class="paddit sectionit">
  <div class="wrap-large">

	<h1>Search<?php echo isset($_GET['type']) ? ': ' . ucwords($_GET['type']) :''?></h1>

	<form method="get" id="searchform" action="<?php bloginfo('url'); ?>" role="search">
	<div class="search-wrapper">
		<div class="fields">
			<div class="l-cell">
        <label for="s">Type your query and press enter</label>
        <input name="s" id="s" type="text" tabindex="1" value="<?php echo is_search() ? get_search_query() : ''; ?>">
        <?php echo isset($_GET['type']) ? '<input type="hidden" name="type" id="type" value="'.$_GET['type'].'">':''?>
        <input type="submit" id="submit-search" value="Search" tabindex="2" class="search_button">
      </div>
			<div class="clear"></div>
		</div>
	</div>
	</form>

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

      <?php
      $post_title = $post->post_type;

      $post_title = $post_title == 'post' ? 'News' : $post_title;
      //$post_title_new = $post_title == 'news' ? 'CCGS World' : $post_title;
      $post_title = $post_title == 'ai1ec_event' ? 'Events' : $post_title;
      $post_title = ucwords($post_title);
      ?>

      <?php if ($post->post_type == 'notice'):
        /*
        <div class=" result search-notice">
          <h3><span>Notice:</span> <?php echo get_the_title(); ?> <a class="notice-read-more">Read More</a></h3>
    			<div class="search-notice-content"><p><?php echo the_content(); ?></p></div>
        </div>
        */
        else: ?>
        <div class="result">
  			  <h3><span><?php echo $post_title?>:</span> <a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
    			<p><?php echo the_excerpt(); ?></p>
        </div>

      <?php endif; ?>

		<?php endwhile; ?>

	<?php else: ?>

		<p><strong>No results were found.</strong></p>

	<?php endif; ?>


<?php the_posts_pagination(); ?>

</div>
</section>
<div class="clear"></div>
<?php get_footer(); ?>
