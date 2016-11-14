<?php


//Required files
require dirname( __FILE__ ) . '/includes/actions.php';					// Actions

// auto install plugins/rev slider
require_once dirname( __FILE__ ) . '/install/install.php';

//breadcrumbs
require dirname( __FILE__ ) . '/includes/breadcrumbs.php';

//The admin options
include_once 'admin/options-init.php';



add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css?v=2.3' );
}



/****************************************************************************************************************
 *											DASHBOARD MODIFICATIONS
 *****************************************************************************************************************

/**
 * Output the title for a project in the dashboard
 *
 * MODIFIED - Changes the project title link to redirect to the workspace if the current user is assigned to the Project.
 *
 * Outputs the formatted title link for a listing. Optionally adds the featured CSS class if the listing is featured.
 */

function the_hrb_child_project_title( $post_id = 0, $before = '', $after = '', $atts = array() ) {

	$link = "";
	$post_id = get_the_hrb_loop_id( $post_id );

	$title = get_the_title( $post_id );

	$post_type = get_post_type( $post_id );
	$post = $post ? $post : get_post( get_the_ID() );

	$dashboard_user = wp_get_current_user();

	$workspaces_ids = hrb_get_cached_workspaces_for( $post_id );


	if(empty($workspaces_ids)){
		$link = esc_url( get_permalink( $post_id ) );

	}
	else{
		if ( ! empty( $workspaces_ids ) ) {

			foreach( $workspaces_ids as $workspace_id ) {

				if (current_user_can( 'edit_workspace', $workspace_id ) ) {
					$link =  hrb_get_workspace_url( $workspace_id );
				}
				else{
					$link = esc_url( get_permalink( $post_id ) );
				}
			}
		}
	}


	$defaults = array(
		'href'			=> $link,
		'title'			=> esc_attr( $title ),
		'class'			=> "{$post_type}-title",
		'rel'			=> 'bookmark',
		'featured_tag'	=> 'span',
	);


	$atts = wp_parse_args( $atts, $defaults );

	if ( 'pending' != get_post_status( $post_id ) ) {
		$title_link = html( 'a', $atts, $title );
	} else {
		unset( $atts['href'] );
		$title_link = html( 'span', $atts, $title );
	}

	if ( ! empty( $atts['featured_tag'] ) && is_hrb_project_featured( $post_id ) ) {

		$attr_featured = array(
			'class' => hrb_project_featured_class( $post_id ),
		);

		$title = html( $atts['featured_tag'], $attr_featured, $title );
	}

	echo $before . $title_link . $after;

}


/**
 * Retrieves the user main navigation links.
 *
 * @uses apply_filters() Calls 'hrb_user_nav_links'
 *
 */
function get_the_hrb_child_user_nav_links() {
	global $current_user;

	if ( ! is_user_logged_in() ) {

		$user_links = array(
			'login' => array(
				'name' => __( 'Login', APP_TD ),
				'url' => get_the_hrb_site_login_url(),
				'class' => 'icon i-login',
			),
			'register' => array(
				'name' => __( 'Register', APP_TD ),
				'url' => get_the_hrb_site_registration_url(),
				'class' => 'icon i-register',
			),
		);

	} else {

		get_currentuserinfo();

		ob_start();

		the_hrb_user_rating( $current_user );

		$the_user_rating = ob_get_clean();

		$user_links = array(
			'favorites' => array(
				'name' => __( 'Favorites', APP_TD ),
				'url' => hrb_get_dashboard_url_for( 'projects', 'favorites' ),
				'class' => 'icon i-favorites',
			),
			'notifications' => array(
				'name' => __( 'Notifications', APP_TD ) . sprintf( ' <span class="inbox">%d</span>', appthemes_get_user_total_unread_notifications( $current_user->ID ) ),
				'url' => hrb_get_dashboard_url_for('notifications'),
				'class' => '',
			),
			'rating' => array(
				'name' => $the_user_rating,
				'url' => get_the_hrb_user_profile_url( $current_user ),
				'class' => '',
				'title' => __( 'Rating', APP_TD ),
			),
			'user' => array(
				'name' => sprintf( __( 'Hi, %s', APP_TD ), $current_user->display_name ),
				'url' => hrb_get_dashboard_url_for('projects'),
				'align' => 'left',
				'class' => 'icon i-dashboard',
				'title' => __( 'Dashboard', APP_TD ),
			),
		);
	}

	// hide registration link if not enabled
	if ( ! get_option( 'users_can_register' ) ) {
		unset( $user_links['register'] );
	}

	return apply_filters( 'hrb_user_nav_links', $user_links );
}

/**
 * Outputs the user main navigation links.
 */
