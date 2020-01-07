<?php echo get_sub_field('section_title') ? '<h3>' . get_sub_field('section_title') . '</h3>' : '' ;?>
<?php if( have_rows('profile_list') ): ?>
  <div class="profile_list">
    <?php while ( have_rows('profile_list') ) : the_row(); ?>
      <div class="single_profile">
        <div class="image">
          <div class="wrap">
            <div class="inner" style="background-image:url(<?php echo get_sub_field('image')['url']; ?>)"></div>
          </div>
        </div>
        <div class="content">
          <h4><?php echo get_sub_field('title'); ?></h4>
          <p><strong><?php echo get_sub_field('sub_title'); ?></strong></p>
          <?php echo get_sub_field('content'); ?>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
<?php endif; ?>
