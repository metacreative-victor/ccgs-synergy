<?php if( have_rows('announcements_bar') ): ?>
<div class="announcements_bar">
  <div class="announcements" id="announcements">
   <?php while( have_rows('announcements_bar') ): the_row(); ?>
	  <?php if( get_sub_field('external_link') ) { ?>
		<a href="<?php echo get_sub_field('announcement_link');?>" target="_blank"><?php echo get_sub_field('announcement');?></a>
	  <?php } else { ?>
		<a href="<?php echo get_sub_field('announcement_link');?>"><?php echo get_sub_field('announcement');?></a>
	  <?php } ?>
     
   <?php endwhile; ?>
   </div>
</div>
<?php endif; ?>
