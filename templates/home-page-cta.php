<?php if( have_rows('cta_blocks') ): ?>

  <section class="ctas">

    <div class="wrap-large">

    <?php while( have_rows('cta_blocks') ): the_row();?>
      <a class="col" href="<?php echo get_sub_field('link')['url'];?>" <?php echo get_sub_field('link')['target'] ? 'target="'.get_sub_field('link')['target'] .'"' : '' ;?>>
        <div class="icon"><img src="<?php echo get_sub_field('icon')['url'];?>"></div>
        <div class="over">
          <div class="inner">
            <h2><?php echo get_sub_field('title');?></h2>
            <p><?php echo get_sub_field('content');?></p>
          </div>
        </div>
      </a>
   <?php endwhile; ?>

    </div>

</section>

<?php endif; ?>
