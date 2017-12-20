<?php
	function instructor_post_type() {

	$labels = array(
		'name'                  => _x( 'Instructors', 'Post Type General Name', 'proclass-instructor-import' ),
		'singular_name'         => _x( 'Instructor', 'Post Type Singular Name', 'proclass-instructor-import' ),
		'menu_name'             => __( 'Instructors', 'proclass-instructor-import' ),
		'name_admin_bar'        => __( 'Instructors', 'proclass-instructor-import' ),
		'archives'              => __( 'Instructor Archives', 'proclass-instructor-import' ),
		'attributes'            => __( 'Instructor Attributes', 'proclass-instructor-import' ),
		'parent_item_colon'     => __( 'Parent Instructor:', 'proclass-instructor-import' ),
		'all_items'             => __( 'All Instructors', 'proclass-instructor-import' ),
		'add_new_item'          => __( 'Add New Instructor', 'proclass-instructor-import' ),
		'add_new'               => __( 'Add New', 'proclass-instructor-import' ),
		'new_item'              => __( 'New Instructor', 'proclass-instructor-import' ),
		'edit_item'             => __( 'Edit Instructor', 'proclass-instructor-import' ),
		'update_item'           => __( 'Update Instructor', 'proclass-instructor-import' ),
		'view_item'             => __( 'View Instructor', 'proclass-instructor-import' ),
		'view_items'            => __( 'View Instructors', 'proclass-instructor-import' ),
		'search_items'          => __( 'Search Instructor', 'proclass-instructor-import' ),
		'not_found'             => __( 'Not found', 'proclass-instructor-import' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'proclass-instructor-import' ),
		'featured_image'        => __( 'Featured Image', 'proclass-instructor-import' ),
		'set_featured_image'    => __( 'Set featured image', 'proclass-instructor-import' ),
		'remove_featured_image' => __( 'Remove featured image', 'proclass-instructor-import' ),
		'use_featured_image'    => __( 'Use as featured image', 'proclass-instructor-import' ),
		'insert_into_item'      => __( 'Insert into Instructor', 'proclass-instructor-import' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Instructor', 'proclass-instructor-import' ),
		'items_list'            => __( 'Instructors list', 'proclass-instructor-import' ),
		'items_list_navigation' => __( 'Instructors list navigation', 'proclass-instructor-import' ),
		'filter_items_list'     => __( 'Filter Instructors list', 'proclass-instructor-import' ),
	);
	$args = array(
		'label'                 => __( 'Instructor', 'proclass-instructor-import' ),
		'description'           => __( 'The Custom Post Type for Instructors', 'proclass-instructor-import' ),
		'labels'                => $labels,
		'supports'              => array( ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'instructor', $args );

}
add_action( 'init', 'instructor_post_type', 0 );