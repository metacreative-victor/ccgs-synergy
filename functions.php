<?php
/**
 * Required by WordPress.
 *
 * Keep this file clean and only use it for requires.
 */

 // --------------------------------------------------------------------------
 //   Include Utilities
 // --------------------------------------------------------------------------

 foreach (glob(dirname(__FILE__) . "/lib/utilities/*.php") as $filename) {
   require_once $filename;
 }

 // --------------------------------------------------------------------------
 //   Include Configuration
 // --------------------------------------------------------------------------

 foreach (glob(dirname(__FILE__) . "/lib/config/*.php") as $filename) {
   require_once $filename;
 }

 // --------------------------------------------------------------------------
 //   Include Post Types and Taxonomies
 // --------------------------------------------------------------------------

 foreach (glob(dirname(__FILE__) . "/lib/content/*.php") as $filename) {
   require_once $filename;
 }

 // --------------------------------------------------------------------------
 //   Include Tweaks
 // --------------------------------------------------------------------------

 foreach (glob(dirname(__FILE__) . "/lib/tweaks/*.php") as $filename) {
   require_once $filename;
 }
/*
require_once locate_template('du-functions.php');
// Add new functions (BirdBrain)
require_once locate_template('bb-functions.php');           // Utility functions
*/

// CUSTOM FUNCTIONS
function sen_save_post( $post_id, $post, $update ) {
  if( isset( $_REQUEST['page_template'] ) && $_REQUEST['page_template'] == 'template-bgm.php' ) {
    update_option( 'sen_page_bgm', $post_id );
  }
}
add_action( 'save_post', 'sen_save_post', 10, 3 );

function sen_featured_to_rss( $content ) {
  global $post;
  if( has_post_thumbnail( $post->ID ) ) {
    $content = '<div>' . get_the_post_thumbnail( $post->ID, 'medium', array( 'style' => 'margin-bottom: 15px;' ) ) . '</div>' . $content;
  }
  return $content;
}
add_filter( 'the_excerpt_rss', 'sen_featured_to_rss' );
add_filter( 'the_content_feed', 'sen_featured_to_rss' );

// HELPERS
function sen_paginate_links( $max_num = 0 ) {
  global $wp_query;
  $max_num_pages = $wp_query->max_num_pages;

  if( !empty( $max_num ) ) {
    $max_num_pages = $max_num;
  }

  echo paginate_links( array(
    'base'         => esc_url( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', htmlspecialchars_decode( get_pagenum_link( 999999999 ) ) ) ) ),
    'format'       => '',
    'current'      => max( 1, get_query_var( 'paged' ) ),
    'total'        => $max_num_pages,
    'prev_text'    => '&larr;',
    'next_text'    => '&rarr;',
    'type'         => 'list',
    'end_size'     => 3,
    'mid_size'     => 3
  ));
}
// END HELPERS



add_filter( 'excerpt_length', function($length) {
    return 150;
} );

// Allow links in excerpt
function new_wp_trim_excerpt($text) {
  $raw_excerpt = $text;
  if ( '' == $text ) {
    $text = get_the_content('');

    $text = strip_shortcodes( $text );

    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]>', $text);
    $text = strip_tags($text, '<a>');
    //$excerpt_length = apply_filters('excerpt_length', 55);
    $excerpt_length = 45;

    $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
    $words = preg_split('/(<a.*?a>)|\n|\r|\t|\s/', $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE );
    if ( count($words) > $excerpt_length ) {
      array_pop($words);
      $text = implode(' ', $words);
      $text = $text . $excerpt_more;
    } else {
      $text = implode(' ', $words);
    }
  }
  return apply_filters('new_wp_trim_excerpt', $text, $raw_excerpt);

}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'new_wp_trim_excerpt');

/* Hightlight keyword on search page */
function wps_highlight_results($text){
     if(!is_admin() && is_search()){
     $sr = get_query_var('s');
     $keys = explode(" ",$sr);
     $regEx = '\'(?!((<.*?)|(<a.*?)))(\b'. implode('|', $keys) . '\b)(?!(([^<>]*?)>)|([^>]*?</a>))\'iu';
     $text = preg_replace($regEx, '<i class="search-highlight" style="background:#ffca38">\0</i>', $text);
     }
     return $text;
}
add_filter('the_excerpt', 'wps_highlight_results');
//add_filter('the_title', 'wps_highlight_results');


add_filter( 'posts_orderby', 'order_search_by_posttype', 10, 2 );
function order_search_by_posttype( $orderby, $wp_query ){
    if( ! $wp_query->is_admin && $wp_query->is_search ) :
        global $wpdb;
        $orderby =
            "
            CASE WHEN {$wpdb->prefix}posts.post_type = 'page' THEN '1' 
                 WHEN {$wpdb->prefix}posts.post_type = 'post' THEN '2'
            ELSE {$wpdb->prefix}posts.post_type END ASC, 
            {$wpdb->prefix}posts.post_title ASC";
    endif;
    return $orderby;
}


?>
