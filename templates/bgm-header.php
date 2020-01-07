<?php
$bgm_page_id = get_option('sen_page_bgm');

if( !empty( $bgm_page_id ) ) {
    $thumb_image_id = wp_get_attachment_image_src( get_field('page_featuredimage1_thumbnail_id', $bgm_page_id), 'full' );
    $thumb_image_id_2 = wp_get_attachment_image_src( get_field('page_featuredimage2_thumbnail_id', $bgm_page_id), 'full' );

    echo '<div id="inner_banner">';
    if( $thumb_image_id[0] != '' ) {
        echo '<div class="ib_left" style="background-image:url(' .esc_url( $thumb_image_id[0] ). ')"></div>';
        echo '<div class="ib_right" style="background-image:url(' .esc_url( $thumb_image_id_2[0] ). ')"></div>';
    }
    echo '</div><!-- #inner_banner -->';
    echo '<div class="clear"></div>';
}
?>

<div id="bgm-header">
    <h2>Building Good Men Hub</h2>
    <?php
    wp_nav_menu( array(
        'menu' => 'BGM Menu',
        'menu_class' => 'menu',
        'container' => '',
        'link_before' => '<span>',
        'link_after' => '</span>',
    ));
    ?>
</div>
<!-- #bgm-header -->