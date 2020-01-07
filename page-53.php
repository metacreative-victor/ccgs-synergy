<?php get_header(); ?>

<?php the_post(); ?>

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

$thumb_image_id =  get_field('page_sideimage2_thumbnail_id');
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
              <?php echo get_field('post_subtitle') ? '<h3>' . get_field('post_subtitle') .'</h3>' : '';?>
              <?php the_content(); ?>
			  
			  <section class="intro">
				<div class="wrap-large">
				  <a class="col prep-school-pod" href="#">
					<div class="image" style="background-image:url('https://www.ccgs.wa.edu.au/wp-content/uploads/2018/11/J002640-Website-Update-Image-Resize-4.jpg')"></div>
					<div class="over">
					  <div class="inner">
						<h2>Preparatory School</h2>
						<p>Pre-Kindergarten to Year 6</p>          </div>
					</div>
				  </a>
					 <a class="col senior-school-pod" href="#">
					<div class="image" style="background-image:url('https://www.ccgs.wa.edu.au/wp-content/uploads/2017/11/BuildingGoodMen.jpg')"></div>
					<div class="over">
					  <div class="inner">
						<h2>Senior School</h2>
						<p>Years 7 to 12</p>          </div>
					</div>
				  </a>
				</div>
			  </section>
			  
			  <div class="prep-school-content" id="prepschool">
			  	<?php the_field('preparatory_school_tour');?>
			  </div>
			  <div class="senior-school-content" id="seniorschool">
			    <?php the_field('senior_school_tour');?>
			  </div>
          </div>
      </article>
      <?php
      if (($sideimage1 != "") or ($sideimage2 != "") or ($rightColumn != "")){
        ?>
        <div class="images-col">
          <?php

          echo $sideimage1 . $sideimage2;
          echo "<div class='right_column_content'>" . do_shortcode($rightColumn) . "</div>";
          ?>
        </div>
        <?php
      }
      ?>


    </div>

    <?php get_sidebar(); ?>

  </div>
</section>


<?php get_footer(); ?>