function the_hrb_child_user_nav_links() {

	$user_links = get_the_hrb_child_user_nav_links();

	$defaults = array(
		'align' => '',
		'class' => '',
		'name' => 'item',
	);

	foreach( $user_links as $key => $user_link ) {

		$user_link = wp_parse_args( $user_link, $defaults );

		_hrb_output_user_nav_html( $user_link, $key );

	};

	if ( is_user_logged_in() ) {

		$logout_html = html( 'i', array( 'class' => 'logout icon i-logout'), '&nbsp;' ) . __(  'Logout', APP_TD );

		echo html( 'li', html( 'a', array( 'href' => wp_logout_url() ), $logout_html ) );
	}
}



/**
 * Adds tax to an order based on the province code entered when teh user signs up
 */
function rcktshp_payments_add_tax( $order ){

	$order->remove_item( '_regional-tax' );
	$tax_rate = '';
	$user_vars = wp_get_current_user();
	$user = $user_vars->ID;
	$meta = get_user_meta($user);

	if (isset($meta['province'])){
		$user_province = $meta['province'][0];
		switch ($user_province) {
			case 'AB':
				$tax_rate = 5;
				break;
			case 'BC':
				$tax_rate = 5;
				break;
			case 'MB':
				$tax_rate = 5;
				break;
			case 'NB':
				$tax_rate = 13;
				break;
			case "NL":
				$tax_rate = 13;
				break;
			case "NT":
				$tax_rate = 5;
				break;
			case "NS":
				$tax_rate = 15;
				break;
			case "NU":
				$tax_rate = 5;
				break;
			case "ON":
				$tax_rate = 13;
				break;
			case "PE":
				$tax_rate = 14;
				break;
			case "QC":
				$tax_rate = 5;
				break;
			case "SK":
				$tax_rate = 5;
				break;
			case "YT":
				$tax_rate = 5;
				break;
			default:
				$tax_rate = 0;
				break;
		}

	}
	else{
		//no province data available 
		//WP_die("<pre>" . 'NO PROVINCE DATA' . "</pre>");
	}

	$total = $order->get_total();
	$charged_tax = $total * ( $tax_rate / 100 );

	if( $charged_tax == 0 )
		return;

	$order->add_item( '_regional-tax', number_format( $charged_tax, 2, '.', '' ), $order->get_id() );
}

/**** FACEBOOK OGP DATA **/


//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
	return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info

function insert_fb_in_head() {
	global $post;
	if ( !is_singular()) //if it is not a post or a page
		return;
	echo '<meta property="fb:admins" content="433540483488911"/>';
	echo '<meta property="og:title" content="' . get_the_title() . '"/>';
	echo '<meta property="og:url" content="' . get_permalink() . '"/>';
	echo '<meta property="og:site_name" content="RCKTSHP"/>';
	if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
		$default_image="rcktshp_logo.png"; //replace this with a default image on your server or an image in your media library
		echo '<meta property="og:image" content="' . $default_image . '"/>';
	}
	else{
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}
	echo "
";
}

//add_action( 'wp_head', 'insert_fb_in_head', 5 );


/**
 * Creates sharethis shortcode
 */
if (function_exists('st_makeEntries')) :
	add_shortcode('sharethis', 'st_makeEntries');
endif;


// NOTE: Make sure to remove this code after the order is Paid.


//add_action( 'admin_init', 'my_manual_payment' );

/**
 * Make a manual payment.

function my_manual_payment() {

// ONLY CHANGE THE ORDER ID AND NOTHING ELSE -->
$order_id = 16746; // the order ID to mark as paid - this is the ID located on the first column of the Orders table.
// <--

$order = appthemes_get_order( $order_id );

// Mark as paid if not already.
if ( APPTHEMES_ORDER_PAID !== $order->get_status() ) {
$order->paid();
}

}
 */


function rcktshp_output_action_links($actions){

	//var_dump($actions);
	foreach($actions as $action){
		if(isset ($action['onclick']) ){
			$onclick = $action['onlcick'];
		}
		else{
			$onclick = '';
		}

		if(isset ($action['class']) ){
			$class=$action['class'];
		}
		else{
			$class='';
		}
		if(isset ($action['id']) ){
			$id = $action['id'];
		}
		else{
			$id = '';
		}

		$title = $action['title'];
		$href = $action['href'];


		echo '<a id="'.$id.'" title="'.$title.'" href="'.$href.'" onclick="'.$onclick.'" class="'.$class.'">'.$title.'</a><br />';
	}
}

/**
 * Outputs the context dropdown with the active actions for the current user on a project.
 */
function rcktshp_the_hrb_dashboard_project_actions( $post = '', $text = '' ) {

	$actions = get_the_hrb_dashb_project_actions( $post );

	if ( empty( $actions ) ) {
		return;
	}

	rcktshp_output_action_links($actions);
}

function rcktshp_the_hrb_dashboard_project_work_actions( $post = '', $proposal ='', $text = '' ) {

	$actions = get_the_hrb_dashboard_project_work_actions( $post, $proposal );

	if ( empty( $actions ) ) {
		return;
	}

	if ( empty( $text ) ) {
		$text = __( 'Actions', APP_TD );
	}

	if ( ! empty( $proposal ) ) {
		$proposal_id = $proposal->get_id();
	} else {
		$proposal_id = 0;
	}

	rcktshp_output_action_links($actions);
}

