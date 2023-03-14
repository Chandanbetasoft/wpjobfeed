<?php
/**
 * Registers the taxonomy with the plugin.
 *
 * @package WP_Jobfeed
 */

/**
 * Get an array of the taxonomies registered for use within the plugin.
 *
 * @return array An array of the registered taxonomies.
 */
function wpjf_get_registered_taxonomies() {
	return apply_filters(
		'wpjf_registered_taxonomies',
		array()
	);
}

/**
 * Add the default registered taxonomies.
 */
function wpjf_register_default_taxonomies( $taxonomies ) {

	// add the job industry taxonomy.
	$taxonomies['job_industry'] = array(
		'taxonomy_name'     => 'wpjf_job_industry',
		'xml_field'         => 'job_industry',
		'plural'            => __( 'Job Industries', 'wpjobfeed' ),
		'singular'          => __( 'Job Industry', 'wpjobfeed' ),
		'slug'              => __( 'job-industry', 'wpjobfeed' ),
		'menu_label'        => __( 'Industries', 'wpjobfeed' ),
		'hierarchical'      => true,
		'show_admin_column' => true,
		'show_on_frontend'  => true,
		'jobfeed_notes'    => array(
			'data_type'     => 'string',
			'input_type'    => 'text',
			'default_value' => '',
			'example_value' => 'Accounting|Computing',
			'notes'         => __( 'A pipe seperated string of job industries.', 'wpjobfeed' ),
		),
	);

	// add the job location taxonomy.
	$taxonomies['job_location'] = array(
		'taxonomy_name'     => 'wpjf_job_location',
		'xml_field'         => 'job_location',
		'plural'            => __( 'Job Locations', 'wpjobfeed' ),
		'singular'          => __( 'Job Location', 'wpjobfeed' ),
		'slug'              => __( 'job-location', 'wpjobfeed' ),
		'menu_label'        => __( 'Locations', 'wpjobfeed' ),
		'hierarchical'      => true,
		'show_admin_column' => true,
		'show_on_frontend'  => true,
		'jobfeed_notes'    => array(
			'data_type'     => 'string',
			'input_type'    => 'text',
			'default_value' => '',
			'example_value' => 'London|Manchester',
			'notes'         => __( 'A pipe seperated string of job locations. It is better if this plugin has a defined list of locations to support, rather than using the standard Jobfeed locations.', 'wpjobfeed' ),
		),
	);

	// add the job type taxonomy.
	$taxonomies['job_type'] = array(
		'taxonomy_name'     => 'wpjf_job_type',
		'xml_field'         => 'job_type',
		'plural'            => __( 'Job Types', 'wpjobfeed' ),
		'singular'          => __( 'Job Type', 'wpjobfeed' ),
		'slug'              => __( 'job-type', 'wpjobfeed' ),
		'menu_label'        => __( 'Types', 'wpjobfeed' ),
		'hierarchical'      => true,
		'show_admin_column' => true,
		'show_on_frontend'  => true,
		'jobfeed_notes'    => array(
			'data_type'     => 'string',
			'input_type'    => 'text',
			'default_value' => '',
			'example_value' => 'Permanent|Temporary|Contract',
			'notes'         => __( 'A pipe seperated string of job types.', 'wpjobfeed' ),
		),
	);

	// add the job skills taxonomy.
	$taxonomies['job_skill'] = array(
		'taxonomy_name'     => 'wpjf_job_skill',
		'xml_field'         => 'job_skills',
		'plural'            => __( 'Job Skills', 'wpjobfeed' ),
		'singular'          => __( 'Job Skill', 'wpjobfeed' ),
		'slug'              => __( 'job-skill', 'wpjobfeed' ),
		'menu_label'        => __( 'Skills', 'wpjobfeed' ),
		'hierarchical'      => false,
		'show_admin_column' => true,
		'show_on_frontend'  => true,
		'jobfeed_notes'    => array(
			'data_type'     => 'string',
			'input_type'    => 'text',
			'default_value' => '',
			'example_value' => 'PHP|Javascript',
			'notes'         => __( 'A pipe seperated string of job skills.', 'wpjobfeed' ),
		),
	);

	// return the modified taxonomies.
	return $taxonomies;

}

