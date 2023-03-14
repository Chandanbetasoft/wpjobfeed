<?php
/**
 * Functions associated with job custom fields.
 *
 * @package WP_Jobfeed
 */

/**
 * Gets an array of all the registed fields for the job post type.
 *
 * @return an array of registered job fields.
 */
function wpjf_get_job_fields() {

	// make all the fields filterable.
	$fields = apply_filters(
		'wpjf_job_fields',
		array()
	);

	// sort the fields based on their order parameter.
	uasort( $fields, 'wpjf_array_sort_by_second_level_order_key' );

	// return the sorted fields array.
	return $fields;

}

/**
 * Gets the prefix string for the of the job fields.
 *
 * @return string the prefix for job fields keys
 */
function wpjf_get_job_field_prefix() {
	return apply_filters(
		'wpjf_job_field_prefix',
		'_wpjf_job_'
	);
}

/**
 * Sets up the default fields for the jobs post type.
 *
 * @param  array $fields the current array of registered fields for jobs.
 * @return array         the newly modified array of registered fields for jobs.
 */
function wpjf_add_default_job_fields( $fields ) {

	/* set a prefix for all default meta */
	$prefix = wpjf_get_job_field_prefix();

	/* add the job reference field */
	$fields['short_description'] = array(
		'id'               => $prefix . 'short_description',
		'name'             => __( 'Short Description', 'wpjobfeed' ),
		'type'             => 'textarea',
		'xml_field'        => 'short_description',
		'desc'             => __( 'Enter a short description for the job.', 'wpjobfeed' ),
		'show_on_frontend' => false,
		'cols'             => 12,
		'order'            => 5,
		'jobfeed_notes'    => array(
			'data_type'     => 'string',
			'input_type'    => 'textarea',
			'default_value' => '',
			'example_value' => __( 'This is the short description', 'wpjobfeed' ),
			'notes'         => __( 'A short description of the job. This should not contain any HTML, just text.', 'wpjobfeed' ),
		),
	);

	/* add the job reference field */
	$fields['job_reference'] = array(
		'id'               => $prefix . 'reference',
		'name'             => __( 'Job Reference', 'wpjobfeed' ),
		'type'             => 'text',
		'xml_field'        => 'job_reference',
		'desc'             => __( 'Unique to each job.', 'wpjobfeed' ),
		'show_on_frontend' => true,
		'cols'             => 4,
		'order'            => 10,
		'jobfeed_notes'    => array(
			'data_type'     => 'string',
			'input_type'    => 'text',
			'default_value' => '',
			'example_value' => 'REF-1234',
			'notes'         => __( 'This is a reference for each job and MUST BE UNIQUE to each job. It should not contain any special characters, just lower and upper case letters, dashes and numbers please.', 'wpjobfeed' ),
		),
	);

	/* add the application tracking email field */
	$fields['application_email'] = array(
		'id'               => $prefix . 'Jobfeed_application_email',
		'name'             => __( 'Application Email', 'wpjobfeed' ),
		'type'             => 'email',
		'xml_field'        => 'application_email',
		'desc'             => __( 'For applicant tracking.', 'wpjobfeed' ),
		'show_on_frontend' => false,
		'cols'             => 4,
		'order'            => 20,
		'jobfeed_notes'    => array(
			'data_type'     => 'text',
			'input_type'    => 'email',
			'default_value' => '',
			'example_value' => 'bob.12345.123@smith.aplitrak.com',
			'notes'         => __( 'This is the unique applicant tracking address for this job and applications made to this job are delivered to this address.', 'wpjobfeed' ),
		),
	);

	/* add the application tracking url field */
	$fields['application_url'] = array(
		'id'               => $prefix . 'Jobfeed_application_url',
		'name'             => __( 'Application URL', 'wpjobfeed' ),
		'type'             => 'text',
		'xml_field'        => 'application_url',
		'desc'             => __( 'External apply URL.', 'wpjobfeed' ),
		'show_on_frontend' => false,
		'cols'             => 4,
		'order'            => 30,
		'jobfeed_notes'    => array(
			'data_type'     => 'text',
			'input_type'    => 'text',
			'default_value' => '',
			'example_value' => 'https://apply.url',
			'notes'         => __( 'If the client is supporting application URLs rather than using the tracking email address, this is the URL where candidates can apply on a Jobfeed hosted application form', 'wpjobfeed' ),
		),
	);

	/* add the salary display field */
	$fields['salary_display'] = array(
		'id'               => $prefix . 'salary_display',
		'name'             => __( 'Salary', 'wpjobfeed' ),
		'type'             => 'text',
		'desc'             => __( 'Salary display field to show on front end.', 'wpjobfeed' ),
		'xml_field'        => 'salary_display',
		'show_on_frontend' => true,
		'cols'             => 3,
		'order'            => 40,
		'jobfeed_notes'    => array(
			'data_type'     => 'string',
			'input_type'    => 'text',
			'default_value' => '',
			'example_value' => __( '£30,000 per year with benefits including travel and conference budget', 'wpjobfeed' ),
			'notes'         => __( 'A string explaining any salary and benefits the candidate may receive.', 'wpjobfeed' ),
		),
	);

	/* add the salary field */
	$fields['salary'] = array(
		'id'               => $prefix . 'salary',
		'name'             => __( 'Salary Amount', 'wpjobfeed' ),
		'type'             => 'number',
		'desc'             => __( 'Salary amount.', 'wpjobfeed' ),
		'xml_field'        => 'salary',
		'show_on_frontend' => false,
		'cols'             => 2,
		'order'            => 50,
		'jobfeed_notes'    => array(
			'data_type'     => 'integer',
			'input_type'    => 'number',
			'default_value' => '',
			'example_value' => '30000',
			'notes'         => __( 'An integer value to represent the salary on offer for this job. If a site uses salary search, this value is used to determin the salary for the job.', 'wpjobfeed' ),
		),
	);

	/* add the salary from field */
	$fields['salary_from'] = array(
		'id'               => $prefix . 'salary_from',
		'name'             => __( 'Salary From', 'wpjobfeed' ),
		'type'             => 'number',
		'xml_field'        => 'salary_from',
		'desc'             => __( 'Salary from number.', 'wpjobfeed' ),
		'show_on_frontend' => true,
		'cols'             => 2,
		'order'            => 60,
		'jobfeed_notes'    => array(
			'data_type'     => 'integer',
			'input_type'    => 'number',
			'default_value' => '',
			'example_value' => '26000',
			'notes'         => __( 'An integer value to represent the low salary range value for this job.', 'wpjobfeed' ),
		),
	);

	/* add the salary from field */
	$fields['salary_to'] = array(
		'id'               => $prefix . 'salary_to',
		'name'             => __( 'Salary To', 'wpjobfeed' ),
		'type'             => 'number',
		'xml_field'        => 'salary_to',
		'desc'             => __( 'Salary to number.', 'wpjobfeed' ),
		'show_on_frontend' => true,
		'cols'             => 2,
		'order'            => 70,
		'jobfeed_notes'    => array(
			'data_type'     => 'integer',
			'input_type'    => 'number',
			'default_value' => '',
			'example_value' => '30000',
			'notes'         => __( 'An integer value to represent the high salary range value for this job.', 'wpjobfeed' ),
		),
	);

	/* add the job reference field */
	$fields['currency'] = array(
		'id'               => $prefix . 'salary_currency',
		'name'             => __( 'Currency', 'wpjobfeed' ),
		'type'             => 'text',
		'xml_field'        => 'currency',
		'desc'             => __( 'Currency code.', 'wpjobfeed' ),
		'show_on_frontend' => false,
		'cols'             => 3,
		'order'            => 80,
		'jobfeed_notes'    => array(
			'data_type'     => 'string',
			'input_type'    => 'select',
			'default_value' => 'GBP',
			'example_value' => 'USD',
			'notes'         => __( 'Support for USD, GBP and EUR are provided. A select input for these options would be good.', 'wpjobfeed' ),
		),
	);

	/* add the job reference field */
	$fields['days_to_advertise'] = array(
		'id'               => $prefix . 'days_to_advertise',
		'name'             => __( 'Days to Advertise', 'wpjobfeed' ),
		'type'             => 'number',
		'xml_field'        => 'days_to_advertise',
		'desc'             => __( 'Numbers of days to advertise job. This number is not actioned by this plugin.', 'wpjobfeed' ),
		'show_on_frontend' => false,
		'cols'             => 6,
		'order'            => 90,
		'jobfeed_notes'    => array(
			'data_type'     => 'integer',
			'input_type'    => 'number',
			'default_value' => '28',
			'example_value' => '16',
			'notes'         => __( 'The number of days the job should be advertised on ths site for.', 'wpjobfeed' ),
		),
	);

	// add the application tracking url field.
	$fields['consultant_email'] = array(
		'id'               => $prefix . 'consultant_email',
		'name'             => __( 'Consultant Email', 'wpjobfeed' ),
		'type'             => 'text',
		'xml_field'        => 'consultant_email',
		'desc'             => __( 'Add the email of the consultant posting this job.', 'wpjobfeed' ),
		'show_on_frontend' => false,
		'cols'             => 6,
		'order'            => 100,
		'jobfeed_notes'    => array(
			'data_type'     => 'text',
			'input_type'    => 'email',
			'default_value' => '',
			'example_value' => 'john@company.com',
			'notes'         => __( 'The email address of the consultant posting the job. Likely this can be pulled from their Jobfeed/Adcourier account and set automatically without having to manually enter it.', 'wpjobfeed' ),
		),
	);

	/* return the modified fields array */
	return $fields;

}

add_filter( 'wpjf_job_fields', 'wpjf_add_default_job_fields', 10, 1 );
