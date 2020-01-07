<?php
/**
 * Template Name: Page BGM Archive
 */

get_header(); ?>

<?php get_header(); ?>

<?php get_template_part('templates/bgm','header');?>

<div id="bgm-content">
    <div class="wrap-large">
        <?php while( have_posts() ) : the_post(); ?>
            <?php
            $posts = get_field( 'bgm_posts' );
            ?>

            <div class="bgm-post-content">
                <div class="bgm-entry-content">
                    <h1><?php the_title(); ?></h1>
                    <?php the_content(); ?>

                    <?php
                    if( !empty( $posts ) ) {
                        echo '<div class="bgm-archive-anchors">';
                        echo '<h4>Jump to section</h4>';
                        echo '<ul class="menu">';
                        foreach( $posts as $item ) {
                            echo '<li><a href="#post-' .$item. '">' .get_the_title( $item ). '</a></li>';
                        }
                        echo '</ul>';
                        echo '</div>';

                        foreach( $posts as $item ) {
                            echo '<article class="bgm-archive-post" id="post-' .$item. '">';
                            echo '<h2><a href="' .esc_url( get_permalink( $item ) ). '">' .get_the_title( $item ). '</a></h2>';
                            if( has_post_thumbnail( $item ) ) {
                                $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $item ), 'full' );
                                echo '<div class="bgm-archive-post-thumbnail" style="background-image: url(' .esc_url( $thumbnail[0] ). ');"></div>';
                            }
                            echo wpautop( get_post_field( 'post_content', $item ) );
                            echo '</article>';
                        }
                    }
                    ?>
                </div>
                <div class="bgm-entry-sidebar">

                    <?php
                    echo '<div class="bgm-archive-anchors">';
                    echo '<h4>Jump to section</h4>';
                    the_field('_mcb-right-column');
                    echo '</div>';
                    ?>

                    <?php
                    /*if( !empty( $posts ) ) {
                        echo '<div class="bgm-archive-anchors">';
                        echo '<h4>Jump to section</h4>';
                        echo '<ul class="menu">';
                        foreach( $posts as $item ) {
                            echo '<li><a href="#post-' .$item. '">' .get_the_title( $item ). '</a></li>';
                        }
                        echo '</ul>';
                        echo '</div>';
                    }*/
                    ?>

                    <?php //get_sidebar( 'bgm' ); ?>


                    <?php
                    $post_id = get_the_ID();
                    $post_title = get_the_title( $post_id );
                    $post_link = get_permalink( $post_id );
                    ?>
                    <!-- .widget -->

                    <div class="widget">
                        <h4 class="bgm-widget-title"><span>Share</span></h4>
                        <?php
                        $facebook_link = 'https://www.facebook.com/sharer/sharer.php?u='. $post_link;
                        $twitter_link = 'https://twitter.com/intent/tweet?source='. $post_link .'&amp;text=' .$post_title. ':%20' .$post_link;
                        ?>
                        <ul class="bgm-sharing">
                            <li class="facebook"><a href="javascript:void(0)" onclick="ccgs_sharing('<?php echo $facebook_link; ?>')"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li class="twitter"><a href="javascript:void(0)" onclick="ccgs_sharing('<?php echo $twitter_link; ?>')"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li class="email"><a href="javascript:void(0)" onclick="window.location.href = 'mailto:?subject=' + decodeURIComponent('<?php echo $post_title; ?>').replace('&', '%26') + '&body=' + decodeURIComponent('<?php echo $post_link; ?>')"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <!-- .widget -->

                    
                </div>
            </div>
            <!-- .bgm-post-content -->
        <?php endwhile; ?>
    </div>
</div>
<!-- #bgm-content -->

<?php get_footer(); ?>
