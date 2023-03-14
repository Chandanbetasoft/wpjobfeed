<?php
/**
 * Registers the plugins admin menus with the WordPress menu system.
 *
 * @package WP_Jobfeed
 */

/**
 * Adds the wpjobfeed admin menus under a parent menu
 */
function wpjf_add_admin_menu() {

	// add the main page for wpjobfeed info.
	add_menu_page(
		esc_html__( 'WP Jobfeed' ), // page_title,
		esc_html__( 'WP Jobfeed' ), // menu_title,
		'edit_posts', // capability,
		'WP_Jobfeed_home', // menu_slug,
		'__return_false', // function,
		'dashicons-groups', // icon url
		'90' // position
	);

}

add_action( 'admin_menu', 'wpjf_add_admin_menu', 10 );


function wpjf_register_settings_submenu_pages() {

	// get the plugin settings groups.
	$settings_groups = wpjf_get_settings_groups();

	// if we have settings groups.
	if ( ! empty( $settings_groups ) ) {

		// loop through each settings page.
		foreach ( $settings_groups as $settings_group ) {

			// remove the preifx of the page for the setting page titles.
			$settings_title = str_replace( 'wpjf_', '', $settings_group );

			// add the sub menu page foe this settings group.
			add_submenu_page(
				'WP_Jobfeed_home', // parent_slug,
				ucfirst( $settings_title ), // page_title,
				ucfirst( $settings_title ), // menu_title,
				apply_filters( 'wpjf_settings_group_cap', 'manage_options', $settings_group ), // capability,
				esc_html( $settings_group ), // menu slug,
				apply_filters( 'wpjf_settings_group_cap', 'wpjf_settings_page_output', $settings_group ) // callback function for the pages content
			);

		}
	}

}

add_action( 'admin_menu', 'wpjf_register_settings_submenu_pages' );
