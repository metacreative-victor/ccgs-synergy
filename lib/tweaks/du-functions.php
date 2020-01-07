<?php
function du_init_theme () {
	// Script dependencies
	//wp_enqueue_script( 'jquery' );

	// Theme dependencies
	//add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
	//register_nav_menus( array(
	//	'primary-navigation' => __( 'Primary Navigation' )
	//) );

	add_action( 'wp_ajax_newsletter_signup', 'du_newsletter_signup' );
	add_action( 'wp_ajax_nopriv_newsletter_signup', 'du_newsletter_signup' );

	// Add the excerpt to pages
	add_post_type_support( 'page', 'excerpt' );

	// News - CCGS
	$labels = array(
		'name' => _x('CCGS World', 'post type general name'),
		'singular_name' => _x('News', 'post type singular name'),
		'add_new' => _x('Add New', 'News'),
		'add_new_item' => __('Add New News Item'),
		'edit_item' => __('Edit News Item'),
		'new_item' => __('New News Item'),
		'view_item' => __('View News Item'),
		'search_items' => __('Search News'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash')
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'menu_position' => 4,
		'has_archive' => true, // Activate the archive
		'supports' => array('title','editor','thumbnail','page-attributes','excerpt'),
		'taxonomies' => array('category', 'post_tag'), // this is IMPORTANT
		'rewrite' => array( 'slug' => 'ccgs-world' )
	);
	register_post_type( 'news', $args );

	// Notices
	// Notices are used for the CCGS World page
	$labels = array(
		'name' => _x('Notices', 'post type general name'),
		'singular_name' => _x('Notice', 'post type singular name'),
		'add_new' => _x('Add Notice', 'Notices'),
		'add_new_item' => __('Add New Notice'),
		'edit_item' => __('Edit Notice Item'),
		'new_item' => __('New Notice Item'),
		'view_item' => __('View Notice Item'),
		'search_items' => __('Search Notices'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash')
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'menu_position' => 4,
		'has_archive' => 'true', // Activate the archive
		'supports' => array('title','editor','thumbnail','page-attributes','excerpt'),
		'taxonomies' => array('category', 'post_tag'),
		//'rewrite' => array( 'slug' => 'ccgs-world' )
	);
	register_post_type( 'notice', $args );

	// Old Boys Newsletter
	$labels = array(
		'name' => _x('Old Boys Newsletter', 'post type general name'),
		'singular_name' => _x('News', 'post type singular name'),
		'add_new' => _x('Add New', 'News'),
		'add_new_item' => __('Add New News Item'),
		'edit_item' => __('Edit News Item'),
		'new_item' => __('New News Item'),
		'view_item' => __('View News Item'),
		'search_items' => __('Search News'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash')
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'menu_position' => 4,
		'has_archive' => 'true', // Activate the archive
		'supports' => array('title','editor','thumbnail','page-attributes','excerpt'),
		'taxonomies' => array('category', 'post_tag'), // this is IMPORTANT
		//'rewrite' => array( 'slug' => 'ccgs-world' )
	);
	register_post_type( 'ob-newsletter', $args );

	add_action( 'wp_insert_post', 'du_wp_insert_post', 10, 2 );

    add_action('init', 'add_my_rule');

    global $wp;
	$wp->add_query_var('args');

	add_rewrite_rule('category\/ccgs-world\/archives\/(.*)','index.php?pagename=archives&args=$matches[1]', 'top');
	add_rewrite_rule('category\/ccgs-world\/archives','index.php?pagename=archives-index', 'top');
}
add_action( 'init', 'du_init_theme' );

// Helper functions
function pre ( $data ) {
	echo '<pre>' . print_r( $data, true ) . '</pre>';
}


// Before template redirect occurs, setup the $theme_type global
/*
function du_template_redirect () {
	global $theme_type;

	$theme_type = 'about';

	if(!is_search()) {
		$about 	= get_page_by_path( 'about-us', 'page' );
		$education 	= get_page_by_path( 'education', 'page' );
		$business 	= get_page_by_path( 'business', 'page' );
		$staff 	= get_page_by_path( 'staff', 'page' );

		if( is_child_of( $about->ID, get_the_ID() ) || get_the_ID() == $about->ID )
			$theme_type = 'about';
		elseif( is_child_of( $education->ID, get_the_ID() ) || get_the_ID() == $education->ID )
			$theme_type = 'education';
		elseif( is_child_of( $business->ID, get_the_ID() ) || get_the_ID() == $business->ID )
			$theme_type = 'business';
		elseif( is_child_of( $staff->ID, get_the_ID() ) || get_the_ID() == $staff->ID )
			$theme_type = 'staff';
		else
			$theme_type = 'about';
	}
}*/
//add_action( 'template_redirect', 'du_template_redirect' );

function is_child_of ( $parent_id, $post_id = NULL ) {
	global $post;

	if( is_null( $post_id ) ) $post_id = $post->ID;

	if( $ancestors = get_post_ancestors( $post_id ) ) {
		if( array_search( $parent_id, $ancestors ) !== false ) {
			return true;
		}
	}

	return false;
}
/*
//if (class_exists('MultiPostThumbnails')) {
	//new MultiPostThumbnails(
		array(
			'label' => 'Featured Image 1',
			'id' => 'featuredimage1',
			'post_type' => 'page'
		)
	);
	//new MultiPostThumbnails(
		array(
			'label' => 'Featured Image 2',
			'id' => 'featuredimage2',
			'post_type' => 'page'
		)
	);
	//new MultiPostThumbnails(
		array(
			'label' => 'Side Image 1',
			'id' => 'sideimage1',
			'post_type' => 'page'
		)
	);
	//new MultiPostThumbnails(
		array(
			'label' => 'Side Image 2',
			'id' => 'sideimage2',
			'post_type' => 'page'
		)
	);
	//new MultiPostThumbnails(
		array(
			'label' => 'Featured Image 1',
			'id' => 'newsimage1',
			'post_type' => 'post'
		)
	);
	//new MultiPostThumbnails(
		array(
			'label' => 'Featured Image 2',
			'id' => 'newsimage2',
			'post_type' => 'post'
		)
	);
	//new MultiPostThumbnails(
		array(
			'label' => 'Featured Image 1',
			'id' => 'newsimage1',
			'post_type' => 'news'
		)
	);
	//new MultiPostThumbnails(
		array(
			'label' => 'Featured Image 1',
			'id' => 'newsimage1',
			'post_type' => 'ob-newsletter'
		)
	);
	//new MultiPostThumbnails(
		array(
			'label' => 'Featured Image 2',
			'id' => 'newsimage2',
			'post_type' => 'ob-newsletter'
		)
	);
}*/
//add_theme_support('post-thumbnails');
//if ( function_exists( 'add_image_size' ) ) {
/*
  //add_image_size( 'innerbannerleft', 480, 320, true);
  //add_image_size( 'featuredimage1', 251, 194, true);
  //add_image_size( 'featuredimage2', 792, 194, true);

  //add_image_size( 'newsimage1_featured_thumb', 121, 118, true);
  //add_image_size( 'newsimage1_featured_thumb2', 125, 125, true);
  //add_image_size( 'newsimage1_post', 257, 141, true);
  //add_image_size( 'newsimage1_post2', 174, 113, true);
  //add_image_size( 'newsimage1_post_lg', 270, 180, true);
  //add_image_size( 'newsimage1_post_long', 518, 113, true);
  //add_image_size( 'newsimage1_side_sm', 68, 50, true);
  //add_image_size( 'newsimage1_side_lg', 252, 94, true);
  //add_image_size( 'newsimage1_footer', 122, 71, true);
*/
//}

function du_search_filter( $query ) {
	if($query->is_search && !is_admin()) {
		if (isset($_GET['type']) && $_GET['type'] == 'calendar'){
			$query->set( 'post_type', array('ai1ec_event') );
		}else{
			$query->set( 'post_type', array('post','page') );
		}

	}
	return $query;
}
add_filter('pre_get_posts', 'du_search_filter');

function my_class_names($classes) {
	global $post;
	if(is_page('search')) {
		$classes[] = 'search-results';
	//} else if(is_page('old-boys-newsletter')) {
		//$classes[] = 'newsletter';
	} else if(is_page('old-boys-association')) {
		$classes[] = '';
	} else if (is_page_template('template-ob-newsletter.php')) {
		$classes[] = 'newsletter';
	} else if(get_post_type($post) == 'ai1ec_event') {
		$classes[] = 'newsletter';
	} else if(is_front_page() || is_page_template('template-homepage2.php')) {
		$classes[] = 'home';
	} else {
		$classes[] = 'inner';
	}

	$path=$_SERVER['REQUEST_URI'];

	$path_array = explode('/', $path);

	$class_path = 'section';
	foreach($path_array as $section) {
	  if ($section != '') {
    	$class_path .= '-' . $section;
    	$classes[] = $class_path;
    }
	}

	return $classes;
}
add_filter('body_class','my_class_names');

function get_featured_ids($category_id = 0, $post_type = 'post') {
	$featured_IDs = array();

	$post_args = array(
		'posts_per_page'	=> -1,
		'category'			=> $category_id,
		'post_type'			=> $post_type,
		'meta_key'         => 'featured',
		'meta_value'       => 'yes'
	);
	$posts_array = get_posts($post_args);

	if(count($posts_array) > 0):
		foreach($posts_array as $post):
			$featured_IDs[] = $post->ID;
		endforeach;
	endif;

	return $featured_IDs;
}

// Replace Posts label as Articles in Admin Panel

function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = 'News';
    $submenu['edit.php'][10][0] = 'Add News';
    echo '';
}
function change_post_object_label() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'News';
        $labels->singular_name = 'News';
        $labels->add_new = 'Add News';
        $labels->add_new_item = 'Add News';
        $labels->edit_item = 'Edit News';
        $labels->new_item = 'News';
        $labels->view_item = 'View News';
        $labels->search_items = 'Search News';
        $labels->not_found = 'No News found';
        $labels->not_found_in_trash = 'No News found in Trash';
}
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );

