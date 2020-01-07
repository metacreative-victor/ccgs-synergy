<?php
$data = get_field( 'bgm-posts' );
?>
<section class="bgm-posts">
    <div class="wrap-large">
        <?php
        if( !empty( $data['heading'] ) ) {
            echo '<h2>' .$data['heading']. '</h2>';
        }
        
        $args = array();
        $args['post_type'] = 'bgm-post';
        $args['post_status'] = 'publish';
        $args['posts_per_page'] = 4;

        $the_query = new WP_Query( $args );
        if( $the_query->have_posts() ) :
            echo '<div class="bgm-post-lists">';
            while( $the_query->have_posts() ) : $the_query->the_post();

                get_template_part( 'templates/loop', 'bgm' );

            endwhile; wp_reset_postdata();
            echo '</div><!-- .bgm-post-lists -->';
        endif;
        ?>
    </div>
    <!-- .wrap-large -->
</section>
<!-- .bgm-intro -->