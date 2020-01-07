<?php
/**
 * Template Name: Page BGM
 */

get_header(); ?>

<?php get_template_part('templates/bgm','header');?>

<div id="bgm-content">
    <div class="wrap-large">
        <?php
        $args = array();
        $args['post_type'] = 'bgm-post';
        $args['post_status'] = 'publish';
        $args['posts_per_page'] = 9;
        $args['paged'] = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $the_query = new WP_Query( $args );
        if( $the_query->have_posts() ) :
            echo '<div class="bgm-post-lists">';
            $index = 1;
            while( $the_query->have_posts() ) : $the_query->the_post();

                if( $index == 1 ) {
                    get_template_part( 'templates/featured', 'bgm' );
                } else {
                    get_template_part( 'templates/loop', 'bgm' );
                }
                $index++;

            endwhile; wp_reset_postdata();
            echo '</div><!-- #bgm-posts -->';

            sen_paginate_links( $the_query->max_num_pages );
        endif;
        ?>
    </div>
</div>
<!-- #bgm-content -->

<?php get_footer(); ?>