/*
 * Remove themes sub menu
 */
function du_admin_init() {
	remove_submenu_page( 'edit.php?post_type=ai1ec_event', 'all-in-one-event-calendar-themes' );
	remove_menu_page('crop-from-top');

	add_meta_box( 'ccgs_news', 'Featured Settings', 'du_metabox_ccgs_news', 'news', 'side' );

	$post_id = isset($_GET['post']) ? $_GET['post'] : isset($_POST['post_ID']) ;
	if( get_post_meta( $post_id, '_wp_page_template', true) == 'template-ob-newsletter.php' ) {
	    add_meta_box( 'page', 'Archive Tags', 'du_metabox_archive_tags', 'page', 'side' );
    }

	register_setting( 'du_ccgsoptions_options', 'du_ccgs', 'du_ccgsoptions_validate' );
}
add_action('admin_init', 'du_admin_init');

function du_metabox_ccgs_news( $post ) {
	$post_layouts = array('twoCol'=>'Two Columns', 'full'=>'Full Width', 'image'=>'Image Only');
	$post_layout = get_post_meta($post->ID, 'du_post_layout', true);

	$post_types = array('post'=>'Post', 'image'=>'Image');
	$post_type = get_post_meta($post->ID, 'du_post_type', true);
	?>
	<p>
	Layout Option:
	<select name="du_post_layout">
		<option value="">Select...</option>
		<?php
		foreach($post_layouts as $key => $layout) :
			$selected = '';
			if($post_layout == $key) $selected = ' selected';
		?>
		<option value="<?php echo $key; ?>"<?php echo $selected; ?>><?php echo $layout; ?></option>
		<?php endforeach; ?>
	</select>
	</p>
	<?php
}

