<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav id="post-nav" class="pagination">
    <ul class="pager">
      <?php if (get_previous_posts_link()) : ?>
        <li class="next"><?php previous_posts_link(__('Newer', 'roots')); ?></li>
      <?php else: ?>
        <!--<li class="next disabled"><a><?php _e('Newer', 'roots'); ?></a></li>-->
      <?php endif; ?>

      <?php if (get_next_posts_link()) : ?>
        <li class="previous"><?php next_posts_link(__('Older', 'roots')); ?></li>
      <?php else: ?>
        <!--<li class="previous disabled"><a><?php _e('Older', 'roots'); ?></a></li>-->
      <?php endif; ?>
    </ul>
  </nav>
<?php endif; ?>
