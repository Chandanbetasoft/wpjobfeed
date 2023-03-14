<?php
/**
 * Registers the post types associated with the plugin.
 *
 * @package WP_Jobfeed
 */

/**
 * Registers the jobs post type with WordPress.
 */
function wpjf_register_job_post_type() {

	// register the jobs post type.
	register_post_type(
		wpjf_job_post_type_name(),
		array(
			'labels'        => array(
				'name'               => _x( 'Jobs', 'post type general name', 'wpjobfeed' ),
				'singular_name'      => _x( 'Job', 'post type singular name', 'wpjobfeed' ),
				'add_new'            => _x( 'Add New', 'Job', 'wpjobfeed' ),
				'add_new_item'       => __( 'Add New Job', 'wpjobfeed' ),
				'edit_item'          => __( 'Edit Job', 'wpjobfeed' ),
				'new_item'           => __( 'New Job', 'wpjobfeed' ),
				'view_item'          => __( 'View Job', 'wpjobfeed' ),
				'search_items'       => __( 'Search Jobs', 'wpjobfeed' ),
				'not_found'          => __( 'No Jobs found', 'wpjobfeed' ),
				'not_found_in_trash' => __( 'No Jobs found in Trash', 'wpjobfeed' ),
				'parent_item_colon'  => '',
				'menu_name'          => __( 'Jobs', 'wpjobfeed' ),
			),
			'public'        => true,
			'menu_position' => 95,
			'supports'      => array(
				'title',
				'editor',
				'excerpt',
				'author',
			),
			'query_var'     => true,
			'rewrite'       => array(
				'slug'       => 'Jobfeed',
				'with_front' => false,
			),
			'has_archive'   => true,
			'show_in_menu'  => 'WP_Jobfeed_home', // shows the post type below wp Jobfeed home
			'show_in_rest'  => true,
		)
	);

	// register the application post type.
	register_post_type(
		'wpjf_application',
		array(
			'labels'        => array(
				'name'               => _x( 'Applications', 'post type general name', 'wpjobfeed' ),
				'singular_name'      => _x( 'Application', 'post type singular name', 'wpjobfeed' ),
				'add_new'            => _x( 'Add New', 'Application', 'wpjobfeed' ),
				'add_new_item'       => __( 'Add New Application', 'wpjobfeed' ),
				'edit_item'          => __( 'Edit Application', 'wpjobfeed' ),
				'new_item'           => __( 'New Application', 'wpjobfeed' ),
				'view_item'          => __( 'View Application', 'wpjobfeed' ),
				'search_items'       => __( 'Search Applications', 'wpjobfeed' ),
				'not_found'          => __( 'No Applications found', 'wpjobfeed' ),
				'not_found_in_trash' => __( 'No Applications found in Trash', 'wpjobfeed' ),
				'parent_item_colon'  => '',
				'menu_name'          => __( 'Applications', 'wpjobfeed' ),
			),
			'public'        => false,
			'has_archive'   => false,
		)
	);

}

add_action( 'init', 'wpjf_register_job_post_type' );
