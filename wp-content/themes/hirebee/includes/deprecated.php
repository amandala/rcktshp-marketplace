<?php
/**
 * Deprecated functions.
 */

/**
 * Wrapper for 'wp_update_post()' to update a post status.
 *
 * @deprecated 1.3.2
 */
function hrb_update_post_status( $post_id, $new_status ) {
	_deprecated_function( __FUNCTION__, '1.3.2', 'wp_update_post()' );

	return wp_update_post( array(
		'ID'          => $post_id,
		'post_status' => $new_status
	) );
}