function du_metabox_archive_tags( $post ) {
	?>
	Enter the tag of the news items to display.
	<input type="text" name="du_archive_tags" value="<?php echo get_post_meta($post->ID, 'du_archive_tags', true); ?>" />
	<?php
}

// Handler for saving all du_ prefixed post meta
function du_wp_insert_post ( $post_id, $post ) {

	if( $post->post_type == 'news' || $post->post_type == 'page' ) {
		// Loop through all keys in the POST array, if a key starts with "du_"
		// save it as post meta. Keys named this way do not need any special logic to save correctly
		// and can be used to save keys for any post type
		foreach( $_POST as $key => $value ) {
			if( strpos( $key, 'du_' ) === 0 )
				update_post_meta( $post_id, $key, $value );
		}
	}

}

add_filter('post_gallery', 'du_post_gallery', 10, 2);
function du_post_gallery($output, $attr) {
	static $instance = 0;
	$instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => isset($post->ID),
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 3,
        'size'       => 'newsimage1_post',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
            return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $icontag = tag_escape($icontag);
    $valid_tags = wp_kses_allowed_html( 'post' );
    if ( ! isset( $valid_tags[ $itemtag ] ) )
        $itemtag = 'dl';
    if ( ! isset( $valid_tags[ $captiontag ] ) )
        $captiontag = 'dd';
    if ( ! isset( $valid_tags[ $icontag ] ) )
        $icontag = 'dt';

    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $gallery_style = $gallery_div = '';
    if ( apply_filters( 'use_default_gallery_style', true ) )
        $gallery_style = "
            <style type='text/css'>
                #{$selector} {
                    margin: auto;
                }
                #{$selector} .gallery-item {
                    float: {$float};
                    text-align: center;
                }
                #{$selector} img {
                }
                #{$selector} .gallery-caption {
                    margin-left: 0;
                }
            </style>
            <!-- see gallery_shortcode() in wp-includes/media.php -->";
    $size_class = sanitize_html_class( $size );
    $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
    $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

    $i = 0;
	$counter = 0;
	$galleryID = $id;
    foreach ( $attachments as $id => $attachment ) {
		$counter++;
        //$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

        $output .= "<{$itemtag} class='gallery-item gallery-item-{$counter}'>";
        $output .= "
            <{$icontag} class='gallery-icon'>";
		$fileSrc = wp_get_attachment_url( $id );
		$output .= "<a href=\"{$fileSrc}\" data-fancybox=\"gallery\"  rel=\"lightbox[gallery-{$galleryID}]\">";
		$output .= wp_get_attachment_image( $id, $size );
		$output .= "<p><img src=\"" . get_bloginfo( 'template_directory', 'raw' ) . "/assets/img/gallery.png\"></p></a>";
            $output .= "</{$icontag}>";
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= "
                <{$captiontag} class='wp-caption-text gallery-caption'>
                    " . wptexturize($attachment->post_excerpt) . "
                </{$captiontag}>";
        }

        $output .= "</{$itemtag}>";
        if ( $columns > 0 && ++$i % $columns == 0 )
            $output .= '<br style="clear: both" />';
    }

    $output .= "
        <br style='clear: both;' />
        </div>\n";

    return $output;
}
/*
function add_upload_mime_types( $mimes ) {
	if ( function_exists( 'current_user_can' ) )
		$unfiltered = $user ? user_can( $user, 'unfiltered_html' ) : current_user_can( 'unfiltered_html' );
	if ( !empty( $unfiltered ) ) {
		$mimes['swf'] = 'application/x-shockwave-flash';
	}
	return $mimes;
}*/
//add_filter( 'upload_mimes', 'add_upload_mime_types' );

