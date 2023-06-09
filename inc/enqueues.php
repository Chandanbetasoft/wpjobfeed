<?php
/**
 * Enqueues the plugins stylesheets and javascript files.
 *
 * @package WP_Jobfeed
 */

/**
 * Enqueues the plugins admin stylehseets.
 *
 * @param  string $hook The current admin page hook.
 */
function wpjf_enqueue_admin_styles( $hook ) {

	// enqueue our admin plugin stylesheet.
	wp_enqueue_style( 'wpjf_admin_styles', WPJF_LOCATION_URL . '/assets/css/wpjf-admin-style.css' );

}

add_action( 'admin_enqueue_scripts', 'wpjf_enqueue_admin_styles' );

/**
 * Enqueus the necessary javascript on a single job for the application form validation.
 */
function wpjf_enqueue_application_form_validation() {

	// if this is a single job page.
	if ( is_singular( wpjf_job_post_type_name() ) ) {

		// enqueue the jquery validate script.
		wp_enqueue_script(
			'jquery_validate',
			WPJF_LOCATION_URL . '/assets/js/jquery-validate.js',
			array( 'jquery' ),
			'1.19.0',
			true
		);

		// enqueue the validation rules.
		wp_enqueue_script(
			'wpjf_validation_js',
			WPJF_LOCATION_URL . '/assets/js/validation.js',
			array( 'jquery', 'jquery_validate' ),
			false,
			true
		);

	}

}

add_action( 'wp_enqueue_scripts', 'wpjf_enqueue_application_form_validation' );
