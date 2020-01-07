<?php
$post_id = get_the_ID();
$post_title = get_the_title( $post_id );
$post_link = get_permalink( $post_id );
?>

<div class="widget widget-form">
    <h4 class="bgm-widget-title"><span>Liked this post?</span><br><span id="subscribe-message">Subscribe to our Building Good Men newsletter for the latest insights on raising boys.</span></h4>

    <!--[if lte IE 8]>
    <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
    <![endif]-->
    <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
    <script>
    hbspt.forms.create({
        portalId: "5239298",
        formId: "503c3eba-a244-456d-8762-3d494ab75906"
    });
    </script>


    <?php //echo do_shortcode( '[gravityforms id="29" title="false" description="true" ajax="true"]' ); ?>
</div>
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

<div class="tags">
    <h3 class="tags-heading">More topics</h3>
    <?php //echo get_the_tag_list('<ul><li>','</li><li>','</li></ul>');?>


    <?php
    $args = array( 'hide_empty=0' );
 
    $terms = get_terms( 'bgm-tags', $args );
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
        $count = count( $terms );
        $i = 0;
        $term_list = '<ul class="my_term-archive">';
        foreach ( $terms as $term ) {
            $i++;
            $term_list .= '<li><a href="' . esc_url( get_term_link( $term ) ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $term->name ) ) . '">' . $term->name . '</a></li>';
            if ( $count != $i ) {
                //$term_list .= ' &middot; ';
            }
            else {
                $term_list .= '</ul>';
            }
        }
        echo $term_list;
    }
    ?>

</div>
