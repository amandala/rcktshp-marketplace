<?php
/**
 * Security related functions.
 */

add_action( 'admin_init', 'hrb_security_check', 1 );


### Hooks Callbacks

/**
 * Function to prevent visitors without admin permissions to access the WordPress backend.
 * If you wish to permit others besides admins access, change the user_level to a different number.
 *
 * http://codex.wordpress.org/Roles_and_Capabilities#level_8
 *
 * @since 1.3.2
 *
 * @uses apply_filters() Calls 'hrb_backend_access_level'
 */
function hrb_security_check() {
	global $hrb_options;

	if ( 'disable' == $hrb_options->backend_access || ( defined('DOING_AJAX') && DOING_AJAX ) ) {
		return;
	}

	// secure the backend for non ajax calls
	if ( ! empty( $_SERVER['SCRIPT_NAME'] ) && basename( $_SERVER['SCRIPT_NAME'] ) != 'admin-ajax.php' ) {
		$access_level = $hrb_options->backend_access;
	}

    if ( empty( $access_level ) ) {
		$access_level = 'read'; // if there's no value then give everyone access
	}

	$access_level = apply_filters( 'hrb_backend_access_level', $access_level );

    if ( is_user_logged_in() && ! current_user_can( $access_level ) ) {
		wp_die( __( 'You do not have sufficient permissions to access this page.', APP_TD ) );
    }

}
