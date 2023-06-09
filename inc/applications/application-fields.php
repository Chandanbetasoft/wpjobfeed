<?php
/**
 * Functions associated with application custom fields.
 *
 * @package WP_Jobfeed
 */

/**
 * Gets an array of all the application fields registered.
 *
 * @return array An array of all the aplication fields registered.
 */
function wpjf_get_application_fields() {

	// make all the fields filterable.
	$fields = apply_filters(
		'wpjf_application_fields',
		array()
	);

	// sort the fields based on their order parameter.
	uasort( $fields, 'wpjf_array_sort_by_second_level_order_key' );

	// return the sorted fields array.
	return $fields;

}

/**
 * Sets the up the default application fields.
 *
 * @param  array $fields the current array of registered fields.
 * @return array         the modified array of registered fields.
 */
function wpjf_add_default_application_fields( $fields ) {

	/* add the candidate name field */
	$fields['candidate_name'] = array(
		'id'         => 'candidate_name',
		'name'       => __( 'Name', 'wpjobfeed' ),
		'desc'       => __( 'Please enter your full name.', 'wpjobfeed' ),
		'input_type' => 'text',
		'required'   => true,
		'order'      => 10,
	);

	/* add the candidate email field */
	$fields['candidate_email'] = array(
		'id'              => 'candidate_email',
		'name'            => __( 'Email', 'wpjobfeed' ),
		'input_type'      => 'email',
		'desc'            => __( 'Enter a valid email address.', 'wpjobfeed' ),
		'sanitization_cb' => 'sanitize_email',
		'required'        => true,
		'order'           => 20,
	);

	/* add the candidate message field */
	$fields['message'] = array(
		'id'              => 'message',
		'name'            => __( 'Cover Letter', 'wpjobfeed' ),
		'input_type'      => 'textarea',
		'desc'            => __( 'Add your cover letter for supporting information here.', 'wpjobfeed' ),
		'sanitization_cb' => 'sanitize_textarea_field',
		'required'        => true,
		'options'         => array(
			'media_buttons' => false,
			'textarea_rows' => 10,
		),
		'order'           => 30,
	);

	/* add the cv file upload field */
	$fields['cv'] = array(
		'id'         => 'cv',
		'name'       => __( 'Upload a CV', 'wpjobfeed' ),
		'type'       => 'list_attachments',
		'input_type' => 'file',
		'required'   => true,
		'options'    => array(
			'allowed_file_types' => array(
				'pdf'       => 'application/pdf',
				'word'      => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				'word_old'  => 'application/msword',
				'pages'     => 'application/vnd.apple.pages',
				'open_text' => 'application/vnd.oasis.opendocument.text',
				'rich_text' => 'application/rtf',
				'text'      => 'text/plain',
			),
		),
		'desc'       => __( 'Upload your CV to accompany your application for this job.', 'wpjobfeed' ),
		'order'      => 40,
	);

	// add the consent checkbox.
	$fields['consent'] = array(
		'id'              => 'consent',
		'name'            => __( 'Consent', 'wpjobfeed' ),
		'input_type'      => 'checkbox',
		'desc'            => sprintf(
			wp_kses_post( 'Please tick this box to consent to us using your data. How we use your data is outlined in our <a href="%s">privacy policy</a>', 'wpjobfeed' ),
			get_privacy_policy_url()
		),
		'sanitization_cb' => 'absint',
		'required'        => true,
		'order'           => 50,
	);

	/* return the modified fields array */
	return $fields;

}

add_filter( 'wpjf_application_fields', 'wpjf_add_default_application_fields', 10, 1 );

// if this function does not already exist.
if ( ! function_exists( 'wpjf_application_form_field_text' ) ) {

	/**
	 * Renders the application for text field.
	 *
	 * @param  array $field the field array for this field being output.
	 */
	function wpjf_application_form_field_text( $field ) {

		/**
		 * Fire an action before the field is output.
		 */
		do_action( 'wpjf_before_application_field_output', $field );

		?>
		<label for="wpjf-input-<?php echo esc_attr( $field['id'] ); ?>">
			<span class="wpjf-field-label"><?php echo esc_html( $field['name'] ); ?></span><?php echo ( $field['required'] === true ? ' <span class="required-symbol">*</span>' : '' ); ?>
			<input type="text" data-msg="<?php echo esc_attr( $field['validation_string'] ); ?>" name="wpjf_application_data[<?php echo esc_attr( $field['id'] ); ?>]" class="wpjf-input-text" id="wpjf-input-<?php echo esc_attr( $field['id'] ); ?>"<?php echo esc_attr( wpjf_maybe_application_field_required( $field ) ); ?> />
		</label>
		<?php

		/**
		 * Fire an action after the field is output.
		 */
		do_action( 'wpjf_after_application_field_output', $field );

	}
} // End if().

// if this function does not already exist.
if ( ! function_exists( 'wpjf_application_form_field_hidden' ) ) {

	/**
	 * Renders the application for hidden field.
	 *
	 * @param  array $field the field array for this field being output.
	 */
	function wpjf_application_form_field_hidden( $field ) {

		/**
		 * Fire an action before the field is output.
		 */
		do_action( 'wpjf_before_application_field_output', $field );

		?>
		<label for="wpjf-input-<?php echo esc_attr( $field['id'] ); ?>">
			<span class="wpjf-field-label"><?php echo esc_html( $field['name'] ); ?><?php echo ( $field['required'] === true ? ' <span class="required-symbol">*</span>' : '' ); ?></span>
			<input type="hidden" data-msg="<?php echo esc_attr( $field['validation_string'] ); ?>" name="wpjf_application_data[<?php echo esc_attr( $field['id'] ); ?>]" class="wpjf-input-text" id="wpjf-input-<?php echo esc_attr( $field['id'] ); ?>"<?php echo esc_attr( wpjf_maybe_application_field_required( $field ) ); ?> />
		</label>
		<?php

		/**
		 * Fire an action after the field is output.
		 * @hooked wpjf_output_application_field_description - 10
		 */
		do_action( 'wpjf_after_application_field_output', $field );

	}
} // End if().

