<?php

/**
Breadcrumbs
**/

 
 
add_action( 'hrb_content_container_tops', '_hrb_content_container_tops' );


function _hrb_content_container_tops() {

	if ( hrb_is_blogs() ) {
		the_hrb_page_title_headers( __( 'Blog', APP_TD ) );
	} elseif ( is_hrb_titled_pages() ) {
		the_hrb_page_title_headers();
 	}

}


function is_hrb_titled_pages() {

	$page_id = (int) get_query_var('page_id');

	return ! is_home() && $page_id != HRB_Project_Categories::get_id();
}

function hrb_is_blogs() {
	global $wp_query;

	return is_singular( 'post' ) || $wp_query->is_posts_page;
 }
 
 
 
 
 
 
 
 
 
 
 function the_hrb_page_title_headers( $title = '' ) {

	if ( ! $title ) {
		if ( is_singular( HRB_PROJECTS_PTYPE ) ) {
			$title = __( 'Project Details', APP_TD );
		} else {
			$title = wp_title( $sep = '', $display = false );
		}
	}

	appthemes_before_page_title();
?>
	
			<h3><?php echo $title; ?></h3>
	
<?php
	appthemes_after_page_title();
}

?>