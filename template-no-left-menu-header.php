<?php
/**
 * @package WordPress
 * @subpackage DigitalUnionInstallBase
 * @since 2011
 * Template Name: No Left Menu,Header
 */
 get_header(); the_post();
?>
<?php
$sideimage1 = "";
$sideimage2 = "";
$rightColumn = "";

$thumb_image_id = get_field('page_sideimage1_thumbnail_id');
if( $thumb_image_id > 0 ) :
    $url = wp_get_attachment_image_src( $thumb_image_id, 'medium' );
    $sideimage1 = '<div class="visual"><img src="' . $url[0] . '" /></div>';
endif;

$thumb_image_id = get_field('page_sideimage1_thumbnail_id');
if( $thumb_image_id > 0 ) :
    $url = wp_get_attachment_image_src( $thumb_image_id, 'medium' );
    $sideimage2 = '<div class="visual"><img src="' . $url[0] . '" /></div>';
endif;

$rightColumn = get_field('_mcb-right-column');
?>
<section class="paddit sectionit">
  <div class="wrap-large">

    <div class="onecolumn">
    	<article class="intro-box">
    		<div class="textbox">
    			<h1><?php the_title(); ?></h1>
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
    
  </div>
</section>
<?php get_footer(); ?>
