<?php get_header(); ?>

<?php get_template_part('templates/bgm','header');?>

<div id="bgm-content">
    <div class="wrap-large">
        <?php while( have_posts() ) : the_post(); ?>
            <?php
            $post_id = get_the_ID();
            $post_title = get_the_title( $post_id );
            $post_link = get_permalink( $post_id );
            $categories = get_the_terms( $post_id, 'bgm-category' );
            ?>
            <div class="bgm-post-header">
                <div class="bgm-post-meta">
                    <?php
                    if( $categories && !is_wp_error( $categories ) ) {
                        echo '<a href="' .esc_url( get_term_link( $categories[0] ) ). '">' .$categories[0]->name. '</a>';
                    }
                    ?>
                    <span><?php the_date('M j, Y'); ?></span>
                </div>
                <!-- .bgm-post-meta -->
                <h1><?php echo $post_title ?></h1>
                <?php if( has_post_thumbnail() ) { ?>
                    <div class="bgm-post-thumbnail" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>)"></div>
                <?php } ?>
            </div>
            <!-- .bgm-post-header -->

            <div class="bgm-post-content">
                <div class="bgm-entry-content">
                    <?php the_content(); ?>
                </div>
                <div class="bgm-entry-sidebar">
                    <?php get_sidebar( 'bgm' ); ?>
                </div>
            </div>
            <!-- .bgm-post-content -->
            
            <?php
            $args = array();
            $args['post_type'] = 'bgm-post';
            $args['post_status'] = 'publish';
            $args['posts_per_page'] = 4;
            $args['post__not_in'] = array($post_id);

            if( $categories && !is_wp_error( $categories ) ) {
                $cat_ids = array();

                foreach( $categories as $cat ) {
                    $cat_ids[] = $cat->term_id;
                }

                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'bgm-category',
                        'field' => 'term_id',
                        'terms' => $cat_ids
                    )
                );
            }

            $the_query = new WP_Query( $args );
            ?>
            <?php if( $the_query->have_posts() ) : ?>
                <div class="bgm-related-posts">
                    <h4 class="bgm-widget-title"><span>Next stories</span></h4>
                    <div class="bgm-post-lists">
                        <?php
                        while( $the_query->have_posts() ) : $the_query->the_post();

                            get_template_part( 'templates/loop', 'bgm' );

                        endwhile; wp_reset_postdata();
                        ?>
                    </div><!-- .bgm-post-lists -->
                    
                    <?php
                    if( $categories && !is_wp_error( $categories ) ) {
                        echo '<div class="more"><a href="' .esc_url( get_term_link( $categories[0] ) ). '"><span>View More Stories</span> <i class="fa fa-angle-down" aria-hidden="true"></i></a></div>';
                    }
                    ?>
                </div>
                <!-- .bgm-related-posts -->
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
</div>
<!-- #bgm-content -->

<?php get_footer(); ?>
