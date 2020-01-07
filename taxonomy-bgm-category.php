<?php get_header(); ?>

<?php get_template_part('templates/bgm','header');?>

<div id="bgm-content">
    <div class="wrap-large">
        <div class="bgm-entry-content">
            <?php echo term_description(); ?>
        </div>

        <?php
        if( have_posts() ) :
            echo '<div class="bgm-post-lists">';
            $index = 1;
            while( have_posts() ) : the_post();

                if( $index == 1 ) {
                    get_template_part( 'templates/featured', 'bgm' );
                } else {
                    get_template_part( 'templates/loop', 'bgm' );
                }
                $index++;

            endwhile; wp_reset_postdata();
            echo '</div><!-- #bgm-posts -->';
            
            sen_paginate_links();
        endif;
        ?>
    </div>
</div>
<!-- #bgm-content -->

<?php get_footer(); ?>