// if this function does not already exist.
if ( ! function_exists( 'wpjf_application_form_field_email' ) ) {

	/**
	 * Renders the application for email field.
	 *
	 * @param  array $field the field array for this field being output.
	 */
	function wpjf_application_form_field_email( $field ) {

		/**
		 * Fire an action before the field is output.
		 */
		do_action( 'wpjf_before_application_field_output', $field );

		?>
		<label for="wpjf-input-<?php echo esc_attr( $field['id'] ); ?>">
			<span class="wpjf-field-label"><?php echo esc_html( $field['name'] ); ?></span><?php echo ( $field['required'] === true ? ' <span class="required-symbol">*</span>' : '' ); ?>
			<input type="email" data-msg="<?php echo esc_attr( $field['validation_string'] ); ?>" name="wpjf_application_data[<?php echo esc_attr( $field['id'] ); ?>]" class="wpjf-input-email" id="wpjf-input-<?php echo esc_attr( $field['id'] ); ?>" value=""<?php echo esc_attr( wpjf_maybe_application_field_required( $field ) ); ?> />
		</label>
		<?php

		/**
		 * Fire an action after the field is output.
		 * @hooked wpjf_output_application_field_description - 10
		 */
		do_action( 'wpjf_after_application_field_output', $field );

	}
} // End if().

// if this function does not already exist.
if ( ! function_exists( 'wpjf_application_form_field_textarea' ) ) {

	/**
	 * Renders the application for textarea field.
	 *
	 * @param  array $field the field array for this field being output.
	 */
	function wpjf_application_form_field_textarea( $field ) {

		/**
		 * Fire an action before the field is output.
		 */
		do_action( 'wpjf_before_application_field_output', $field );

		?>
		<label for="wpjf-input-<?php echo esc_attr( $field['id'] ); ?>">
			<span class="wpjf-field-label"><?php echo esc_html( $field['name'] ); ?></span><?php echo ( $field['required'] === true ? ' <span class="required-symbol">*</span>' : '' ); ?>
			<textarea  data-msg="<?php echo esc_attr( $field['validation_string'] ); ?>" name="wpjf_application_data[<?php echo esc_attr( $field['id'] ); ?>]" value="" class="wpjf-input-textarea" id="wpjf-input-<?php echo esc_attr( $field['id'] ); ?>"<?php echo esc_attr( wpjf_maybe_application_field_required( $field ) ); ?>></textarea>
		</label>
		<?php

		/**
		 * Fire an action after the field is output.
		 * @hooked wpjf_output_application_field_description - 10
		 */
		do_action( 'wpjf_after_application_field_output', $field );

	}
} // End if().

// if this function does not already exist.
if ( ! function_exists( 'wpjf_application_form_field_file' ) ) {

	/**
	 * Renders the application for file field.
	 *
	 * @param  array $field the field array for this field being output.
	 */
	function wpjf_application_form_field_file( $field ) {

		/**
		 * Fire an action before the field is output.
		 */
		do_action( 'wpjf_before_application_field_output', $field );

		?>
		<label for="wpjf-input-<?php echo esc_attr( $field['id'] ); ?>" class="wpjf-label<?php echo esc_attr( wpjf_maybe_application_field_required( $field ) ); ?>">
			<span class="wpjf-field-label"><?php echo esc_html( $field['name'] ); ?></span><?php echo ( $field['required'] === true ? ' <span class="required-symbol">*</span>' : '' ); ?>
			<input type="file" data-msg="<?php echo esc_attr( $field['validation_string'] ); ?>" name="<?php echo esc_attr( $field['id'] ); ?>" class="wpjf-input-file" id="wpjf-input-<?php echo esc_attr( $field['id'] ); ?>"<?php echo esc_attr( wpjf_maybe_application_field_required( $field ) ); ?> />
		</label>
		<?php

		/**
		 * Fire an action after the field is output.
		 * @hooked wpjf_output_application_field_description - 10
		 */
		do_action( 'wpjf_after_application_field_output', $field );

	}
} // End if().

// if this function does not already exist.
if ( ! function_exists( 'wpjf_application_form_field_checkbox' ) ) {

	/**
	 * Renders the application for checkbox field.
	 *
	 * @param  array $field the field array for this field being output.
	 */
	function wpjf_application_form_field_checkbox( $field ) {

		/**
		 * Fire an action before the field is output.
		 */
		do_action( 'wpjf_before_application_field_output', $field );

		?>
		<label for="wpjf-input-<?php echo esc_attr( $field['id'] ); ?>" class="wpjf-label<?php echo esc_attr( wpjf_maybe_application_field_required( $field ) ); ?>">
			<input type="checkbox" data-msg="<?php echo esc_attr( $field['validation_string'] ); ?>" name="wpjf_application_data[<?php echo esc_attr( $field['id'] ); ?>]" id="wpjf-input-<?php echo esc_attr( $field['id'] ); ?>"<?php echo esc_attr( wpjf_maybe_application_field_required( $field ) ); ?> value="1" />
			<span class="wpjf-field-label"><?php echo $field['desc']; ?></span><?php echo ( $field['required'] === true ? ' <span class="required-symbol">*</span>' : '' ); ?>
		</label>
		<?php

		/**
		 * Fire an action after the field is output.
		 */
		do_action( 'wpjf_after_application_field_output', $field );

	}
} // End if().