// get the week number, defaults to todays date or accepts date string
function week_number($date_ymd = null) {
	if(is_null($date_ymd)) {
		$week_number = date("W");
	} else {
		$week_number = date("W", strtotime($date_ymd));
	}

	return $week_number;
}

function week_start_end_dates($week, $year) {
	// Adding leading zeros for weeks 1 - 9.
	$date_string = $year . 'W' . sprintf('%02d', $week);
	$return[0] = date('Y-m-d', strtotime($date_string));
	$return[1] = date('Y-m-d', strtotime($date_string . '7'));

	return $return;
}

function du_filter_where($where = '') {
	if(is_category( 'ccgs-world' )) {
		// get week
		$week_number = week_number();
		$date_range = week_start_end_dates($week_number, date('Y'));
		//get week date range
		//$where .= " AND wp_posts.post_date >= '{$date_range[0]}' AND wp_posts.post_date < '{$date_range[1]}'";
	}

	return $where;
}
//add_filter( 'posts_where', 'du_filter_where' );

function du_admin_menu() {
	add_submenu_page( 'edit.php?post_type=news', 'Configuration', 'Configuration', 'edit_pages', 'configuration', 'du_ccgs_configuration' );
}
add_action( 'admin_menu', 'du_admin_menu' );

// Draw the menu page itself
function du_ccgs_configuration() {
	?>
	<div class="wrap">
		<h2>CCGS World Options</h2>
		<form method="post" action="options.php">
			<?php settings_fields('du_ccgsoptions_options'); ?>
			<?php $options = get_option('du_ccgs'); ?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">CCGS World Edition week tag</th>
					<td><input type="text" name="du_ccgs[week_tag]" value="<?php echo $options['week_tag']; ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row">CCGS World Edition next edition date</th>
					<td><input type="text" name="du_ccgs[next_date]" value="<?php echo $options['next_date']; ?>" /></td>
				</tr>
				<hr />
				<tr valign="top">
					<th scope="row">Calendar button text</th>
					<td><input type="text" name="du_ccgs[cal_btn_text]" value="<?php echo $options['cal_btn_text']; ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row">Calendar button link</th>
					<td><input type="text" name="du_ccgs[cal_btn_link]" value="<?php echo $options['cal_btn_link']; ?>" /></td>
				</tr>
			</table>
			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
	</div>
	<?php
}

