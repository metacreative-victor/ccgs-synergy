<?php
 get_header(); the_post();
?>

<?php get_template_part('templates/page','header');?>

<section class="paddit sectionit videos-page">
  <div class="wrap-small">
    <div class="onecolumn">

      <!--<h1><?php the_title(); ?></h1>-->
      <?php echo get_field('post_subtitle') ? '<h2>' . get_field('post_subtitle') . '</h2>' : '';?>
      <?php the_content(); ?>
      <div class="video-list">
        <?php if( have_rows('videos') ): ?>

      	<?php while( have_rows('videos') ): the_row();

      		$link = get_sub_field('video_link');
      		$title = get_sub_field('title');
          $video_type = get_sub_field('video_type');
      		?>

      		<div class="video">
            <?php echo $title ? '<h3>' . $title . '</h3>' : ''; ?>

      			<?php if( $link ): ?>
              <?php if ($video_type == 'vimeo') { ?>
                <div class="iframe-wrapper">
                  <iframe src="https://player.vimeo.com/video/<?php echo $link?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
              <?php }else{ ?>
                <div class="iframe-wrapper">
                  <iframe src="https://www.youtube.com/embed/<?php echo $link?>" frameborder="0" allowfullscreen></iframe>
                </div>
              <?php } ?>
      			<?php endif; ?>

      		</div>

      	<?php endwhile; ?>

      <?php endif; ?>

        </div>

    </div>
  </div>
</section>
<?php get_footer(); ?>
