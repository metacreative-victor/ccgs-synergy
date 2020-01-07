<?php get_header(); ?>
<?php the_post();?>
<section class="sectionit paddit">
	<div class="wrap-large">
		<div class="onecolumn">
			<div id="content">

		    <h1><?php the_title(); ?></h1>

		    <?php
		    //if we got something through $_POST
		    if (isset($_POST['search'])) {

		        // never trust what user wrote! We must ALWAYS sanitize user input
		        $word = esc_sql($_POST['search']);
		        $word = htmlentities($word);
		    	  $needle = strtolower($word);
		    ?>


		    <?php } ?>


		    <?php
		      $options = get_option('du_ccgs');
		      if (!empty($options['cal_btn_text']) && !empty($options['cal_btn_link'])) {
		        $text = $options['cal_btn_text'];
		        $link = $options['cal_btn_link'];
		        if ($link[0] != '/' && strpos($link,'http') === false) {
		          $link = '/' . $link;
		        }
		        print '<a href="' . $link . '" id="custom-calendar-link">' . $text . '</a>';
		      }
		    ?>

		    <div id="search-container">
		    		<p>Search Calendar</p>
		    		<form role="search" method="get" id="searchform" class="form-search" action="<?php echo home_url(); ?>" role="search">
		            <img id="ajax-loader" src="<?php echo content_url().'/themes/christchurchschool/assets/images/ajax-loader.gif'; ?>" />
		    		    <input type="text" name="s" id="s" class="search_box" value="<?php echo isset($word)?>"/>
		            <input type="hidden" name="type" id="type" value="calendar">
		    		    <input type="submit" value="Search" class="search_button" /><br />
		    		</form>
		    		</div>
		    		<div>
		    		<div id="searchresults">Search results :</div>
		    		<ul id="results" class="update">
		    		</ul>
		    </div>

		    <?php $terms = get_terms( 'events_categories' ); ?>
		    <div id="calendar-legend">
		      <h2>Calendar Legend</h2>
		      <?php
		      global $wpdb;
		      $results = $wpdb->get_results( 'SELECT * FROM wp_ai1ec_event_category_meta', OBJECT );
		      $colour_array = array();
		      foreach ($results as $key => $result){
		        $colour_array[$result->term_id] = $result->term_color;
		      }
		      ?>
		      <?php foreach($terms as $term):?>
		        <div class="legend-item" style="background:<?php echo $colour_array[$term->term_id];?>;">
		          <?php print $term->name; ?>
		        </div>
		      <?php endforeach; ?>
		    </div>
				<?php echo do_shortcode('[ai1ec view="monthly"]');?>
		  </div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
