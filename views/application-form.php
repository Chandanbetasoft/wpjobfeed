<?php
/**
 * Creates the application form view.
 *
 * @package WP_Jobfeed
 */

?>

<div class="wpjf-application-form__wrapper" id="apply-form-<?php echo esc_attr( $data['post_id'] ); ?>" data-post-id="<?php echo esc_attr( $data['post_id'] ); ?>">

	<?php

	/**
	 * Fires before the application form.
	 *
	 * @param array $data an array of data which can be used in this view.
	 * @hooked wpjf_application_form_title - 10
	 */
	do_action( 'wpjf_before_application_form', $data );

	?>

	<form action="#wpjf-application-messages-<?php echo esc_attr( $data['post_id'] ); ?>" method="post" enctype="multipart/form-data" class="wpjf-application-form" id="wpjf-application-form">

		<?php

		/**
		 * Fires before the application form fields.
		 *
		 * @param array $data an array of data which can be used in this view.
		 */
		do_action( 'wpjf_before_application_form_fields', $data );

		// output the fields for the application form.
		wpjf_output_application_form_fields( $data );

		/**
		 * Fires after the application form fields.
		 *
		 * @param array $data an array of data which can be used in this view.
		 * @hooked wpjf_required_fields_instruction_text - 10
		 * @hooked wpjf_application_form_submit - 20
		 */
		do_action( 'wpjf_after_application_form_fields', $data );

		?>

	</form>

	<?php

	/**
	 * Fires after the application form.
	 *
	 * @param array $data an array of data which can be used in this view.
	 */
	do_action( 'wpjf_after_application_form', $data );

	?>

</div><!-- // wpjf-application-form -->
