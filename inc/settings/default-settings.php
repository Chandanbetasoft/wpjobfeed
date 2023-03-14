<?php
/**
 * Registered the default settings for the plugin.
 *
 * @package WP_Jobfeed
 */

/**
 * Registers the plugin default general settings shown on the settings screen.
 *
 * @param  array $settings these are the current settings registered.
 * @return array           the modified array of settings.
 */
function wpjf_register_default_general_settings( $settings ) {

	// add general settings section.
	$settings['wpjobfeed_section'] = array(
		'option_name'    => 'wpjf_section',
		'label'          => __( 'WP Jobfeed Settings', 'wpjobfeed' ),
		'description'    => __( 'These are the general settings for the WP Jobfeed plugin.', 'wpjobfeed' ),
		'input_type'     => 'section',
		'settings_group' => 'wpjf_settings',
		'order'          => 1,
	);

	// add the feed username.
	$settings['username'] = array(
		'option_name'    => 'wpjf_username',
		'label'          => __( 'Username', 'wpjobfeed' ),
		'description'    => __( 'Enter a username for your feed.', 'wpjobfeed' ),
		'input_type'     => 'text',
		'settings_group' => 'wpjf_settings',
		'order'          => 10,
	);

	// add the feed password.
	$settings['password'] = array(
		'option_name'    => 'wpjf_password',
		'label'          => __( 'Password', 'wpjobfeed' ),
		'description'    => __( 'Enter a password for your feed. Longer the better!', 'wpjobfeed' ),
		'input_type'     => 'text',
		'settings_group' => 'wpjf_settings',
		'order'          => 20,
	);

	// add the setting to hide the job data on a single job listing.
	$settings['hide_job_data_output'] = array(
		'label'          => __( 'Hide Job Data', 'wpjobfeed' ),
		'option_name'    => 'wpjf_hide_job_data_output',
		'input_type'     => 'checkbox',
		'description'    => __( 'Check this to prevent the plugin outputting any job taxonomy term or meta data on a single job.', 'wpjobfeed' ),
		'settings_group' => 'wpjf_settings',
		'order'          => 30,
	);

	// add the feed password.
	$settings['plugin_credit'] = array(
		'option_name'    => 'wpjf_plugin_credit',
		'label'          => __( 'Show Plugin Credit', 'wpjobfeed' ),
		'description'    => __( 'Show a credit beneath each job on your site for the WP Jobfeed developers.', 'wpjobfeed' ),
		'input_type'     => 'checkbox',
		'settings_group' => 'wpjf_settings',
		'order'          => 40,
	);

	// add the setting to hide the job data on a single job listing.
	$settings['application_type'] = array(
		'label'          => __( 'Application Type', 'wpjobfeed' ),
		'option_name'    => 'wpjf_job_application_type',
		'input_type'     => 'select',
		'options'        => array(
			'form' => __( 'Application Form', 'wpjobfeed' ),
			'url'  => __( 'External URL', 'wpjobfeed' ),
		),
		'description'    => sprintf( __( 'Choose how candidates should apply for jobs, either using the Jobfeed tracking URL (external URL) or the tracking email address (application form). Learn more about the two types %s.', 'wpjobfeed' ), '<a href="https://integrations.Jobfeed.com/hc/en-us/articles/213311449-What-is-Aplitrak-">here</a>' ),
		'settings_group' => 'wpjf_settings',
		'order'          => 40,
	);

	// return the modified settings array.
	return $settings;

}

add_filter( 'wpjf_plugin_settings', 'wpjf_register_default_general_settings' );
