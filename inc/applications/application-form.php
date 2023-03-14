<?php
/**
 * Functions for displaying and processing job applications.
 *
 * @package WP_Jobfeed
 */

/**
 * Gets the application form markup for a give job id.
 * @param  integer $job_id The job post ID to return the form for.
 * @return mixed           The markup for the application form for the given job id or an empty string.
 */
function wpjf_get_job_application_form( $job_id = 0 ) {

	// empty content to return.
	$html = '';

	// if the job id is zero.
	if ( 0 === $job_id ) {
		return $html;
	}

	// if we have no tracking email address for this job.
	if ( '' === wpjf_get_job_applicant_tracking_email( $job_id ) ) {
		$message = __( 'No applicant tracking email address detected for this job.', 'wpjobfeed' );
		$html = wp_kses_post( '<p class="wpjf-message warning">' . esc_html( $message ) . '</p>' );
	}

	// if form is not yet posted.
	if ( ! isset( $_POST['wpjf_application_data']['submit'] ) ) {

		/* build an array of data to pass to our view */
		$application_form_data = apply_filters(
			'wpjf_application_form_data_array',
			array(
				'post_id' => $job_id,
			)
		);

		/* load the view to handle outputting the application form */
		$html = wpjf_load_view( 'application-form', $application_form_data );

	} else { // form has been posted.

		/* set a string to store all messages in */
		$wpjf_message_output = array();

		/* get any messages */
		global $wpjf_messages;

		/* run messages through a filter so devs can alter them */
		$wpjf_messages = apply_filters(
			'wpjf_application_form_messages',
			$wpjf_messages
		);

		/* if we have some messages to loop through */
		if ( ! empty( $wpjf_messages ) ) {

			/* loop through each message adding to string */
			foreach ( $wpjf_messages as $key => $message ) {
				$wpjf_message_output[] = '<p class="wpjf-message wpjf-message-' . esc_attr( $message['type'] ) . '">' . esc_html( $message['message'] ) . '</p>';
			}
		}

		// add the post ID to the messages array.
		$wpjf_message_output['post_id'] = $job_id;

		$html = wpjf_load_view( 'messages', $wpjf_message_output );

	} // End if().

	// return the form html output.
	return $html;

}

/**
 * Echos the job application form for a given job id.
 *
 * @param  integer $job_id The job post ID to return the form for.
 * @return mixed           The markup for the application form for the given job id or an empty string.
 */
function wpjf_job_application_form( $job_id = 0 ) {
	echo wpjf_get_job_application_form( $job_id );
}

/**
 * Outputs a job application after the post content on a single job view.
 *
 * @param  string $content The current content of the post.
 * @return string          The content of the post with the application form appended.
 */
function wpjf_job_application_form_output( $content ) {

	// if the job application type is not a form.
	if ( 'form' !== wpjf_get_job_application_type() ) {
		return $content;
	}

	// if this is not a single job view.
	if ( ! is_singular( wpjf_job_post_type_name() ) ) {
		return $content;
	}

	// get the form HTML for this current job.
	global $post;
	$form_html = wpjf_get_job_application_form( $post->ID );

	// return the original content and the form html.
	return $content . $form_html;

}

add_filter( 'the_content', 'wpjf_job_application_form_output', 20, 1 );

/**
 * Outputs the markup for the application form fields.
 *
 * @param  array $data an array of data passed about the current job applying for.
 */
function wpjf_output_application_form_fields( $data ) {

	// add a nonce field to the form.
	wp_nonce_field( 'wpjf_application_nonce_action', 'wpjf_application_nonce_field' );

	/* get the application form fields */
	$fields = wpjf_get_application_fields();

	/* check we have fields to action */
	if ( ! empty( $fields ) ) {

		// create an array of defaults for application fields.
		$defaults = array(
			'id'                => '',
			'name'              => '',
			'desc'              => '',
			'input_type'        => 'text',
			'required'          => true,
			'order'             => 10,
			'validation_string' => __( 'This is a required field.', 'wpjobfeed' ),
		);

		/* loop through each field */
		foreach ( $fields as $field ) {

			// parse the field args with the defaults.
			$field = wp_parse_args( $field, $defaults );

			// create a filterable array of classes for this field.
			$classes = apply_filters(
				'wpjf_application_form_field_classes',
				array(
					'wpjf-application-field',
					'wpjf-application-field-' . esc_attr( $field['input_type'] ),
				),
				$field
			);

			?>
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?><?php echo esc_attr( wpjf_maybe_application_field_required( $field ) ); ?>" id="wpjf-application-field-<?php echo esc_attr( $field['id'] ); ?>">

				<?php call_user_func( 'wpjf_application_form_field_' . $field['input_type'], $field ); ?>

			</div>
			<?php

		} // End foreach().
	} // End if().

}
