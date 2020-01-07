<?php
$data = get_field( 'bgm-intro' );
?>
<section class="bgm-intro">
    <div class="bgm-intro-heading">
        <div class="wrap-large">
            <?php
            if( !empty( $data['heading'] ) ) {
                echo '<h2>' .$data['heading']. '</h2>';
            }
            
            if( !empty( $data['sub_heading'] ) ) {
                echo '<p>' .$data['sub_heading']. '</p>';
            }

            if( !empty( $data['button']['title'] ) && !empty( $data['button']['url'] ) ) {
                echo '<a href="' .esc_url( $data['button']['url'] ). '" class="button-bgm-hub">' .$data['button']['title']. '</a>';
            }
            ?>
        </div>
        <!-- .wrap-large -->
    </div>
    <!-- .bgm-intro-heading -->

    <div class="bgm-intro-links">
        <div class="wrap-large">
            <?php
            if( !empty( $data['links'] ) ) {
                echo '<ul class="menu">';
                foreach( $data['links'] as $link ) {
                    if( !empty( $link['link']['title'] ) && !empty( $link['link']['url'] ) ) {
                        echo '<li class="bgm-category">';
                        echo '<div class="bgm-category-inner">';
                        echo '<a href="' .esc_url( $link['link']['url'] ). '" class="bgm-category-link"></a>';
                        echo '<p class="bgm-category-title">' .$link['link']['title']. '</p>';
                        if( !empty( $link['thumbnail'] ) ) {
                            $thumbnail = wp_get_attachment_image_src( $link['thumbnail'], 'large' );
                            echo '<div class="bgm-category-thumbnail" style="background-image: url(' .esc_url( $thumbnail[0] ). ');"></div>';
                        }
                        echo '</li>';
                    }
                }
                echo '</ul>';
            }
            ?>
        </div>
        <!-- .wrap-large -->
    </div>
    <!-- .bgm-intro-links -->
</section>
<!-- .bgm-intro -->