// Sanitize and validate input. Accepts an array, return a sanitized array.
function du_ccgsoptions_validate($input) {
	$input['week_tag'] =  wp_filter_nohtml_kses($input['week_tag']);
	$input['date'] =  wp_filter_nohtml_kses($input['date']);
	$input['next_date'] =  wp_filter_nohtml_kses($input['next_date']);
	$input['cal_btn_text'] =  wp_filter_nohtml_kses($input['cal_btn_text']);
	$input['cal_btn_link'] =  wp_filter_nohtml_kses($input['cal_btn_link']);

	return $input;
}

function remove_more_anchor($link) {
     $offset = strpos($link, '#more-');
     if ($offset) {
          $end = strpos($link, '"',$offset);
     }
     if ($end) {
          $link = substr_replace($link, '', $offset, $end-$offset);
     }
     return $link;
}
add_filter('the_content_more_link', 'remove_more_anchor');

add_filter('gform_notification', 'change_user_notification_attachments', 10, 3);
function change_user_notification_attachments( $notification, $form, $entry ) {

    //There is no concept of user notifications anymore, so we will need to target notifications based on other criteria, such as name
    if($notification["name"] == "Online employment application"){

        $fileupload_fields = GFCommon::get_fields_by_type($form, array("fileupload"));

        if(!is_array($fileupload_fields))
            return $notification;

        $attachments = array();
        $upload_root = RGFormsModel::get_upload_root();
        foreach($fileupload_fields as $field){
            $url = $entry[$field["id"]];
            $attachment = preg_replace('|^(.*?)/gravity_forms/|', $upload_root, $url);
            if($attachment){
                $attachments[] = $attachment;
            }
        }

        $notification["attachments"] = $attachments;

    }

    return $notification;
}
/*
function my_scripts_method() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'slideshow', get_template_directory_uri() . '/assets/js/vendor/jquery.bxslider/jquery.bxslider.js');
    wp_enqueue_script( 'custom', get_template_directory_uri() . '/assets/js/vendor/jquery.main.js');
}
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
*/
function new_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');


