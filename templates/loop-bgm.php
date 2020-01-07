<div class="bgm-post-item">
    <div class="bgm-post-inner">
        <?php
        $categories = get_the_terms( get_the_ID(), 'bgm-category' );

        if( $categories && !is_wp_error( $categories ) ) {
            echo '<a href="' .esc_url( get_term_link( $categories[0] ) ). '" class="bgm-post-category">' .$categories[0]->name. '</a>';
        }
        ?>

        <p class="bgm-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>

        <?php if( has_post_thumbnail() ) { ?>
            <div class="bgm-post-thumbnail" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>)">
                <a href="<?php the_permalink(); ?>" class="bgm-post-link"></a>
            </div>
        <?php } ?>
    </div>
    <!-- .bgm-post-inner -->
</div>
<!-- .bgm-post-item -->