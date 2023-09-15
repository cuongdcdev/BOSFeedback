<?php 
function bos_feedback_post()  {
	$labels = [
		'name' => _x( 'Bos Feedback', 'Post Type General Name', 'bosfb' ),
		'singular_name' => _x( 'Bos Feedback', 'Post Type Singular Name', 'bosfb' ),
		'menu_name' => __( 'Bos Feedback', 'bosfb' ),
		'name_admin_bar' => __( 'Bos Feedback', 'bosfb' ),
		'archives' => __( 'Bos Feedback Archives', 'bosfb' ),
		'attributes' => __( 'Bos Feedback Attributes', 'bosfb' ),
		'parent_item_colon' => __( 'Parent Bos Feedback:', 'bosfb' ),
		'all_items' => __( 'All Bos Feedback', 'bosfb' ),
		'add_new_item' => __( 'Add New Bos Feedback', 'bosfb' ),
		'add_new' => __( 'Add New', 'bosfb' ),
		'new_item' => __( 'New Bos Feedback', 'bosfb' ),
		'edit_item' => __( 'Edit Bos Feedback', 'bosfb' ),
		'update_item' => __( 'Update Bos Feedback', 'bosfb' ),
		'view_item' => __( 'View Bos Feedback', 'bosfb' ),
		'view_items' => __( 'View Bos Feedback', 'bosfb' ),
		'search_items' => __( 'Search Bos Feedback', 'bosfb' ),
		'not_found' => __( 'Bos Feedback Not Found', 'bosfb' ),
		'not_found_in_trash' => __( 'Bos Feedback Not Found in Trash', 'bosfb' ),
		'featured_image' => __( 'Featured Image', 'bosfb' ),
		'set_featured_image' => __( 'Set Featured Image', 'bosfb' ),
		'remove_featured_image' => __( 'Remove Featured Image', 'bosfb' ),
		'use_featured_image' => __( 'Use as Featured Image', 'bosfb' ),
		'insert_into_item' => __( 'Insert into Bos Feedback', 'bosfb' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Bos Feedback', 'bosfb' ),
		'items_list' => __( 'Bos Feedback List', 'bosfb' ),
		'items_list_navigation' => __( 'Bos Feedback List Navigation', 'bosfb' ),
		'filter_items_list' => __( 'Filter Bos Feedback List', 'bosfb' ),
	];
	$labels = apply_filters( 'bos_fb-labels', $labels );

	$args = [
		'label' => __( 'Bos Feedback', 'bosfb' ),
		'description' => __( 'BOS feedback', 'bosfb' ),
		'labels' => $labels,
		'supports' => [
			'title',
			'editor',
		],
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 2,
		'menu_icon' => 'dashicons-format-status',
        'taxonomies' => [
			'bos_cat',
		],
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'exclude_from_search' => false,
		'has_archive' => false,
		'can_export' => false,
		'rewrite' => false,
		'capability_type' => 'page',
		'show_in_rest' => true,
	];
	$args = apply_filters( 'bos_fb-args', $args );

	register_post_type( 'bos_fb', $args );
}

function bos_fb_taxonomy() {
	$labels = [
		'name' => _x( 'Projects', 'Taxonomy Name', 'bos' ),
		'singular_name' => _x( 'Category', 'Ta  my Singular Name', 'bos' ),
		'menu_name' => __( 'Projects ', 'bos' ),
		'all_items' => __( 'All Projects ', 'bos' ),
		'parent_item' => __( 'Parent Category ', 'bos' ),
		'parent_item_colon' => __( 'Parent Category: ', 'bos' ),
		'new_item_name' => __( 'New Project ', 'bos' ),
		'add_new_item' => __( 'Add New Project ', 'bos' ),
		'edit_item' => __( 'Edit Category ', 'bos' ),
		'update_item' => __( 'Update Category ', 'bos' ),
		'view_item' => __( 'View Category ', 'bos' ),
		'add_or_remove_items' => __( 'Add or Remove Projects ', 'bos' ),
		'choose_from_most_used' => __( 'Choose from most used Projects ', 'bos' ),
		'popular_items' => __( 'Popular Projects ', 'bos' ),
		'search_items' => __( 'Search Projects ', 'bos' ),
		'not_found' => __( 'Not Found ', 'bos' ),
		'no_terms' => __( 'No Projects ', 'bos' ),
		'items_list' => __( 'Projects List ', 'bos' ),
		'items_list_navigation' => __( 'Projects List Navigation ', 'bos' ),
	];

	$args = [
		'labels' => $labels,
		'hierarchical' => false,
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_rest' => true,
		'rest_base' => 'bos_fb_tax',
		'rest_controller_class' => 'WP_REST_bos_fb_tax_Terms_Controller',
	];

	register_taxonomy( 'bos_fb_tax', ['bos_fb'], $args );
}


add_action( 'init', function(){
    bos_feedback_post();
    bos_fb_taxonomy();
}, 0 );


