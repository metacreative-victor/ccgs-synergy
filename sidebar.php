<aside id="sidebar">
	<?php
	if (is_page_template('template-ob-association.php')) :
		?>
	<div class="notices">
		<h2>News</h2>
	</div>
		<?php
	endif;
	?>
	<nav class="sidenav">

		<?php 
		global $post;
		if(is_page(1886) || $post->post_parent == 1886) {
			$args = array(
				'menu' => 280,
			);
			wp_nav_menu( $args );
		} else {

		?>

		<?php
			if ($post->post_parent) {
				// get depth of current page
				$children = wp_list_pages("title_li=&child_of=" . $post->ID . "&echo=0&depth=1");
				$parent = get_post($post->post_parent);
				if($parent->post_parent)
					$children = wp_list_pages("title_li=&child_of=" . $post->ID . "&echo=0&depth=1");
				
				if(empty($children)) $children = wp_list_pages("title_li=&child_of=" . $post->post_parent . "&echo=0&depth=1");
			} else {
				$children = wp_list_pages("title_li=&child_of=" . $post->ID . "&echo=0&depth=1");
			}
			if ($children) {
			?>
			<ul>
			<?php if (get_the_ID() == 18){ echo "<li class='page_item'><a href='https://info.ccgs.wa.edu.au/prospectus-download'>Find out more</a></li>"; } ?>
	        <?php if (get_the_ID() == 82){ echo "<li class='page_item'><a href='http://sport.ccgs.wa.edu.au/Fixtures_Teams.asp?Id=28729'>Sport fixtures and results</a></li>"; } ?>
				<?php echo $children; ?>
			</ul>
			<?php } ?>
		<?php } ?>
	</nav>
	
	
		<?php
		if( have_rows('sidebar_buttons') ):?>
		<div class="sidebar-buttons">
			<ul>
				<?php
				while ( have_rows('sidebar_buttons') ) : the_row(); ?>
					<?php 
					$link = get_sub_field('buttons');
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<li><a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></li>
				<?php endwhile; ?>
			</ul>
		</div>
		<?php else :
			// no rows found
		endif;
		?>
	
</aside>