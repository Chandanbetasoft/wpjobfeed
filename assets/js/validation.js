/* 
 * Uses jquery.validate to validate the page form
 */
jQuery(document).ready(
	function($) {
		// validate the application form when it is submitted
	    $("#wpjf-application-form").validate({
	    	errorClass: "wpjf-field-error",
	    	errorPlacement: function( error, element ) {
				error.appendTo( element.parent().parent() );
			}
	    });
	}
);