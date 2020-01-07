<?php
/**
 * Template Name: No Child Left Menu
 */
 get_header(); the_post();
?>

<?php get_template_part('templates/page','header');?>

<?php
$sideimage1 = "";
$sideimage2 = "";
$rightColumn = "";

    $thumb_image_id = get_field('page_sideimage1_thumbnail_id');
    if( $thumb_image_id > 0 ) :
        $url = wp_get_attachment_image_src( $thumb_image_id, 'medium' );
        $sideimage1 = '<div class="visual"><img src="' . $url[0] . '" /></div>';
    endif;

    $thumb_image_id = get_field('page_sideimage2_thumbnail_id');
    if( $thumb_image_id > 0 ) :
        $url = wp_get_attachment_image_src( $thumb_image_id, 'medium' );
        $sideimage2 = '<div class="visual"><img src="' . $url[0] . '" /></div>';
    endif;

$rightColumn = get_field('_mcb-right-column');
$column_class = "";
if (($sideimage1 != "") or ($sideimage2 != "") or ($rightColumn != "")){
  $column_class = "has_third_column";
}
?>

<section class="paddit sectionit">
  <div class="wrap-large">

    <div class="twocolumns <?php echo $column_class; ?>">
      <article class="intro-box">
          <div class="textbox">
              <h1><?php the_title(); ?></h1>


              <?php

              if( have_rows('vacancies') ):
                  echo '<table class="career-vacancies"><tr><th>Position</th><th>Status</th><th>Applications close</th></tr>';
                 	// loop through the rows of data
                    while ( have_rows('vacancies') ) : the_row();
                      echo '<tr>';
                        // display a sub field value
                        echo '<td><a href="'.get_sub_field('link').'">' . get_sub_field('position') . '</a></td>';
                        echo '<td>' . get_sub_field('status') . '</td>';
                        echo '<td>' . get_sub_field('application_close') . '</td>';
                      echo '</tr>';
                    endwhile;
                    echo '</table>';
              endif;
              ?>

              <p>&nbsp;</p>

              <?php the_content(); ?>

          </div>
      </article>
      <?php
      if (($sideimage1 != "") or ($sideimage2 != "") or ($rightColumn != "")){
        ?>
        <div class="images-col">
          <?php
          echo $sideimage1 . $sideimage2;
          echo "<div class='right_column_content'>" . $rightColumn . "</div>";
          ?>
        </div>
        <?php
      }
      ?>


    </div>

    <aside id="sidebar">
    	<nav class="sidenav">
    		<?php
    		if ($post->post_parent) {
    			// get depth of current page
    			$parent = get_post($post->post_parent);
    			$children = wp_list_pages("title_li=&child_of=" . $parent->ID . "&echo=0&depth=1");
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
