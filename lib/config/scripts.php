<?php
/**
 * Scripts and stylesheets
*/

function roots_scripts() {
  // jQuery is loaded in header.php using the same method from HTML5 Boilerplate:
  // Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline
  // It's kept in the header instead of footer to avoid conflicts with plugins.
  if (!is_admin()) {
    //Set min version for live site
    $min = (WP_DEBUG) ? '' : '.min';
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'global',    THEME_URL . '/assets/js/global.min.js', array('jquery'), THEME_VERSION, true);
    //wp_enqueue_script( 'responsiveText',    THEME_URL . '/assets/js/vendor/jquery.responsiveText.js', array('jquery'), '', true);
    //wp_enqueue_script( 'mCustomScrollbar',     THEME_URL . '/assets/js/vendor/custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js', array('jquery'), '', true);
    //wp_enqueue_script( 'bxslider', THEME_URL . '/assets/js/vendor/jquery.bxslider/jquery.bxslider.min.js');
    //wp_enqueue_script( 'slick',     THEME_URL . '/assets/js/vendor/slick.min.js', array('jquery'), '', true);

    //wp_enqueue_script( 'infieldlabel',     THEME_URL . '/assets/js/vendor/jquery.infieldlabel.js', array('jquery'), '', true);
    //wp_enqueue_script( 'yrcalc',     THEME_URL . '/assets/js/vendor/yrcalc.js', array('jquery'), '', true);

    //wp_enqueue_script( 'main',     THEME_URL . '/assets/js/vendor/jquery.main.js', array('jquery'), '', true);

    //wp_enqueue_script( 'jquery-ui',     THEME_URL . '/assets/js/vendor/jquery-ui-1.10.3.custom.min.js', array('jquery'), '', true);
    //wp_enqueue_script( 'mousewheel',     THEME_URL . '/assets/js/vendor/jquery.mousewheel.min.js', array('jquery'), '', true);
    //wp_enqueue_script( 'kinetic',     THEME_URL . '/assets/js/vendor/jquery.kinetic.min.js', array('jquery'), '', true);
    //wp_enqueue_script( 'smoothdivscroll',     THEME_URLL . '/assets/js/vendor/jquery.smoothdivscroll-1.3-min.js', array('jquery'), '', true);


    if ( is_page('interactive-map') ){
      wp_enqueue_script( 'imagemapster',     THEME_URL . '/assets/js/vendor/jquery.imagemapster.min.js', array('jquery'), '', true);
      //wp_enqueue_script( 'fancybox',     THEME_URL . '/assets/js/fancybox/jquery.fancybox.pack.js', array('jquery'), '', true);
      //wp_enqueue_style( 'fancybox', THEME_URL.'/assets/js/fancybox/jquery.fancybox.css', '');
    }

    // wp_enqueue_style( 'slick', THEME_URL.'/assets/css/slick.min.css', '', '1,8,1');
    wp_enqueue_script( 'slick', THEME_URL.'/assets/js/slick.min.js', array('jquery'), '1.8.1', true);

    if ( is_front_page() ) {
      // wp_enqueue_script( 'vide', THEME_URL.'/assets/js/vendor/jquery.vide.min.js', array('jquery'), '', true);
      wp_enqueue_script( 'home', THEME_URL.'/assets/js/pages/home.js', array('jquery'), '', true);
    }

    //Disable calendar scripts and styles on all pages but Canlendar and
    if ( !is_page('Calendar') && !is_page('ccgs-world') ) {
      wp_deregister_style( 'ai1ec_style' );
    }

    if ( is_single() || is_archive() || is_page('interactive-map') ) {

      wp_enqueue_script( 'print',     THEME_URL . '/assets/js/vendor/jquery.print.js', array('jquery'), '', true);
      wp_enqueue_script( 'fancybox-three', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.js', array('jquery'), '', true);
      wp_enqueue_style( 'fancybox-three', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.css', '');

    }
    if ( is_archive() ) {
      wp_enqueue_script( 'masonry.pkgd',     THEME_URL . '/assets/js/vendor/masonry.js', array('jquery'), '', true);
    }

    //Styles
    //wp_enqueue_style( 'loading', THEME_URL.'/assets/css/loading'.$min.'.css', '', THEME_VERSION );
    wp_enqueue_style( 'global-style', THEME_URL.'/assets/css/styles'.$min.'.css', '', THEME_VERSION );
    wp_enqueue_style( 'bgm-style', THEME_URL.'/assets/css/styles-bgm.css', '', THEME_VERSION );
    //wp_enqueue_style( 'custom-scrollbar', THEME_URL.'/assets/js/vendor/custom-scrollbar-plugin/jquery.mCustomScrollbar.css', '');
    //wp_enqueue_style( 'smoothDivScroll', THEME_URL.'/assets/css/smoothDivScroll.css', '');


  }
  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script( 'comment-reply' );
  }

}

add_action('wp_enqueue_scripts', 'roots_scripts', 100);

function localize_ajax () {

	// Initialize AJAX dependencies
	wp_localize_script( 'jquery', 'AJAX', array(
		'url' => admin_url( 'admin-ajax.php' ),
		'home_dir' => home_url(),
	) );

}
add_action( 'template_redirect', 'localize_ajax' );

function admin_style() {

  $min = (WP_DEBUG) ? '' : '.min';

  wp_enqueue_style('admin-styles', get_template_directory_uri().'/assets/css/admin'.$min.'.css');

}

add_action('admin_enqueue_scripts', 'admin_style');
