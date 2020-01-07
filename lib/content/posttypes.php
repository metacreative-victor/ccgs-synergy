<?php
// Custom Post Types
// Use online generator: https://generatewp.com/post-type/

//Online Payments

add_action( 'init', 'cptui_register_my_taxes_payment_year' );
function cptui_register_my_taxes_payment_year() {
	$labels = array(
		"name" => __( 'Years', '' ),
		"singular_name" => __( 'Year', '' ),
		);

	$args = array(
		"label" => __( 'Years', '' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Years",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'online-payments/year', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "payment_year", array( "online_payments" ), $args );

// End cptui_register_my_taxes_payment_year()
}

add_action( 'init', 'cptui_register_my_taxes_payment_type' );
function cptui_register_my_taxes_payment_type() {
	$labels = array(
		"name" => __( 'Types', '' ),
		"singular_name" => __( 'Type', '' ),
		);

	$args = array(
		"label" => __( 'Types', '' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Types",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'online-payments/type', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "payment_type", array( "online_payments" ), $args );

// End cptui_register_my_taxes_payment_type()
}

add_action( 'init', 'cptui_register_my_cpts_online_payments' );
function cptui_register_my_cpts_online_payments() {
	$labels = array(
		"name" => __( 'Online Payments', '' ),
		"singular_name" => __( 'Online Payment', '' ),
		);

	$args = array(
		"label" => __( 'Online Payments', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "online-payments", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-tickets-alt",
		"supports" => array( "title", "editor", "thumbnail", "excerpt", "revisions" ),					);
	register_post_type( "online_payments", $args );

// End of cptui_register_my_cpts_online_payments()
}

add_action( 'init', 'cptui_register_my_cpts_careers' );
function cptui_register_my_cpts_careers() {
	$labels = array(
		"name" => __( 'Careers', '' ),
		"singular_name" => __( 'Careers', '' ),
		);

	$args = array(
		"label" => __( 'Careers', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "_careers", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-exerpt-view",
		"supports" => array( "title", "editor", "thumbnail", "excerpt", "revisions" ),					);
	register_post_type( "careers", $args );

// End of cptui_register_my_cpts_online_payments()
}

add_action( 'init', 'sen_register_post_type' );
function sen_register_post_type() {
	register_post_type( 'bgm-post', array(
		'label' => __('BGM Posts', 'sen'),
		'public' => true,
		'labels' => array(
			'name' => __('BGM Posts', 'sen'),
			'singular_name' => __('BGM Posts', 'sen'),
			'add_new' => __('Add Post', 'sen'),
			'add_new_item' => __('Add Post', 'sen'),
			'edit_item' => __('Edit Post', 'sen'),
			'new_item' => __('New Post', 'sen'),
			'view_item' => __('View Post', 'sen'),
			'search_items' => __('Search Post', 'sen'),
			'not_found' =>  __('Not found Post', 'sen'),
			'not_found_in_trash' => __('Not found Posts in trash', 'sen')
		),
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => array('slug' => 'bgm','with_front' => false),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-admin-post',
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'taxonomies' => array('bgm-tags'),
	));
}

add_action( 'init', 'sen_register_taxonomy' );
function sen_register_taxonomy() {
	// BGM Categories
	register_taxonomy( 'bgm-category', 'bgm-post', array(
		'labels' => array(
			'name' => 'BGM Categories',
			'singular_name' => 'BGM Categories',
			'menu_name' => 'Categories',
			'search_items' => 'Search Categories',
			'all_items' => 'All Categories',
			'edit_item' => 'Edit Category',
			'update_item' => 'Update Category',
			'add_new_item' => 'Add New Category'
		),
		'label' => 'BGM Categories',
		'query_var' => true,
		'show_ui' => true,
		'public' => false,
		'rewrite' => array( 'slug' => 'bgm-category' ),
		'hierarchical' => true,
		//'taxonomies' => array('post_tag'),
	));

	// Tags
	register_taxonomy( 'bgm-tags', 'bgm-post', array(
		'labels' => array(
			'name' => 'BGM Tags',
			'singular_name' => 'BGM Tags',
			'menu_name' => 'Tags',
			'search_items' => 'Search Tags',
			'all_items' => 'All Tags',
			'edit_item' => 'Edit Tag',
			'update_item' => 'Update Tag',
			'add_new_item' => 'Add New Tag'
		),
		'label' => 'BGM Tags',
		'query_var' => true,
		'show_ui' => true,
		'public' => true,
		'rewrite' => array( 'slug' => 'bgm-tags' ),
		'hierarchical' => true,
		'has_archive' => true,
		//'taxonomies' => array('post_tag'),
	));
}
?>