/*
DU Post Subtitle
*/
/*
function post_title_init()
{
	//wp_enqueue_script( 'jquery-watermark', get_template_directory_uri() . '/assets/js/vendor/jquery.watermark.min.js');
	//wp_enqueue_script( 'jquery-watermark' );

	add_meta_box( 'post-subtitle', 'Subtitle', 'edit_page_subtitle', 'page', 'advanced', 'core' );
	add_meta_box( 'post-subtitle', 'Subtitle', 'edit_page_subtitle', 'post', 'advanced', 'core' );
	add_meta_box( 'post-subtitle', 'Subtitle', 'edit_page_subtitle', 'news', 'advanced', 'core' );

	wp_enqueue_style( 'du-admin-style.css', get_template_directory_uri() . '/assets/css/du-admin-style.css');
}*/
//add_action( 'admin_init', 'post_title_init' );
/*
function edit_page_subtitle( $post )
{
	?>
    <input type="text" style="width:100%;" name="post_subtitle" value="<?php echo is_array($post) ? get_post_meta( $post->ID, 'post_subtitle', true ) : ''; ?>" />
    <?php
}*/
/*
function post_subtitle( $post_id )
{
	global $post;

	if( $post->post_type == 'page' || $post->post_type == 'post' || $post->post_type == 'news' )
	update_post_meta( $post_id, 'post_subtitle', $_POST[ 'post_subtitle' ] );
}*/
//add_action( 'wp_insert_post', 'post_subtitle', 10, 2 );

function the_subtitle( $post_id = NULL )
{
	echo get_the_subtitle( $post_id );
}

function get_the_subtitle( $post_id = NULL )
{
	$post_id = apply_filters( 'sanitize_id', $post_id );
	//return get_post_meta( $post_id, 'post_subtitle', true );
	return get_field('post_subtitle');
}

function du_sanitize_id( $post_id = NULL )
{
	global $post;

	if( !$post_id )
		return $post->ID;
	else
		return $post_id;
}
add_filter( 'sanitize_id', 'du_sanitize_id', 10, 1 );
/*
function move_meta_box()
{
	?>
    <script type="text/javascript">

		jQuery( document ).ready( function() {

			var subtitle_box = jQuery( "#post-subtitle" ).find( "input" );

			jQuery( "#titlewrap" ).append( subtitle_box )
			subtitle_box.watermark( "Post subtitle..." );
			subtitle_box.attr( "id", "title" );

			jQuery( "#post-subtitle" ).remove();

		});

	</script>

    <style type="text/css">

		#post-subtitle { display:none; }

	</style>
    <?php
}*/
//add_action( 'admin_head', 'move_meta_box' );



/*
DU Post Meta Searcher
*/
/*
function modify_wp_search_where( $where )
{
	if( is_search() ) {

		global $wpdb, $wp;

		$where = preg_replace(
			"/(wp_posts.post_title (LIKE '%{$wp->query_vars['s']}%'))/i",
			"$0 OR ( $wpdb->postmeta.meta_value LIKE '%{$wp->query_vars['s']}%' )",
			$where
			);

		add_filter( 'posts_join_request', 'modify_wp_search_join' );
		add_filter( 'posts_distinct_request', 'modify_wp_search_distinct' );
	}
	return $where;

}*/
//add_action( 'posts_where_request', 'modify_wp_search_where' );
/*
function modify_wp_search_join( $join )
{
	global $wpdb;
	return $join .= " LEFT JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id) ";
}

function modify_wp_search_distinct( $distinct )
{
	return 'DISTINCT';
}

*/



/*
DU Search Ajax
*/

// enqueue and localise scripts
//wp_enqueue_script( 'du-search-results', plugin_dir_url( __FILE__ ) . 'ajax.js', array( 'jquery' ) );
//wp_localize_script( 'du-search-results', 'du_search_results', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
// THE AJAX ADD ACTIONS
add_action( 'wp_ajax_du_search_results', 'du_search_results' );
add_action( 'wp_ajax_nopriv_du_search_results', 'du_search_results' ); // need this to serve non logged in users


