<?php get_header(); ?>

<section class="paddit sectionit">
  <div class="wrap-large">

  	<h1>404 - Page Not Found</h1>
  	<h3>The page was not found, it may have moved location.</h3>

  	<form method="get" id="searchform" action="<?php bloginfo('url'); ?>" role="search">
  	<div class="search-wrapper">
  		<div class="fields">
  			<div class="l-cell">
          <label for="s"><b>Try a search?</b> Type your query and press enter</label>
          <input name="s" id="s" type="text" tabindex="1">
          <input type="submit" id="submit-search" value="SEARCH" tabindex="2">
        </div>
  			<div class="r-cell"></div>
  			<div class="clear"></div>
  		</div>
  	</div>
  	</form>

  </div>
</section>

<?php get_footer(); ?>