add_filter( 'wpjf_registered_taxonomies', 'wpjf_register_default_taxonomies', 10, 1 );

/**
 * Registers the added taxonomies with WordPress.
 */
function wpjf_register_taxonomies() {

	/* get the taxonomies that are registered with the plugin */
	$taxonomies = wpjf_get_registered_taxonomies();

	/* for each taxonomy returned, register it as a custom taxonomy */
	foreach ( $taxonomies as $taxonomy ) {

		register_taxonomy(
			$taxonomy['taxonomy_name'], // taxonomy name
			wpjf_job_post_type_name(), // post type for this taxonomy
			array(
				'labels'            => apply_filters( $taxonomy['taxonomy_name'] . '_labels',
					array(
						'name'              => $taxonomy['plural'],
						'singular_name'     => $taxonomy['singular'],
						'search_items'      => __( 'Search ', 'wpjobfeed' ) . $taxonomy['plural'],
						'all_items'         => __( 'All ', 'wpjobfeed' ) . $taxonomy['plural'],
						'parent_item'       => __( 'Parent ', 'wpjobfeed' ) . $taxonomy['singular'],
						'parent_item_colon' => __( 'Parent ', 'wpjobfeed' ) . $taxonomy['singular'] . ':',
						'edit_item'         => __( 'Edit ', 'wpjobfeed' ) . $taxonomy['singular'],
						'update_item'       => __( 'Update ', 'wpjobfeed' ) . $taxonomy['singular'],
						'add_new_item'      => __( 'Add New ', 'wpjobfeed' ) . $taxonomy['singular'],
						'new_item_name'     => __( 'New ', 'wpjobfeed' ) . $taxonomy['singular'] . ' Name',
						'menu_name'         => $taxonomy['plural'],
					)
				),
				'hierarchical'      => $taxonomy['hierarchical'],
				'sort'              => true,
				'rewrite'           => array(
					'slug' => $taxonomy['slug'],
				),
				'show_admin_column' => $taxonomy['show_admin_column'],
				'show_in_rest'      => true,
			)
		);

	}

}

add_action( 'init', 'wpjf_register_taxonomies', 10 );

/**
 * Add a submenu item of WP Jobfeed menu page for each taxonomy registered.
 */
function wpjf_add_taxonomy_submenus() {

	// get all the registered taxonomies.
	$taxonomies = wpjf_get_registered_taxonomies();

	// if we have any taxonomies.
	if ( ! empty( $taxonomies ) ) {

		// loop through each registered taxonomy.
		foreach ( $taxonomies as $taxonomy ) {

			// add this taxonomy as as submenu of the WP Jobfeed menu item.
			add_submenu_page(
				'WP_Jobfeed_home', // parent_slug,
				$taxonomy['plural'], // page_title,
				$taxonomy['plural'], // menu_title,
				apply_filters( 'wpjf_taxonomy_submenu_cap', 'edit_others_posts', $taxonomy ), // capability,
				'edit-tags.php?taxonomy=' . $taxonomy['taxonomy_name'] // menu slug,
			);

		}
	}

}

add_action( 'admin_menu', 'wpjf_add_taxonomy_submenus' );

/**
 * When viewing a taxonomy edit screen, keep the WP Jobfeed top level menu open.
 *
 * @param  string $parent_file The current parent file set for this sub page.
 * @return string              The new parent file set for this sub page.
 */
function wpjf_tax_menu_correction( $parent_file ) {

	global $current_screen;

	/* get the taxonomy of the current screen */
	$current_taxonomy = $current_screen->taxonomy;
	$taxonomies = wpjf_get_registered_taxonomies();

	// loop through each registered taxonomy.
	foreach ( $taxonomies as $taxonomy ) {

		// if the current screen taxonomy is this taxonomy.
		if ( $current_taxonomy === $taxonomy['taxonomy_name'] ) {

			// set the parent file slug to the sen main page.
			$parent_file = 'WP_Jobfeed_home';

		}
	}

	// return the new parent file.
	return $parent_file;

}

add_action( 'parent_file', 'wpjf_tax_menu_correction' );