/**
 * Outputs the context dropdown with the active actions for the current user on a proposal.
 */
function rcktshp_the_hrb_dashboard_proposal_actions( $proposal, $post = '', $text = '' ) {

	$actions = get_the_hrb_dashboard_proposal_actions( $proposal, $post );

	if ( empty( $actions ) ) {
		return false;
	}

	if ( empty( $text ) ) {
		$text = __( 'Actions', APP_TD );
	}

	rcktshp_output_action_links($actions);

}

function rcktshp_the_hrb_dashboard_user_work_actions( $workspace, $post = '', $recipient = '', $text = '' ) {

	$actions = get_the_hrb_dashboard_user_work_actions( $workspace, $post, $recipient );

	//var_dump($actions);

	if ( empty( $actions ) ) {
		return;
	}

	if ( empty( $text ) ) {
		$text = __( 'Actions', APP_TD );
	}

	rcktshp_output_action_links($actions);
}


add_filter('wp_title', 'archive_titles');
/**
 * Modify <title> if on an archive page.
 *
 * @author Philip Downer <philip@manifestbozeman.com>
 * @link http://manifestbozeman.com
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version v1.0
 *
 * @param string $orig_title Original page title
 * @return string New page title
 */
function archive_titles($orig_title) {

	global $post;
	$post_type = $post->post_type;

	$types = array(
		array( //Create an array for each post type you wish to control.
			'post_type' => 'tutorials', //Your custom post type name
			'title' => 'Tutorials - RCKTSHP' //The title tag you'd like displayed
		),
		array( //Create an array for each post type you wish to control.
			'post_type' => 'project', //Your custom post type name
			'title' => 'Find Work - RCKTSHP' //The title tag you'd like displayed
		),
	);
	if ( is_archive() ) { //FIRST CHECK IF IT'S AN ARCHIVE

		//CHECK IF THE POST TYPE IS IN THE ARRAY
		foreach ( $types as $k => $v) {
			if ( in_array($post_type, $types[$k])) {
				return $types[$k]['title'];
			}
		}

	} else { //NOT AN ARCHIVE, RETURN THE ORIGINAL TITLE
		return $orig_title;
	}
}



include 'rcktshp-freelancer-profile-functions.php';
include 'rcktshp-custom-login-functions.php';

include 'rcktshp-instagram-functions.php';
include 'rcktshp-notification-functions.php';



/* Packages Functions */



function redirect($url)
{
	$string = '<script type="text/javascript">';
	$string .= 'window.location = "' . $url . '"';
	$string .= '</script>';

	echo $string;
}

/*Login Error Handle*/
add_action( 'wp_login_failed', 'aa_login_failed', 3, 10 ); // hook failed login

function aa_login_failed( $user) {
	// check what page the login attempt is coming from

	$referrer = $_SERVER['HTTP_REFERER'];

	// checks if the user entered an incorrect password, this is not handled by the Hirebee form processing function for some reason, so this is a fallback that I
	// created to avoid the display of a blank erroir page when the user failed login attempt
	if ( !wp_check_password($password, $user->user_pass, $user->ID) )
		return new WP_Error( 'incorrect_password', sprintf( __( '<strong>ERROR</strong>: The password you entered for the username <strong>%1$s</strong> is incorrect. <a href="%2$s">Lost your password?</a>' ),
			$username, wp_lostpassword_url() ) );

	// check that were not on the default login page
	if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') && $user!=null ) {
		// make sure we don't already have a failed login attempt
		if ( !strstr($referrer, '?login=failed' )) {
			// Redirect to the login page and append a querystring of login failed
			wp_redirect( $referrer . '?login=failed');
		} else {
			wp_redirect( $referrer );
		}

		exit;
	}
}

// Clean the up the image from wp_get_attachment_image()
add_filter( 'wp_get_attachment_image_attributes', function( $attr )
{
	if( isset( $attr['sizes'] ) )
		unset( $attr['sizes'] );

	if( isset( $attr['srcset'] ) )
		unset( $attr['srcset'] );

	return $attr;

}, PHP_INT_MAX );

// Override the calculated image sizes
add_filter( 'wp_calculate_image_sizes', '__return_false',  PHP_INT_MAX );

// Override the calculated image sources
add_filter( 'wp_calculate_image_srcset', '__return_false', PHP_INT_MAX );

// Remove the reponsive stuff from the content
remove_filter( 'the_content', 'wp_make_content_images_responsive' );


function wpdf_ssl_srcset( $wpdf_sources ) {
	if (is_admin()) {
		foreach ( $wpdf_sources as &$wpdf_source ) {
			$wpdf_source['url'] = set_url_scheme( $wpdf_source['url'], 'https' );
		}	//	fin boucle sur les images
	}	//	fin test si dans l'administration
	return $wpdf_sources;
}
add_filter( 'wp_calculate_image_srcset', 'wpdf_ssl_srcset' );
