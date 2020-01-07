<?php
$thumb_image_id = wp_get_attachment_image_src( get_field('page_featuredimage1_thumbnail_id'), 'full' );
$thumb_image_id_2 = wp_get_attachment_image_src( get_field('page_featuredimage2_thumbnail_id'), 'full' );
?>

<div id="inner_banner">
  <?php if ($thumb_image_id[0] != ''){ ?>
  <div class="ib_left" style="background-image:url('<?php echo $thumb_image_id ? $thumb_image_id[0] : '' ?>')"></div>
  <div class="ib_right" style="background-image:url('<?php echo $thumb_image_id_2 ? $thumb_image_id_2[0] : ''?>')"></div>
  <?php } ?>
</div>
<div class="clear"></div>