// THE FUNCTION
function du_search_results(){

  // never trust what user wrote! We must ALWAYS sanitize user input
  $word = mysql_real_escape_string($_POST['search']);
  $word = htmlentities($word);
	$needle = strtolower($word);
	$needles = 0; // start counter of results

  $output = '<div class="search-results">';

  	// query for the events
  	global $ai1ec_calendar_helper;
  	global $ai1ec_events_helper;

  	// Get localized time
  	$timestamp = time();
  	$start = mktime(0, 0, 0, date('m'), date('d'), (date('Y')-1));
  	$end = mktime(23, 59, 59, date('m'), date('d'), (date('Y')+1));

  	// Set $limit to the specified category/tag
  	$limit = array(
  		'cat_ids'   => '',
  		'tag_ids'   => '',
  		'post_ids'  => '$word',
  	);

  	// Get events, then classify into date array
  	//$event_results = $ai1ec_calendar_helper->get_events_relative_to( $timestamp, $events_per_page, 0, $limit );
  	$event_results = $ai1ec_calendar_helper->get_events_between( $start, $end, $limit, true );

  	if( ! $event_results ) {

  		$output .= '<ul>';
  			$output .= '<li>' . _e( 'There are no matching events.', AI1EC_PLUGIN_NAME ) . '</li>';
  		$output .= '</ul>';

    }
    else {

  		$output .= '<ul>';
  			foreach( $event_results as $event ) {

  				$event_search_title = esc_html( apply_filters( 'the_title', mb_strimwidth( $event->post->post_title, 0, 100, '...' ), $event->post_id ) );
  				$haystack = strtolower($event_search_title);
  				if ( (strpos($haystack, $needle)) !== FALSE ){
  					$needles = $needles+1;

  					$output .= '<li>';
  					  $allday = '';
  					  if( $event->allday ) $allday = ' ai1ec-allday';
  						$output .= '<div class="ai1ec-event ai1ec-event-id-' . $event->post_id . ' ai1ec-event-instance-id-' . $event->instance_id . $allday . '">';

                $output .= '<span class="ai1ec-popup-title popover-title">';

									$output .= esc_html( apply_filters( 'the_title', mb_strimwidth( $event->post->post_title, 0, 100, '...' ), $event->post_id ) );
									if ( $show_location_in_title && isset( $event->venue ) && $event->venue != '' ) {
										$output .= '<span class="ai1ec-event-location">' . esc_html( sprintf( __( '@ %s', AI1EC_PLUGIN_NAME ), $event->venue ) ) . '</span>';
									}
								$output .= '</span>';

                $time = $event->get_short_start_time();

								$output .= '<div class="calendar-popup">' . $event->get_short_start_date();
								if ($time != '12:00 am') $output .= ' - '.$time . '</div>';
								$location = $event->get_location();
								if ($location != '') {
								  $output .= '<div class="calendar-popup">at ' . $location . '</div>';
								}

  							if ( $show_subscribe_buttons == $show_subscribe_buttons ) {
									$url_args = '&ai1ec_post_ids=' . $event->post_id;
  								$output .= '<div class="calendar-popup">';
  									$output .= '<a data-placement="bottom" href="' . AI1EC_EXPORT_URL . $url_args . '" title="Subscribe to this calendar in your personal calendar (iCal, Outlook, etc.)">';

  										if ( $is_filtered ) {
  											$output .= '<img src="' . content_url() . '/themes/christchurch/assets/img/button-calendar-subscribe.png" />';
  										}
  										else {
  											$output .= '<img src="' . content_url() . '/themes/christchurch/assets/img/button-calendar-subscribe.png" />';
  										}
  									$output .= '</a>';
  									$output .= '<a target="_blank"';
  										$output .= 'data-placement="bottom"';
  										$output .= 'href="http://www.google.com/calendar/render?cid=' . urlencode( str_replace( 'webcal://', 'http://', AI1EC_EXPORT_URL ) . $url_args ) . '"';
  										$output .= 'title="Subscribe to this calendar in your Google Calendar" >';
  										$output .= '<img src="' . content_url() . '/themes/christchurch/assets/img/button-calendar-add-to-google.png' . '" />';
  									$output .= '</a>';
  								$output .= '</div>';
  							}
  						$output .= '</div>';
  					$output .= '</li>';
  				}
  			}

  			if ($needles == 0) {echo '<span class="search-empty">There are no matching events</span>';}

  		$output .= '</ul>';

  	}
  $output .= '</div>';

  die($output);// wordpress may print out a spurious zero without this - can be particularly bad if using json
}
