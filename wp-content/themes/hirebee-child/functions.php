<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

/***********************************************************************
* Email Customizations
/***********************************************************************

/*********************** NOTES FOR DEV ********************************
* To change an email, locate the function in the parent theme > copy
* the function to the child theme's functions/php (this file) > remove
* the action in the above change_email function > add the new
* function below
*********************************************************************/

remove_filter('wp_mail', 'hrb_append_signature');
add_filter( 'wp_mail', 'hrb_child_append_signature' );
/**
 * Outputs the email signature
 *
 * @uses do_action() Calls 'hrb_email_signature'
 *
 */
function hrb_child_email_signature( $headers ) {

	// add line breaks considering the email content type
	if ( $headers ) {
		if ( is_array( $headers ) && isset( $headers['type'] ) ) {
			$headers = $headers['type'];
		}
		if ( false !== strpos( $headers, 'text/html' ) ) {
			$signature = wpautop( $signature );
		}
	} else {
		$signature = "\r\n" . $signature;
	}

	return apply_filters( 'hrb_child_email_signature', $signature, $headers );
}


/**
 * Prefix all emails that contain the blog name in the subject
 * 
 * MODS: the email footer styling now contains the signature.. this functon now does nothing! 
 */
function hrb_child_append_signature( $email ) {

	$headers = array();

	if ( ! empty( $email['headers'] ) ) {
		$headers = $email['headers'];
	}

	if ( get_bloginfo( 'name' ) && false !== strpos( $email['subject'], get_bloginfo( 'name' ) ) ) {
		$email['message'] .= hrb_child_email_signature( $headers );

	}

	return $email;
}



function rcktshp_custom_email($user_email, $email_subject, $message){

	//echo $user_email;
	ob_start();
	include("email_header.php");

	echo $message;

	include("email_footer.php");

	$message = ob_get_contents();
	ob_end_clean();

	$worked = wp_mail($user_email, $email_subject, $message);
}


function just_use_my_email(){
  return 'hello@rcktshp.com';
}

add_filter( 'wp_mail_from', 'just_use_my_email' );

function just_use_my_email_name(){
  return 'RCKTSHP Marketplace';
}

add_filter( 'wp_mail_from_name', 'just_use_my_email_name' );

add_action('init', 'change_email', 1);

	//add_action("appthemes_transaction_completed","debug_to_console");
		/**
		 * Send debug code to the Javascript console
		 */ 
function debug_to_console() {
		    if(is_array($data) || is_object($data))
			{
				echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
			} else {
				echo("<script>console.log('PHP: ".var_dump(get_defined_vars())."');</script>");
			}
		}


function change_email(){
	remove_action( 'hrb_new_project', 'hrb_new_project_notify_author', 15, 2 );
	add_action( 'hrb_new_project', 'hrb_child_new_project_notify_author', 15, 2 );

	remove_action( 'transition_post_status', 'hrb_maybe_notify_parties', 20, 3 );
	add_action( 'transition_post_status', 'hrb_child_maybe_notify_parties', 20, 3 );

	remove_action( 'transition_post_status', 'hrb_project_status_work_notify_parties', 10, 3 );
	add_action( 'transition_post_status', 'hrb_child_project_status_work_notify_parties', 10, 3 );
	add_action('transition_post_status', 'hrb_child_project_approval_notify', 10, 3);

	remove_action( 'hrb_transition_participant_status', 'hrb_work_status_notify_parties', 10, 4 );
	add_action( 'hrb_transition_participant_status', 'hrb_child_work_status_notify_parties', 10, 4 );

	remove_action( 'appthemes_bid_approved', 'hrb_proposal_notify_parties', 10 );
	add_action( 'appthemes_bid_approved', 'hrb_child_proposal_notify_parties', 10 );

	remove_action( 'hrb_new_candidate', 'hrb_new_candidate_notify', 10, 4 );
	add_action( 'hrb_new_candidate', 'hrb_child_new_candidate_notify', 10, 4 );

	remove_action( 'waiting_funds_workspace', 'hrb_escrow_waiting_funds_notify', 15, 2 );
	add_action( 'waiting_funds_workspace', 'hrb_child_escrow_waiting_funds_notify', 15, 2 );

	remove_action( 'appthemes_transaction_paid', 'hrb_escrow_funds_available_notify', 15 );
	add_action( 'appthemes_transaction_paid', 'hrb_child_escrow_funds_available_notify', 15); 

	remove_action( 'hrb_agreement_accepted', 'hrb_agreement_notify_parties', 10, 3 );
	add_action( 'hrb_agreement_accepted', 'hrb_child_agreement_notify_parties', 10, 3 );

	remove_action( 'appthemes_escrow_refunded', 'hrb_escrow_refund_notify', 15 );
	add_action( 'appthemes_escrow_refunded', 'hrb_child_escrow_refund_notify', 15 );

	remove_action( 'appthemes_dispute_opened', 'hrb_dispute_opened_notify_parties', 10, 3 );
	add_action( 'appthemes_dispute_opened', 'hrb_child_dispute_opened_notify_parties', 10, 3 );

	remove_action( 'appthemes_dispute_paid', 'hrb_dispute_resolved_notify_parties', 10, 3 );
	remove_action( 'appthemes_dispute_refunded', 'hrb_dispute_resolved_notify_parties', 10, 3 );
	add_action( 'appthemes_dispute_paid', 'hrb_child_dispute_resolved_notify_parties', 10, 3 );
	add_action( 'appthemes_dispute_refunded', 'hrb_child_dispute_resolved_notify_parties', 10, 3 );

	remove_action( 'hrb_unopened_disputes_refund_or_notify', 'hrb_unopened_disputes_refund_or_notify' );
	add_action( 'hrb_unopened_disputes_refund_or_notify', 'hrb_child_unopened_disputes_refund_or_notify' );

	remove_action( 'appthemes_escrow_completed', 'hrb_escrow_paid_notify', 15 );
	add_action( 'appthemes_escrow_completed', 'hrb_child_escrow_paid_notify', 15 );

	remove_action( 'hrb_new_plan_order', 'hrb_send_order_receipt' );
	add_action( 'hrb_new_plan_order', 'hrb_child_send_order_receipt' );

	remove_action( 'hrb_no_agreement', 'hrb_no_agreement_notify_parties', 10, 3 );
	add_action( 'hrb_no_agreement', 'hrb_child_no_agreement_notify_parties', 10, 3 );


	remove_action( 'hrb_updated_project_terms', 'hrb_terms_modified_notify_parties', 10, 3 );
	add_action( 'hrb_updated_project_terms', 'hrb_child_terms_modified_notify_parties', 10, 3 );

	remove_action( 'appthemes_transaction_completed', 'hrb_send_order_receipt_confirmation' );
	add_action( 'appthemes_transaction_completed', 'hrb_child_send_order_receipt_confirmation' );

	remove_action( 'appthemes_new_user_review', 'hrb_new_user_review_notify_parties', 10, 2 );
	add_action( 'appthemes_new_user_review', 'hrb_child_new_user_review_notify_parties', 10, 2 );

	remove_action( 'hrb_agreement_canceled', 'hrb_agreement_canceled_notify_parties', 10, 2 );
	add_action( 'hrb_agreement_canceled', 'hrb_child_agreement_canceled_notify_parties', 10, 2 );

	remove_action( 'appthemes_transaction_failed', 'hrb_order_canceled_notify_author' );
	add_action( 'appthemes_transaction_failed', 'hrb_child_order_canceled_notify_author' );

	remove_action( 'hrb_updated_user_credits', 'hrb_credits_added_notify_user', 10, 3 );
	add_action( 'hrb_updated_user_credits', 'hrb_child_credits_added_notify_user', 10, 3 );

	// In the future when we want to add the different tax amounts to each order depending 
	// on where the purchaser lives, we can use this function to do so!
	add_action( 'appthemes_create_order', 'rcktshp_payments_add_tax', 99 );



}


/**
 * Notify author on his new posted project.
 * Notification + Email
 */
function hrb_child_new_project_notify_author( $post_id, $order = '' ) {

	$post = get_post( $post_id );

	$recipient = get_user_by( 'id', $post->post_author );

	$project_link = html_link( get_permalink( $post ), $post->post_title );

	$content = sprintf(
		__( 'Hello %2$s, %1$s
		Your project %3$s was submitted with success.', APP_TD ), "\r\n\r\n", $recipient->display_name, $project_link
	);

	if ( ! empty( $order ) && $order->get_total() > 0 ) {

		$subject = sprintf( __( "Your project - %s - was submitted and is waiting payment", APP_TD ), $project_link );
		$content .= _hrb_order_summary_email_body( $order );
		$content .= "\r\n\r\n" . __( "The Order is waiting payment. You'll be notified once the payment clears.", APP_TD );

	} else {

		if ( 'pending' == $post->post_status ) {
			$subject = sprintf( __( "Your project - %s - was submitted and is waiting moderation", APP_TD ), $project_link );
			$content .= "\r\n\r\n" . __( "It will be reviewed by our team and we’ll notify you once it has been approved.", APP_TD );
		} else {
			$subject = sprintf( __( "Your project - %s - was submitted and is now live!", APP_TD ), $project_link );
			$content .= "\r\n\r\n" . __( "It is now live and publicly visible on our site.", APP_TD );
		}
	}

	$participant = array(
		'recipient' => $recipient->ID,
		'message' => $subject,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject ),
			'project_id' => $post->ID,
			'action' => get_permalink( $post ),
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta'] );
}

/**
 * Notify project authors on project approval.
 * Notification + Email
 *
 */
function hrb_child_project_approval_notify($new_status, $old_status, $post ) {


	if ( 'publish' == $new_status && 'pending' == $old_status ) {

		$recipient = get_user_by( 'id', $post->post_author );

		$project_link = html_link( get_permalink( $post ), $post->post_title );

		$subject_message = sprintf( __( "Your project - %s - has been approved!", APP_TD ), $project_link );

		$content = sprintf(
			__( 'Hello %2$s, %1$s
			Your project %3$s, has been approved and is now available and accepting proposals on the RCKTSHP Marketplace! %1$s', APP_TD ), "\r\n\r\n", $recipient->display_name, $project_link
		);

		$blog_link = html_link('http://projects.rcktshp.com/attract-freelancers/', 'tips and tricks' );
		$edit_project_link = html_link( get_permalink( $post ), 'editing your project');

		$content .= sprintf( __('Please review your project to make sure all details and student expectations are included in the posting. You can make any changes by %1$s. %2$s', APP_TD), $edit_project_link, "\r\n\r\n" );

		$content .= sprintf( __("Check out our %s for how to attract freelance talent to your project. %2$s", APP_TD), $blog_link, "\r\n\r\n");

		$faq_link = html_link('http://projects.rcktshp.com/faq/', 'FAQ');

		$content .= sprintf( __("We're here to answer any questions you may have. Please feel free to contact us and visit our %1$s with any inquiries. ", APP_TD), $faq_link , "\r\n\r\n");

		$participant = array(
			'recipient' => $recipient->ID,
			'message' => $subject_message,
			'send_mail' => array(
				'content' => wpautop( $content ),
			),
			'meta' => array(
				'subject' => wp_strip_all_tags( $subject_message ),
				'project_id' => $post->ID,
				'action' => get_permalink( $post ),
			),
		);

		appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
	
	}

}

# Proposals

/**
 * Notify employer and candidate on new proposals.
 * Notification + Email
 */
function hrb_child_proposal_notify_parties( $proposal ) {

	### edited Proposals

	if ( strtotime($proposal->get_date() ) != $proposal->updated ) {
		hrb_child_edited_proposal_notify_parties( $proposal );
		return;
	}

	### new Proposals

	$proposal = hrb_get_proposal( $proposal );

	$candidate = get_user_by( 'id', $proposal->user_id );
	$employer = get_user_by( 'id', $proposal->project->post_author );

	$project_link = html_link( get_permalink( $proposal->project->ID ), $proposal->project->post_title );
	$proposal_link = html_link( get_the_hrb_proposal_url( $proposal ), __( 'proposal', APP_TD ) );
	$browse_link = "<a href='" . network_site_url('projects') . "'>Browse Projects</a>";

	### notify candidate

	$subject_message = sprintf( __( 'Your %1$s for - %2$s - was sent to \'%3$s\'', APP_TD ), $proposal_link, $project_link, $employer->display_name );

	$content = sprintf(
		__( 'Hello %2$s,%1$s
		your %3$s for %4$s, was created successfully and sent to \'%5$s\'.', APP_TD ), "\r\n\r\n", $candidate->display_name, $proposal_link, $project_link, $employer->display_name
	);

	$content += "<br />You will be notified if you have been selected and assigned to work on this project. Good Luck!";
	$content += sprintf( __("Continue to %s for more work exerience opportunities", APP_TD),$browse_link);

	$participant = array(
		'recipient' => $candidate->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $proposal->project->ID,
			'action' => get_the_hrb_proposal_url( $proposal ),
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );

	### notify employer

	$subject_message = sprintf( __( 'User \'%1$s\' has just sent you a %2$s for - %3$s -', APP_TD ), $candidate->display_name, $proposal_link, $project_link );

	$content = sprintf(
		__( 'Hello %2$s,%1$s
		User %3$s has just sent you a %4$s for %5$s.', APP_TD ), "\r\n\r\n", $employer->display_name, $candidate->display_name, $proposal_link, $project_link
	);

	$participant = array(
		'recipient' => $employer->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $proposal->project->ID,
			'action' => get_the_hrb_proposal_url( $proposal ),
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'proposal', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
}

/**
 * Notify employer and candidate on edited proposals.
 * Notification + Email
 */
function hrb_child_edited_proposal_notify_parties( $proposal ) {

	$proposal = hrb_get_proposal( $proposal );

	$candidate = get_user_by( 'id', $proposal->user_id );
	$employer = get_user_by( 'id', $proposal->project->post_author );

	$project_link = html_link( get_permalink( $proposal->project->ID ), $proposal->project->post_title );
	$proposal_link = html_link( get_the_hrb_proposal_url( $proposal ), __( 'proposal', APP_TD ) );
	$browse_link = html_link(network_site_url('projects'), 'Browse Projects');
	### notify candidate

	$subject_message = sprintf( __( 'Your %1$s for - %2$s - was submitted succesfully.', APP_TD ), $proposal_link, $project_link );


	$content = sprintf(
		__( 'Hello %2$s,%1$s
		Your %3$s for %4$s, was created succesfully and sent to \'%5$s\'. <br /><br /> You will be notified if you have been selected to work on this project. <br /><br /> Good Luck! <br /><br />', APP_TD ),
		"\r\n\r\n", $candidate->display_name, $proposal_link, $project_link, $employer->display_name
	);
	$content .= "Continue to " . $browse_link . " for more work experience opportunities.";

	$participant = array(
		'recipient' => $candidate->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $proposal->project->ID,
			'action' => get_the_hrb_proposal_url( $proposal ),
		),
	);

	//removed email array
	appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta'] );

	### notify employer
	$proposal_amount = $proposal->amount;
	$proposal_message = strip_tags($proposal->comment_content);
	$project_id = strip_tags($proposal->comment_post_ID);
	$proposals_link = "<a href='" . network_site_url('dashboard/proposals/?project_id=' . $project_id) . "'>all proposals</a>";


	$subject_message = sprintf( __( '%s has submitted a proposal for - %s ', APP_TD ), $candidate->display_name, $project_link );


	$content = sprintf(
		__( 'Hello %2$s,%1$s
		User %3$s has just submitted a %4$s for %5$s.', APP_TD ),
		"\r\n\r\n", $employer->display_name, $candidate->display_name, $proposal_link, $project_link
	);
	$content .= sprintf( __('<br /><br /><u>Proposal</u>:<br /> $%s <br /> %s', APP_TD), $proposal_amount, $proposal_message);
	$content .= sprintf( __('<br />Review %s\'s %s', APP_TD), $candidate->display_name, $proposal_link);
	$content .= sprintf( __(' or view %s for your project.' ,APP_TD), $proposals_link);

	$participant = array(
		'recipient' => $employer->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $proposal->project->ID,
			'action' => get_the_hrb_proposal_url( $proposal ),
		),
	);

	//removed ', array( 'send_mail' => $participant['send_mail'] )' to sicrumvent email from sending
	appthemes_send_notification( $participant['recipient'], $participant['message'], 'proposal', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
}




/**
 * Notify employer and proposal author on a candidate selection.
 * Notification + Email
 */
function hrb_child_new_candidate_notify( $p2p_id, $user_id, $post_id, $proposal ) {

	$candidate = get_user_by( 'id', $user_id );
	$employer = get_user_by( 'id', $proposal->project->post_author );

	$project_link = html_link( get_permalink( $post_id ), $proposal->project->post_title );
	$terms_link = html_link( get_the_hrb_proposal_url( $proposal ), __( 'terms', APP_TD ) );

	### notify candidate

	$subject_message = sprintf( __( "Congratulations! %s selected you as a candidate to work on - %s -", APP_TD ),$employer->display_name, $project_link );



	$content = sprintf(
		__( 'Hello %2$s,%1$s
		Congratulations! %3$s selected you as a candidate for %4$s. %1$s', APP_TD ),
		"\r\n\r\n", $candidate->display_name, $employer->display_name, $project_link, $terms_link
	);
	$content .= "\r\n" . sprintf( __( 'You and %1$s can now specify additional terms and project details. Please be as specific as possible as these %2$s will be officially documented in the project workspace, and will be referenced throughout the duration of the project. %3$s', APP_TD ), $employer->display_name, $terms_link, "\r\n\r\n" );

	$content .= "Before the project is officially assigned, you'll need to mutually agree on the project terms. \r\n\r\n" ;

	$participant = array(
		'recipient' => $candidate->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $post_id,
			'action' => get_the_hrb_proposal_url( $proposal ),
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'action', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );

	### notify employer

	$subject_message = sprintf( __( 'You\'ve selected user %1$s as a candidate for working on - %2$s -', APP_TD ), $candidate->display_name, $project_link );

	$content = sprintf(
		__( 'Hello %2$s,%1$s
		You\'ve selected %3$s as a candidate to work on %4$s. We\'re happy to hear that you\'ve found the right person for the job! %1$s', APP_TD ),
		"\r\n\r\n", $employer->display_name, $candidate->display_name, $project_link, $terms_link
	);
	$content .= sprintf( __('Before %s is officially assigned to your project, you\'ll need to come to a mutual agreement on the project %s.', APP_TD), $candidate->display_name, $terms_link);

	$participant = array(
		'recipient' => $employer->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $post_id,
		),
	);
	//removed ', array( 'send_mail' => $participant['send_mail'] )' to circumvent email from sending
	appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta'] );
}

global $last_project_cancelled ;
add_action('transition_post_status', 'email_users_on_canceled', 20, 3);

function email_users_on_canceled($new_status, $old_status, $post){
	if( $new_status == HRB_PROJECT_STATUS_CANCELED ){

		$employer= get_user_by( 'id', get_defined_vars($post)->post_author );

		$project_link = html_link( get_permalink( $post ), $post->post_title );
		$project = hrb_get_project( $post->ID );

		$participants = hrb_get_post_participants( $project->ID );

		if ( $participants ) {

			$users = $participants->results;
			if ( ! $users ) {
				if ( ! empty( $users ) ) {
					$users = $users->results;
				}
			}
		}
		if($project !=  $last_project_cancelled){
			$email = $users[0]->user_email;
			$subject = sprintf( __('[RCKTSHP Marketplace]%1$s A refund was issued for work on %2$s', APP_TD), $employer, $post->post_title );
			$message = sprintf( __('Hello %5$s, <br /><br /> The project %2$s has been canceled. <br /><br /> Since the project has been discontinued, the employer will be issued a full refund and due to this, you will not be paid for the project. The project is now closed, and all participants can review each other’s work in the project workspace. ', APP_TD), $employer, $project_link,  "\r\n\r\n", $post->post_title, $users[0]->user_login );
			$message .= '<br /><br />  If you do not agree with the employer’s decision to cancel the project, we strongly encourage you to contact the employer to identify, in detail, any project discrepancies that may have been reason for cancellation. In this situation, the disagreement is solely between you and the employer, who should negotiate a solution separately from RCKTSHP. <br /><br /> Please refer to the Disputes section in the <a href="http://projects.rcktshp.com/terms/">Terms of Use<a/>. Visit our <a href="http://projects.rcktshp.com/faq/">FAQ</a> or <a href="mailto:hello@rcktshp.com">Contact Us</a> with further inquiries.';

			rcktshp_custom_email($email, $subject, $message);
			 
			
			$last_project_cancelled = $project;
		}
	}

		if( $new_status == HRB_PROJECT_STATUS_CLOSED_INCOMPLETE ){

		$employer= get_user_by( 'id', get_defined_vars($post)->post_author );

		$project_link = html_link( get_permalink( $post ), $post->post_title );
		$project = hrb_get_project( $post->ID );

		$participants = hrb_get_post_participants( $project->ID );

		if ( $participants ) {

			$users = $participants->results;
			if ( ! $users ) {
				if ( ! empty( $users ) ) {
					$users = $users->results;
				}
			}
		}

		if($project !=  $last_project_incomplete){
			$email = $users[0]->user_email;
			$subject = sprintf( __('[RCKTSHP Marketplace] The project - %2$s - has been marked \'Incomplete\'', APP_TD), $employer, $post->post_title);
			$message = sprintf( __('Hello %5$s, <br /><br />The employer may require further adjustments to %2$s to meet your documented agreed upon terms. At this time, we strongly encourage you to contact the employer to identify, in detail, any project discrepancies and try to negotiate a resolution to avoid starting a dispute.', APP_TD), $employer, $project_link,  "\r\n\r\n", $post->post_title, $users[0]->user_login );
			$message .= '<br /><br />  Since the project was not considered completed, the employer may be entitled to a full refund. If you do not agree with the employer’s decision to end the project, and have contacted the employer but not reached a resolution, you are entitled to open a dispute within the next 5 days. <br /><br /> Please refer to the Disputes section in the <a href="http://projects.rcktshp.com/terms/">Terms of Use<a/>. Visit our <a href="http://projects.rcktshp.com/faq/">FAQ</a> or <a href="mailto:hello@rcktshp.com">Contact Us</a> with further inquiries.';

			rcktshp_custom_email($email, $subject, $message);

				$participant = array(
					'recipient' => $employer->ID,
					'message' => $subject_message,
					'send_mail' => array(
						'content' => wpautop( $content ),
					),
					'meta' => array(
						'subject' => wp_strip_all_tags( $subject_message ),
						'project_id' => $post_id,
					),
				);

			appthemes_send_notification( $users[0]->ID, $subject, 'action', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
			 
			$last_project_incomplete = $project;
		}
	}
}

/**
 * Send notifications on post status changes.
 */
function hrb_child_maybe_notify_parties( $new_status, $old_status, $post ) {

	if ( HRB_PROJECTS_PTYPE != $post->post_type ) {
		return;
	}

	
	elseif ( 'publish' == $new_status && 'pending' == $old_status ) {
		hrb_child_project_approval_notify( $post );
		
		
	}

	// notify authors, candidates and participantes when projects expire or are canceled
	elseif ( in_array( $new_status, array( HRB_PROJECT_STATUS_EXPIRED, HRB_PROJECT_STATUS_CANCELED, HRB_PROJECT_STATUS_CANCELED_TERMS, 'publish' ) )  &&
			 in_array( $old_status, array( 'publish', HRB_PROJECT_STATUS_WORKING, HRB_PROJECT_STATUS_TERMS,  HRB_PROJECT_STATUS_CLOSED_INCOMPLETE ) ) ) {
		hrb_child_status_change_notify_parties( $post, $new_status, $old_status );
		//not  here yet
	}

}

/**
 * Notify employer and candidate on a failed agreement.
 * Notification + Email
 */
function hrb_child_no_agreement_notify_parties( $proposal, $sender, $decision ) {

	$proposal = hrb_get_proposal( $proposal );

	$project_link = html_link( get_permalink( $proposal->project->ID ), $proposal->project->post_title );
	$terms_link = html_link( get_the_hrb_proposal_url( $proposal ), __( 'terms', APP_TD ) );

	if ( $sender->ID == $proposal->project->post_author ) {
		// employer
		$recipient = get_user_by( 'id', $proposal->get_user_id() );
	} else {
		// candidate
		$recipient = get_user_by( 'id', $proposal->project->post_author );
	}

	if ( HRB_TERMS_PROPOSE == $decision ) {
		$decision = __( 'proposed new', APP_TD );
	} else {
		$decision = strtolower( hrb_get_agreement_decision_verbiage( $decision ) );
	}

	$decision_pretty = sprintf( '%1$s %2$s', $decision, $terms_link );

	### notify recipient

	$subject_message = sprintf( __( 'User \'%1$s\' %2$s terms for - %3$s -', APP_TD ), $sender->display_name, $decision, $project_link );

	$content = sprintf(
		__( 'Hello %2$s,%1$s
		User %3$s %4$s terms for %5$s.', APP_TD ), "\r\n\r\n", $recipient->display_name, $sender->display_name, $decision, $project_link
	);

	$participant = array(
		'recipient' => $recipient->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $proposal->project->ID,
			'action' => get_the_hrb_proposal_url( $proposal ),
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'action', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );

	### notify sender

	$subject_message = sprintf( __( 'You\'ve %1$s for - %2$s -', APP_TD ), $decision, $project_link );

	$content = sprintf(
		__( 'Hello %2$s,%1$s
		You\'ve %3$s for %4$s.', APP_TD ), "\r\n\r\n", $sender->display_name, $decision, $project_link
	);

	$participant = array(
		'recipient' => $sender->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $proposal->project->ID,
			'action' => get_the_hrb_proposal_url( $proposal ),
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta']);
}

/**
 * Notify participants on workspace waiting funds.
 * Notification + Email
 */
function hrb_child_escrow_waiting_funds_notify( $workspace_id, $workspace ) {

	$project = hrb_p2p_get_workspace_post( $workspace_id );

	$employer = get_user_by( 'id', $workspace->post_author );

	$workspace_link = html_link( hrb_get_workspace_url( $workspace_id ),  $project->post_title );

	$transfer_funds_link = html_link( hrb_get_workspace_transfer_funds_url( $workspace_id ), __( 'Transfer funds', APP_TD ) );



	### notify freelancer

	$participants = hrb_p2p_get_workspace_participants( $workspace_id );
	if ( ! $participants ) {
		return;
	}

	foreach( $participants->results as $worker ) {
		$subject_message = sprintf( __( 'Workspace for - %1$s - is waiting for funds. ', APP_TD ), $workspace_link );

		$content = sprintf(
			__( 'Hello %1$s,%2$s
			Good news! Both you and %3$s have read and agreed to each other\'s terms for %4$s. The final step is to await the transfer of funds to RCKTSHP from %3$s so we can ensure that you will be paid accordingly. %5$s', APP_TD ),
			$worker->display_name, "\r\n\r\n", $employer->display_name, $workspace_link, "\r\n\r\n"
		);

		$content .=  sprintf( __('Do not start working on the project until you recieve a notificaiton that %1$s has funded the workspace.', APP_TD), $employer->display_name);;

		$participant = array(
			'recipient' => $worker->ID,
			'message' => $subject_message,
			'send_mail' => array(
				'content' => wpautop( $content ),
			),
			'meta' => array(
				'subject' => wp_strip_all_tags( $subject_message ),
				'project_id' => $project->ID,
				'action' => hrb_get_workspace_url( $workspace_id ),
			),
		);

		appthemes_send_notification( $participant['recipient'], $participant['message'], 'action', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
	}

		### notify employer

			$participants = hrb_p2p_get_workspace_participants( $workspace_id );
			if ( ! $participants ) {
				return;
			}

		foreach( $participants->results as $worker ) {

			$subject_message = sprintf( __('Your project - %1$s - is awaiting funds', APP_TD), $workspace_link, $worker->display_name);

			$content = sprintf(
				__( 'Hello %1$s,%2$s
				Good news! Both you and %5$s have read and agreed to each other\'s terms. %2$s The final step is to %4$s to RCKTSHP so we can ensure your freelancer will be paid accordingly. %2$s  %5$s has been informed not to start working on the project until funds have been transfered to the workspace. ', APP_TD ),
				$employer->display_name, "\r\n\r\n", $workspace_link, $transfer_funds_link, $worker->display_name
			);

			$participant = array(
				'recipient' => $employer->ID,
				'message' => $subject_message,
				'send_mail' => array(
					'content' => wpautop( $content ),
				),
				'meta' => array(
					'subject' => wp_strip_all_tags( $subject_message ),
					'project_id' => $project->ID,
					'action' => hrb_get_workspace_transfer_funds_url( $workspace_id ),
				),
			);

			appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
		}

}

/**
 * Notify participants on funds available.
 * Notification + Email
 */
function hrb_child_escrow_funds_available_notify( $order ) {

	if ( ! $order->is_escrow() ) {
		return;
	}

	$workspace = $order->get_item();

	if ( empty( $workspace ) ) {
		return;
	}

	$workspace_id = $workspace['post_id'];

	$employer = get_user_by( 'id', $workspace['post']->post_author );

	$project = hrb_p2p_get_workspace_post( $workspace_id );
	$workspace_link = html_link( hrb_get_workspace_url( $workspace_id ), $project->post_title );

	### notify employer

	$subject_message = sprintf( __( "Funds for work on - %s - are available ", APP_TD ), $workspace_link );

	$content = sprintf(
		__( 'Hello %1$s,%2$s
		Your funds for %3$s were succefully transferred to our escrow account.%2$s
		Work can start!', APP_TD ),
		$employer->display_name, "\r\n\r\n", $workspace_link
	);

	$participant = array(
		'recipient' => $employer->ID,
		'message' => $subject_message,
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $project->ID,
			'action' => hrb_get_workspace_url( $workspace_id ),
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta'] );


	# notify freelancer

	$participants = hrb_p2p_get_workspace_participants( $workspace_id );
	if ( ! $participants ) {
		return;
	}

	$receivers = $order->get_receivers();

	foreach( $participants->results as $worker ) {
		$subject_message = sprintf( __( 'Funds for work on - %1$s - are available', APP_TD ), $workspace_link );

		$amount = $receivers[ $worker->ID ];
		$workspace = html_link(hrb_get_workspace_url( $workspace_id ), 'workspace');

		$content = sprintf(
			__( 'Hello %1$s,%2$s
			Congratulations! Funds for %3$s were successfully transfered. You have officially been assigned to %4$s, and your work status has been updated to \'Working\'. %2$s A %5$s between you and %6$s has been created, and is accessable in your dashboard. In the workspace you can find project details, notes, agreed terms, contact information, and update your work status. %2$s <b>What Now?</b> %2$s We encourage frequent communication between you and %6$s. %2$s Meet with the employer face-to-face to discuss details, exchange relavent tools, establish a timeline, and create a project scope document. %2$s If you have any further inquiries, please visit our <a href="http://projects.rcktshp.com/faq/">FAQ</a> or feel free to <a href="mailto:support@rcktshp.com">contact us</a>', APP_TD ),
			$worker->display_name, "\r\n\r\n", $workspace_link, $project->post_title, $workspace, $employer->display_name
		);

		$participant = array(
			'recipient' => $worker->ID,
			'message' => $subject_message,
			'send_mail' => array(
				'content' => wpautop( $content ),
			),
			'meta' => array(
				'subject' => wp_strip_all_tags( $subject_message ),
				'project_id' => $project->ID,
				'action' => hrb_get_workspace_url( $workspace_id ),
			),
		);

		appthemes_send_notification( $participant['recipient'], $participant['message'], 'action', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
	}

}

# Agreement Discussion

/**
 * Notify employer and candidate on project assignment.
 * Notification + Email
 */
function hrb_child_agreement_notify_parties( $proposal, $user, $workspace_id ) {

	$proposal = hrb_get_proposal( $proposal );

	$candidate = get_user_by( 'id', $proposal->user_id );
	$employer = get_user_by( 'id', $proposal->project->post_author );

	$project_link = html_link( get_permalink( $proposal->project->ID ), $proposal->project->post_title );
	$workspace_url = hrb_get_workspace_url( $workspace_id );
	$workspace_link = html_link( $workspace_url, __( 'workspace', APP_TD ) );


	### notify candidate 
	### NOT EXECUTED 

	$subject_message = sprintf( __( 'Project - %1$s - from %2$s was officially assigned to you!', APP_TD ), $project_link, $employer->display_name );

	$content = sprintf(
		__( 'Hello %2$s,%1$s
		Congratulations! Project %3$s, from \'%4$s\', has been officially assigned to you!%1$s %1$s
		A %5$s for the project is now available on your dashboard. In your workspace you can find project details, notes, agreed terms, access contact information, and update your work status. %1$s Please wait for notification that the funds are available for your project before you begin working. Payment will be disbursed upon project completion. %1$s If you have any further inquiries, please visit our <a href="http://projects.rcktshp.com/faq/">FAQ</a> or feel free to <a href="mailto:hello@rcktshp.com">contact us</a>. We hope you enjoy working with %4$s', APP_TD ),
		"\r\n\r\n", $candidate->display_name, $project_link, $employer->display_name, $workspace_link
	);

	$participant = array(
		'recipient' => $candidate->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $proposal->project->ID,
			'action' => $workspace_url,
		),
	);

	//appthemes_send_notification( $participant['recipient'], $participant['message'], 'action', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );


	### notify sender

	$subject_message = sprintf( __( 'Your project - %1$s - was officially assigned to %2$s and is awaiting funds', APP_TD ), $project_link, $candidate->display_name );

	$content = sprintf(
		__( 'Hello %2$s,%1$s
		Congratulations! %3$s has officially been assigned to \'%4$s\'.%1$s %1$s
		A %5$s for the project is now available on your dashboard. In your workspace you can find project details, notes, agreed terms, access contact information, and check the freelancer’s work status. Payment will be disbursed upon project completion. %1$s The freelancer has been informed not to begin working on the project until they recieve notification that the funds for the project have been transfered by you. %1$s Please contact the student with any additional information and questions about the project. If you have any further inquiries, please visit our <a href="http://projects.rcktshp.com/faq/">FAQ</a> or feel free to <a href="mailto:hello@rcktshp.com">contact us</a>. We hope you enjoy working with %4$s.', APP_TD ),
		"\r\n\r\n", $employer->display_name, $project_link, $candidate->display_name, $workspace_link
	);

	$participant = array(
		'recipient' => $employer->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $proposal->project->ID,
			'action' => $workspace_url,
		),
	);

	//appthemes_send_notification( $participant['recipient'], $participant['message'], 'action', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
	

	### notify proposal authors about project assignment

	$project =  $proposal->project;

	$users = array();

	$proposals = hrb_get_proposals_by_post( $project->ID );

	foreach( $proposals['results'] as $other_proposal ) {

		$user = get_user_by( 'id', $other_proposal->get_user_id() );
		if ( $user->ID != $proposal->get_user_id() ) {
			$users[] = $user;
		}
	}

	foreach( $users as $worker ) {

		$subject_message = sprintf( __( 'Project - %1$s - owned by \'%2$s\' was assigned to another user', APP_TD ), $project_link, $employer->display_name );

		$content = sprintf(
			__( 'Hello %2$s,%1$s
			Project %3$s, owned by \'%4$s\' was assigned to another user. %1$s Please continue to <a href="http://projects.rcktshp.com/projects/">browse projects</a> for other work experience opportunities. %1$s', APP_TD ),
			"\r\n\r\n", $worker->display_name, $project_link, $employer->display_name
		);

		$participant = array(
			'recipient' => $worker->ID,
			'message' => $subject_message,
			'send_mail' => array(
				'content' => wpautop( $content ),
			),
			'meta' => array(
				'subject' => wp_strip_all_tags( $subject_message ),
				'project_id' => $project->ID,
			),
		);

		appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
	}
}

/**
 * Notify participants on refund request.
 * Notification + Email
 */
function hrb_child_escrow_refund_notify( $order ) {

	$workspace = $order->get_item();

	if ( empty( $workspace ) ) {
		return;
	}

	$workspace_id = $workspace['post_id'];

	$project = hrb_p2p_get_workspace_post( $workspace_id );

	$employer = get_user_by( 'id', $workspace['post']->post_author );

	$workspace_link = html_link( hrb_get_workspace_url( $workspace_id ), $project->post_title );

	### notify employer

	$subject_message = sprintf( __( 'You were refunded for - %1$s -', APP_TD ), $project->post_title  );

	$content = sprintf(
		__( 'Hello %1$s,%2$s You have been issued a full refund for %3$s. The student has been encouraged to leave a review for the project in the dashboard. Please visit our <a href="http://projects.rcktshp.com/faq/">FAQ</a> or <a href="mailto:hello@rcktshp.com">Contact Us</a> with further inquiries.'
			, APP_TD ),
		$employer->display_name, "\r\n\r\n", $workspace_link
	);

	$participant = array(
		'recipient' => $employer->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $project->ID,
			'action' => hrb_get_workspace_transfer_funds_url( $workspace_id ),
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );

	$participants = hrb_p2p_get_workspace_participants( $workspace_id );
	if ( ! $participants ) {
		return;
	}

	$receivers = $order->get_receivers();

	foreach( $participants->results as $worker ) {
		$subject_message = sprintf( __( 'A refund was issued for work on - %1$s -', APP_TD ), $project->post_title  );

		$content = sprintf(
			__( 'Hello %1$s,%2$s
			A refund was issued to %4$s, and because of this you will not be paid for work on %3$. You are encouraged to leave a review for the employer in the project %3$s. %2$s In this situation, the disagreement is solely between you and the employer, who should negotiate a solution separately from RCKTSHP. Please refer to the Disputes section in the <a href="http://projects.rcktshp.com/terms/">Terms of Use</a>. Visit our <a href="http://projects.rcktshp.com/faq/">FAQ</a> or <a href="mailto:hello@rcktshp.com">Contact Us</a> with further inquiries. 
			', APP_TD ),
			$worker->display_name, "\r\n\r\n", $workspace_link, $employer->display_name
		);

		$participant = array(
			'recipient' => $worker->ID,
			'message' => $subject_message,
			'send_mail' => array(
				'content' => wpautop( $content ),
			),
			'meta' => array(
				'subject' => wp_strip_all_tags( $subject_message ),
				'project_id' => $project->ID,
				'action' => hrb_get_workspace_url( $workspace_id ),
			),
		);
		appthemes_send_notification( $participant['recipient'], $participant['message'], 'action', $participant['meta'] );
	}

}

/**
 * Notify participants on a new dispute.
 *
 * @since 1.3
 */
function hrb_child_dispute_opened_notify_parties( $dispute_id, $p2p, $workspace ) {

	$dispute = get_post( $dispute_id );

	$disputer = get_user_by( 'id', $dispute->post_author );
	$disputee = get_user_by( 'id', $workspace->post_author );

	$project = hrb_p2p_get_workspace_post( $workspace->ID );

	$project_link = html_link( get_permalink( $project->ID ), $project->post_title );
	$workspace_link = html_link( hrb_get_workspace_url( $workspace->ID ), __( 'workspace', APP_TD ) );
	$dispute_link = html_link( hrb_get_workspace_url( $workspace->ID ) . '#disputes', __( 'communication channel', APP_TD ) );

	$note =  "\r\n\r\n" . sprintf(
		__( 'A new %2$s is now opened for both participants and our team to be able to discuss the decision. We will aim to make a resolution decision on behalf of both parties.%1$s
		If a mutual resolution is agreed between both parties meanwhile, please inform us and we will close the dispute in line with the mutual agreement.', APP_TD ),
		"\r\n\r\n", $dispute_link
	);

	### notify disputee

	$subject_message = sprintf( __( "%s opened a dispute on - %s -", APP_TD ), $disputer->display_name, $project_link );

	$content = sprintf(
		__( 'Hello %2$s,%1$s
		Freelancer %3$s does not agree with your decision to end %4$s and has opened a dispute. A new communication channel is now open in the %5$s for both participants to be able to discuss the decision. Before proceeding, please review the Dispute Resolution Process found within the RCKTSHP <a href="http://projects.rcktshp.com/escrow-terms/">Escrow Payment Terms for Fixed Price Projects</a>. %1$s At this time, we ask that you take note of the breach date, record payment information and agreements, and keep all supporting documentation to your claim. %1$s We strongly recommend that you work with the student to negotiate a resolution. If a mutual resolution is agreed between both parties, please inform us by email at <a href="mailto:disputes@rcktshp.com">disputes@rcktshp.com</a>, and we will close the dispute in line with the mutual agreement. Please visit our <a href="http://projects.rcktshp.com/faq/">FAQ</a> or Contact Us with further inquiries. ', APP_TD ),
		"\r\n\r\n", $disputee->display_name, $disputer->display_name, $project_link, $workspace_link
	) ;

	$content .= "\r\n\r\n" . sprintf( __( "Visit the project %s.", APP_TD ), $workspace_link );

	$participant = array(
		'recipient' => $disputee->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $project->ID,
			'action' =>  hrb_get_workspace_url( $workspace->ID ),
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'action', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );


	### notify disputer

	$subject_message = sprintf( __( "Your dispute on - %s - is now opened", APP_TD ), $project_link );

	$content = "\r\n\r\n" . sprintf(
		__( 'Hello %2$s,%1$s
		You have disagreed with %6$s’s decision to end %3$s and you have opened a dispute. A new communication channel is now open in the %4$s for both participants to be able to discuss the decision. Before proceeding, please review the Dispute Resolution Process found within the RCKTSHP <a href="http://projects.rcktshp.com/escrow-terms/">Escrow Payment Terms for Fixed Price Projects</a>. %1$s At this time, we ask that you take note of the breach date, record payment information and agreements, and keep all supporting documentation to your claim. %1$s We strongly recommend that you work with the employer to negotiate a resolution. If a mutual resolution is agreed between both parties, please inform us by email at <a href="mailto:disputes@rcktshp.com">disputes@rcktshp.com</a>, and we will close the dispute in line with the mutual agreement. %1$s Please visit our <a href="http://projects.rcktshp.com/faq/">FAQ</a> or Contact Us with further inquiries. ', APP_TD ),
		"\r\n\r\n", $disputer->display_name, $project_link, $workspace_link, $note, $disputee->display_name ) ;

	$participant = array(
		'recipient' => $disputer->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $project->ID,
			'action' =>  hrb_get_workspace_url( $workspace->ID ),
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
}

/**
 * Notify participants on a dispute resolution.
 *
 * @since 1.3
 */
function hrb_child_dispute_resolved_notify_parties( $dispute, $p2p_post, $status ) {

	$workspace = appthemes_get_dispute_p2p_post( $dispute->ID );

	$disputer = get_user_by( 'id', $dispute->post_author );
	$disputee = get_user_by( 'id', $workspace->post_author );

	$project = hrb_p2p_get_workspace_post( $workspace->ID );

	$project_link = html_link( get_permalink( $project->ID ), $project->post_title );
	$workspace_link = html_link( hrb_get_workspace_url( $workspace->ID ), __( 'workspace', APP_TD ) );


	### notify disputee

	$dispute_decision = APP_DISPUTE_STATUS_REFUND == $status ? __( 'in your favor', APP_TD ) : sprintf( __( 'in favor of %s', APP_TD ), $disputer->display_name );

	// get the official response from the form posted data since the meta value is not available at the time the notification is triggered
	$official_response = _hrb_get_posted_dispute_meta_value( $dispute->ID, array( 'name' => 'official_response', 'type' => 'textarea' ) );

	$subject_message = sprintf( __( "Dispute on - %s - has been resolved %s", APP_TD ), $project_link, $dispute_decision );

	$content = sprintf(
		__( 'Hello %2$s,%1$s
		RCKTSHP has received mutually agreed upon instructions from both parties in regards to the dispute opened on %3$s via <a href="mailto:disputes@rcktshp.com">disputes@rcktshp.com</a>. The decision was %5$s and funds will be released accordingly. Following is our official response:%1$s
		<em>%6$s</em>.', APP_TD ),
		"\r\n\r\n", $disputee->display_name, $project_link, $disputer->display_name, $dispute_decision, $official_response
	);

	$content .= "\r\n\r\n" . sprintf( __( "Visit the project %s.", APP_TD ), $workspace_link );

	$participant = array(
		'recipient' => $disputee->ID, 
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $project->ID,
			'action' =>  hrb_get_workspace_url( $workspace->ID ),
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'action', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );


	### notify disputer

	$dispute_decision = APP_DISPUTE_STATUS_PAY == $status ? __( 'in your favor', APP_TD ) : sprintf( __( 'in favor of \'%s\'', APP_TD ), $disputee->display_name );

	$subject_message = sprintf( __( "Your dispute on - %s - has been resolved %s", APP_TD ), $project_link, $dispute_decision );

	$content = "\r\n\r\n" . sprintf(
		__( 'Hello %2$s,%1$s
		RCKTSHP has received mutually agreed upon instructions from the Employer and Freelancer in regards to the dispute opened on %3$s via <a href="disputes@rcktshp.com">disputes@rcktshp.com</a>. The decision was %4$s, and funds will be released accordingly. Following is our official response:%1$s
		<em>%5$s</em>.', APP_TD ),
		"\r\n\r\n", $disputer->display_name, $project_link, $dispute_decision, $official_response
	);

	$content .= "\r\n\r\n" . sprintf( __( "Visit the project %s.", APP_TD ), $workspace_link );

	$participant = array(
		'recipient' => $disputer->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $project->ID,
			'action' =>  hrb_get_workspace_url( $workspace->ID ),
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
}

/**
 * Sends the Order receipt to the author by email only.
 * Email Only
 */
function hrb_child_send_order_receipt( $order ) {

	$recipient = get_user_by( 'id', $order->get_author() );

	$content = '';
	$content .= html( 'p', sprintf( __( 'Hello %s,', APP_TD ), $recipient->display_name ) );
	$content .= html( 'p', __( 'Receipt for your purchase:', APP_TD ) );
	$content .= _hrb_order_summary_email_body( $order );

	if ( $order->get_total() > 0 ) {
		$content .= html( 'p', __( 'Note: We will notify you after the payment clears.', APP_TD ) );
	}

	$subject = sprintf( __( '[%s] Receipt for Order #%d', APP_TD ), get_bloginfo( 'name' ), $order->get_id() );

	//appthemes_send_email( $recipient->user_email, $subject, $content );
}

### Escrow

/**
 * Notify participants on an escrow release.
 * Notification + Email
 */
function hrb_child_escrow_paid_notify( $order ) {

	if ( ! $order->is_escrow() ) {
		return;
	}

	$workspace = $order->get_item();

	if ( empty( $workspace ) ) {
		return;
	}

	$workspace_id = $workspace['post_id'];

	$project = hrb_p2p_get_workspace_post( $workspace_id );

	$employer = get_user_by( 'id', $workspace['post']->post_author );

	$workspace_link = html_link( hrb_get_workspace_url( $workspace_id ), $project->post_title );

	### notify employer

	$subject_message = sprintf( __( 'Work for - %1$s - has been paid', APP_TD ), $workspace_link );

	$content = sprintf(
		__( 'Hello %1$s,%2$s
		work for %3$s has been paid.%2$s. Thank you for completing your project through the RCKTSHP Marketplace. We look forward to your next project!', APP_TD ),
		$employer->display_name, "\r\n\r\n", $workspace_link
	);

	$participant = array(
		'recipient' => $employer->ID,
		'message' => $subject_message,
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $project->ID,
			'action' => hrb_get_workspace_url( $workspace_id ),
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta'] );

	$participants = hrb_p2p_get_workspace_participants( $workspace_id );
	if ( ! $participants ) {
		return;
	}

	$receivers = $order->get_receivers();

	foreach( $participants->results as $worker ) {
		$subject_message = sprintf( __( 'You\'ve been paid for work on - %1$s -', APP_TD ), $workspace_link );

		$amount = $receivers[ $worker->ID ];

			$user = $worker->ID;
			$meta = get_user_meta($user);

		$tax_rate = '';
		
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

		$one_percent = $amount / 85;
		$one_hundred_percent = $one_percent * 100;
		$amount_withheld = $one_hundred_percent * .15; 
		$tax_withheld =  ($tax_rate*($amount_withheld/100));

		$percent_withheld = "15%" ;	
		$tax_percent = $tax_rate . "%";
 


		//show_vars($tax_percent);

		$content = sprintf(
			__( 'Hello %1$s,%2$s
			Congratulations! %7$s has updated the status of %4$s to \'Completed\' and you\'ve been paid %3$s for your work. The workspace is now closed, but information about the project is still accessable in your dashboard. You can now rate and review %7$s regarding your project experience.  We hope you enjoyed working together! %2$s As outlined in the <a href="http://projects.rcktshp.com/service-fees/">Service Fees</a> section of the RCKSTHP Terms of Use, %6$s of the total project price has been withheld by RCKTSHP Marketplace. Included in this amount is regional tax of %5$s. Full disclosure of payment terms can be found under the <a href="http://projects.rcktshp.com/terms/">RCKTSHP Terms of Use</a>.', APP_TD ),
			$worker->display_name, "\r\n\r\n", appthemes_get_price( $amount ), $workspace_link, $tax_percent, $percent_withheld, $employer->display_name
		);

		$content .= sprintf( __('%1$s %1$s Total Project Amount: $%2$s %1$s Freelancer Paid: %3$s %1$s Regional Tax %4$s: %5$s %1$s', APP_TD), "\r\n", $one_hundred_percent, appthemes_get_price( $amount ), $tax_percent, $tax_withheld);

		$participant = array(
			'recipient' => $worker->ID,
			'message' => $subject_message,
			'send_mail' => array(
				'content' => wpautop( $content ),
			),
			'meta' => array(
				'subject' => wp_strip_all_tags( $subject_message ),
				'project_id' => $project->ID,
				'action' => hrb_get_workspace_url( $workspace_id ),
			),
		);

		appthemes_send_notification( $participant['recipient'], $participant['message'], 'action', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
	}

}

/**
 * Notify authors, candidates and participants on important project status changes.
 * Notification + Email
 */
function hrb_child_status_change_notify_parties( $post, $status, $old_status = '' ) {

	$recipient = get_user_by( 'id', get_defined_vars($post)->post_author );

	$project_link = html_link( get_permalink( $post ), $post->post_title );
	$project = hrb_get_project( $post->ID );

	$notify_candidates = false;
	$notify_participants = false;

	switch( $status) {
		case HRB_PROJECT_STATUS_CANCELED:
			$status_desc = __( 'was canceled', APP_TD );

			

			//$notify_candidates = $notify_participants = true;
			break;
		case HRB_PROJECT_STATUS_CANCELED_TERMS:
			$status_desc = __( 'is pending new candidate selection', APP_TD );
			break;
		case HRB_PROJECT_STATUS_EXPIRED:
			$status_desc = __( 'has expired', APP_TD );
			break;
		case 'publish':
			if ( 'publish' != $old_status ) {
				$status_desc = __( 'was reopened', APP_TD );
				$notify_candidates = true;
			} else {
				$status_desc = __( 'was updated', APP_TD );
				//$notify_candidates = $notify_participants = true;
			}
			break;
		default:
			$status_desc = $status;
			$notify_candidates = $notify_participants = true;
	}

	if ( HRB_PROJECT_STATUS_EXPIRED == $status ) {

		// notify author using a separate function
		hrb_project_expired_notify( $post );

	} else {

		$subject_message = sprintf( __( 'Your project - %1$s - %2$s', APP_TD ), $project_link, $status_desc );

		$content = sprintf(
			__( 'Hello %2$s, %1$s
			your project %3$s, %4$s.', APP_TD ),
			"\r\n\r\n", $recipient->display_name, $project_link, $status_desc
		);

		$participant = array(
			'recipient' => $recipient->ID,
			'message' => $subject_message,
			'send_mail' => array(
				'content' => wpautop( $content ),
			),
			'meta' => array(
				'subject' => wp_strip_all_tags( $subject_message ),
				'project_id' => $post->ID,
				'action' => get_permalink( $post ),
			),
		);

		appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
	}

	### notify participants/candidates/proposal authors

	$project = hrb_get_project( $post->ID );

	$users = array();

	// check for participants or candidates and notify them on a per-status basis

	if ( $notify_participants ) {
		$participants = hrb_get_post_participants( $project->ID );

		if ( $participants ) {

			$users = $participants->results;
			if ( ! $users ) {
				$users = hrb_p2p_get_post_candidates( $project->ID );

				if ( ! empty( $users ) ) {
					$users = $users->results;
				}
			}

		}
	}

	// check for candidates

	if ( $notify_candidates ) {

		$proposals = hrb_get_proposals_by_post( $post->ID );

		foreach( $proposals['results'] as $proposal ) {
			$users[] = get_user_by( 'id', $proposal->get_user_id() );
		}

	}

	foreach( $users as $worker ) {

		$subject_message = sprintf( __( 'Project - %1$s - owned by \'%2$s\' %3$s', APP_TD ), $project_link, $recipient->display_name, $status_desc );

		$content = sprintf(
			__( 'Hello %2$s,%1$s
			Project %3$s, owned by \'%4$s\', %5$s.', APP_TD ),
			"\r\n\r\n", $worker->display_name, $project_link, $recipient->display_name, $status_desc
		);

		$participant = array(
			'recipient' => $worker->ID,
			'message' => $subject_message,
			'send_mail' => array(
				'content' => wpautop( $content ),
			),
			'meta' => array(
				'subject' => wp_strip_all_tags( $subject_message ),
				'project_id' => $project->ID,
			),
		);

		appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
	}
}

# Work Notifications

/**
 * Notify participants on project status changes.
 * Notification + Email
 *
 * @uses apply_filters() Calls 'hrb_project_status_change_notify_content'
 */
function hrb_child_project_status_work_notify_parties( $new_status, $old_status, $post ) {


	if ( HRB_PROJECTS_PTYPE != $post->post_type || HRB_PROJECT_STATUS_WORKING != $old_status ) {
		return;
	}

	if ( ! in_array( $new_status, array( HRB_PROJECT_STATUS_CANCELED, HRB_PROJECT_STATUS_CLOSED_COMPLETED, HRB_PROJECT_STATUS_CLOSED_INCOMPLETE ) ) ) {
		return;
	}

	$employer = get_user_by( 'id', $post->post_author );

    $project_link = html_link( get_permalink( $post->ID ), $post->post_title );
    //$GLOBALS['url'] = $project_link;

	$status = hrb_get_project_statuses_verbiages( $new_status );

	### notify participants

	$participants = hrb_p2p_get_workspace_participants( $post->ID );
	if ( ! $participants ) {
		return;
	}

	$escrow_payment_text = '';

	if ( hrb_is_escrow_enabled() && in_array( $new_status, array( HRB_PROJECT_STATUS_CLOSED_INCOMPLETE ) ) ) {
		$escrow_payment_text = __( 'Since the project was not considered complete the project owner may be entitled to a full refund.', APP_TD );
	}

	if ( hrb_is_escrow_enabled() && in_array( $new_status, array( HRB_PROJECT_STATUS_CANCELED) ) ) {
		$escrow_payment_text = __( 'Since the project was cancelled the project owner will recieve a full refund.', APP_TD );
	}


	foreach( $participants->results as $worker ) {
		// @todo use two vars for the url and the link for performance
		$workspace_link = html_link( hrb_get_workspace_url( $worker->p2p_from ), __( 'workspace', APP_TD ) );

		$subject_message = sprintf( __( "Project - %s - owned by '%s' was updated to '%s'", APP_TD ), $project_link, $employer->display_name, $status );

		$content = sprintf(
			__( 'Hello %2$s,%1$s
			User \'%3$s\' has just updated %4$s status to \'%5$s\'.%1$s', APP_TD ), "\r\n\r\n", $worker->display_name, $employer->display_name, $project_link, $status, $workspace_link
		);

		if ( $escrow_payment_text ) {
			$content .= $escrow_payment_text . "\r\n\r\n";
		}

		$content = apply_filters( 'hrb_project_status_change_notify_content', $content, $new_status, $post, $worker->p2p_from, $worker );

		$participant = array(
			'recipient' => $worker->ID,
			'message' => $subject_message,
			'send_mail' => array(
				'content' => wpautop( $content ),
			),
			'meta' => array(
				'subject' => wp_strip_all_tags( $subject_message ),
				'project_id' => $post->ID,
				'action' => hrb_get_workspace_url( $worker->p2p_from ),
			),
		);


		appthemes_send_notification( $participant['recipient'], $participant['message'], 'action', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ));
	}


	### notify employer
	$workspaces = hrb_get_cached_workspaces_for( $post->ID );

	// check for multiple workspaces
	if ( count( $workspaces ) > 1 ) {

		$workspaces = hrb_p2p_get_post_workspaces( $post->ID, array( 'connected_query' => array( 'orderby' => 'ID' ) ) );
		$workspaces = $workspaces->posts;
		$workspace_id = $workspaces[0]->ID;

		$action_url = hrb_get_dashboard_url_for('projects');
		$workspace_link = html_link( $action_url, __( 'Dashboard', APP_TD ) );
	} else {
		$workspace_id = $workspaces[0];
		$action_url = hrb_get_workspace_url( $workspaces[0] );
		$workspace_link = html_link( $action_url, __( 'workspace', APP_TD ) );
	}

	$escrow_payment_text = '';

	if ( hrb_is_escrow_enabled() && in_array( $new_status, array( HRB_PROJECT_STATUS_CLOSED_INCOMPLETE ) ) ) {
		$escrow_payment_text = sprintf( __( 'Since the project was not considered completed, you may be entitled to a full refund. However, if the freelancer working on the project does not agree with your project end decision, they are entitled to open a dispute within the next 5 days. ' ."\r\n\r\n". 'We strongly encourage you to contact the freelancer and try to negotiate a resolution to avoid starting a dispute.  ' ."\r\n\r\n". 'Please <a href="mailto:hello@rcktshp.com">contact us</a> or refer to our <a href="http://projects.rcktshp.com/faq/">FAQ</a> with any further inquiries.', APP_TD ), ( hrb_is_escrow_enabled() ? __( 'may be', APP_TD ) : __( 'are', APP_TD ) ) );
	}

	if ( hrb_is_escrow_enabled() && in_array( $new_status, array( HRB_PROJECT_STATUS_CANCELED ) ) ) {
		$escrow_payment_text = sprintf( __( 'Since the project has been cancelled, you will be issued a full refund, as requested. The project is now closed, and all participants can review each other’s work in the project %2$s. %1$s If the student disagrees with your decision to cancel the project, they may contact you to identify, in detail, any project discrepancies that may have been reason for cancellation. In this situation, the disagreement is solely between you and the student, who should negotiate a solution separately from RCKTSHP. %1$s Please <a href="mailto:hello@rcktshp.com">contact us</a> or refer to our <a href="http://projects.rcktshp.com/faq/">FAQ</a> with any further inquiries.', APP_TD ), "\r\n\r\n", $workspace_link) ;
	}



	$subject_message = sprintf( __( "You updated the status for - %s -  to '%s'", APP_TD ), $project_link, $status );

	$review_link = html_link($workspace_link, 'rate and review');

		$content = sprintf(
		__( 'Hello %2$s,%1$s
		You\'ve updated %3$s status to \'%4$s\'. The workspace is now closed, but the project details are still accessable in your dashboard. We hope you enjoyed working together. %1$s You can now %5$s the freelancer regarding your project experience. %1$s', APP_TD ), "\r\n\r\n", $employer->display_name, $project_link, $status, $review_link
		);
	

	if ( $escrow_payment_text ) {
		$content .= $escrow_payment_text . "\r\n\r\n";
	}

	//$content = apply_filters( 'hrb_project_status_change_notify_content', $content, $new_status, $post, $workspace_id, $employer );

	$participant = array(
		'recipient' => $employer->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $post->ID,
			'action' => $action_url,
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'action', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ));
	
}

/**
 * Notify participants on work status changes.
 * Notification + Email
 */
function hrb_child_work_status_notify_parties( $new_status, $old_status, $workspace_id, $participant_id ) {

	$project = hrb_p2p_get_workspace_post( $workspace_id );

	$worker = get_user_by( 'id', $participant_id );
	$employer = get_user_by( 'id', $project->post_author );

	$project_link = html_link( get_permalink( $project->ID ), $project->post_title );
	$workspace_link = html_link( hrb_get_workspace_url( $workspace_id ), __( 'workspace', APP_TD ) );

	$work_status_link = html_link( hrb_get_workspace_url( $workspace_id ), __( 'work status', APP_TD ) );

	$status = hrb_get_participants_statuses_verbiages( $new_status );

	if ( in_array( $new_status, hrb_get_work_ended_statuses() ) ) {
		$work_ended = true;
	} else {
		$work_ended = false;
	}

	### notify employer

	if($work_ended){

		$subject_message = sprintf( __( 'User %1$s, working on - %2$s - has updated their %3$s to \'%4$s\'', APP_TD ), $worker->display_name, $project_link, $work_status_link, $status );

			$content = sprintf(
			__( 'Hello %2$s,%1$s
			User \'%3$s\' has just updated their work status on %4$s, to \'%5$s\'. %1$s Please analyze the freelancer’s work and end the project accordingly. If you consider the project to be incomplete or needing further adjustments to meet your documented agreed upon terms, please contact %3$s to inform in detail of any project discrepancies. %1$s Once you mark the project ‘Completed,’ funds will be released to the freelancer, and you will then be able to add your final review for %3$s.', APP_TD ),
			"\r\n\r\n", $employer->display_name, $worker->display_name, $project_link, $status
		);


			$participant = array(
			'recipient' => $employer->ID,
			'message' => $subject_message,
			'send_mail' => array(
				'content' => wpautop( $content ),
			),
			'meta' => array(
				'subject' => wp_strip_all_tags( $subject_message ),
				'project_id' => $project->ID,
				'action' =>  hrb_get_workspace_url( $workspace_id ),
			),
		);
 
		appthemes_send_notification( $participant['recipient'], $participant['message'], 'action', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
	}

	else{

		$subject_message = sprintf( __( 'User %1$s, working on - %2$s - has updated their %3$s to \'%4$s\'', APP_TD ), $worker->display_name, $project_link, $work_status_link, $status );

		$content = sprintf(
			__( 'Hello %2$s,%1$s
			User \'%3$s\' has just updated thier work status on %4$s, to \'%5$s\'.', APP_TD ),
			"\r\n\r\n", $employer->display_name, $worker->display_name, $project_link, $status
		);
	

		$content .= "\r\n\r\n" . sprintf( __( "Visit the project %s.", APP_TD ), $workspace_link );

		$participant = array(
			'recipient' => $employer->ID,
			'message' => $subject_message,
			'send_mail' => array(
				'content' => wpautop( $content ),
			),
			'meta' => array(
				'subject' => wp_strip_all_tags( $subject_message ),
				'project_id' => $project->ID,
				'action' =>  hrb_get_workspace_url( $workspace_id ),
			),
		);

		if($status != 'Working'){
			appthemes_send_notification( $participant['recipient'], $participant['message'], 'action', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
		}

		else{

			$content = sprintf( __( 'Congratulations! Funds for %2$s have been successfully transfered. %1$s has been officially assigned, and their work status has been updated to Working. %5$s A %6$s for the project has been created and is accessable in your dashboard. In your workspace, you can find project details, notes, official terms, contact information, and the project\'s work status. %5$s', APP_TD ), $worker->display_name, $project_link, $work_status_link, $status, "\n\r\n\r", $workspace_link ); 

			$content .= sprintf( __('<b>What now?</b> %1$s We encourage frequent communication between you and %2$s. %1$s Meet with your freelancer face-to-face to discuss details, exchange relavent tools, establish a timeline, a create a project scope document. %1$s If you have any further inquiries, please visit our <a href="http://projects.rcktshp.com/faq/">FAQ</a> or feel free to <a href="mailto:support@rcktshp.com">contact us</a>.  ', APP_TD), "\n\r\n\r", $worker->display_name);

			$participant = array(
				'recipient' => $employer->ID,
				'message' => $subject_message,
				'send_mail' => array(
					'content' => wpautop( $content ),
				),
				'meta' => array(
					'subject' => wp_strip_all_tags( $subject_message ),
					'project_id' => $project->ID,
					'action' =>  hrb_get_workspace_url( $workspace_id ),
				),
			);

			$subject_message = sprintf( __( 'Congratulations %2$s has been officially assigned to %1$s', APP_TD ), $worker->display_name, $project_link, $work_status_link, $status ); 



			appthemes_send_notification( $participant['recipient'], $subject_message, 'action', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );

		}
		
	}



	### notify participant
	### if status is working, dont send

	$subject_message = sprintf( __( 'Your work status on - %1$s - was updated to \'%2$s\'', APP_TD ), $project_link, $status );

	$content = "\r\n\r\n" . sprintf(
		__( 'Hello %1$s,%2$s
		Your work status on %3$s was updated to \'%4$s\'.', APP_TD ),
		$worker->display_name, "\r\n\r\n", $project_link, $status
	);

	if ( $work_ended ) {
		$content .= "\r\n\r\n" . sprintf(
				__( "The project owner will now analyze your work and end the project accordingly. "
				. "You'll then be able to add your final review for '%s'.", APP_TD ),
				$employer->display_name
		);
	}

	$content .= "\r\n\r\n" . sprintf( __( "Visit the project %s.", APP_TD ), $workspace_link );

	$participant = array(
		'recipient' => $worker->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $project->ID,
			'action' =>  hrb_get_workspace_url( $workspace_id ),
		),
	);


	if($status != 'Working' ){
		appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );		
	}
	else{
		appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta'] );	
	}
	
}

/**
 * Notify employer and candidate on project terms change.
 * Notification + Email
 */
function hrb_child_terms_modified_notify_parties( $project_id, $proposal, $terms ) {

	$project = hrb_get_project( $project_id );

	$employer = get_user_by( 'id', $project->post_author );

	$project_link = html_link( get_permalink( $project->ID ), $project->post_title );
	$terms_link = html_link( get_the_hrb_proposal_url( $proposal ), __( 'terms', APP_TD ) );

	### notify selected candidates

	$candidates = hrb_p2p_get_post_selected_candidates( $project_id );

	foreach( $candidates as $candidate ) {

		$subject_message = sprintf( __( 'User \'%1$s\' updated the %2$s for - %3$s -', APP_TD ), $employer->display_name, $terms_link, $project_link );

		$content = sprintf(
			__( 'Hello %2$s,%1$s
			User \'%3$s\' has updated the %4$s for %5$s.', APP_TD ), "\r\n\r\n", $candidate->display_name, $employer->display_name, $terms_link, $project_link
		);

		$participant = array(
			'recipient' => $candidate->ID,
			'message' => $subject_message,
			'send_mail' => array(
				'content' => wpautop( $content ),
			),
			'meta' => array(
				'subject' => wp_strip_all_tags( $subject_message ),
				'project_id' => $project_id,
				'action' => get_the_hrb_proposal_url( $proposal ),
			),
		);

		appthemes_send_notification( $participant['recipient'], $participant['message'], 'action', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
	}

	### notify employer

	$subject_message = sprintf( __( 'You\'ve updated the %1$s for - %2$s -', APP_TD ), $terms_link, $project_link );


	$content = sprintf(
		__( 'Hello %2$s,%1$s
		You\'ve updated your %3$s for %4$s. ', APP_TD ), "\r\n\r\n", $employer->display_name, $terms_link, $project_link, $rating_link
	);



	$participant = array(
		'recipient' => $employer->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $proposal->project->ID,
			'action' => get_the_hrb_proposal_url( $proposal ),
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'action', $participant['meta'] );
}


/**
 * Notify participants on the deadline for opening disputes.
 *
 * @since 1.3
 */
function hrb_child_dispute_period_ending_notify_parties( $workspace, $end_time, $notify_time, $notify_times ) {

	$participants = hrb_p2p_get_workspace_participants( $workspace->ID );
	if ( ! $participants ) {
		return;
	}

	$project = hrb_p2p_get_workspace_post( $workspace->ID );

	$workspace_link = html_link( hrb_get_workspace_url( $workspace->ID ), $workspace->post_title );

	$days_left = appthemes_days_between_dates( $end_time, $notify_time );

	foreach( $participants->results as $worker ) {
		$subject_message = sprintf( __( '%1$d %2$s left for opening a dispute on - %3$s -', APP_TD ), $days_left, _n( 'Day', 'Days', $days_left, APP_TD ), $workspace_link );

		$content = sprintf(
			__( 'Hello %1$s,%2$s
			This message is to inform you that the deadline for opening disputes on %3$s ends in %4$d %5$s.%2$s
			We strongly encourage you to continue negotiating a solution before starting a dispute. However, if you fail to open a dispute during this time the employer will be fully refunded and you will not get paid.', APP_TD ),
			$worker->display_name, "\r\n\r\n", $workspace_link, $days_left, _n( 'Day', 'Days', $days_left, APP_TD )
		);

		$participant = array(
			'recipient' => $worker->ID,
			'message' => $subject_message,
			'send_mail' => array(
				'content' => wpautop( $content ),
			),
			'meta' => array(
				'subject' => wp_strip_all_tags( $subject_message ),
				'project_id' => $project->ID,
				'action' => hrb_get_workspace_url( $workspace->ID ),
			),
		);

		appthemes_send_notification( $participant['recipient'], $participant['message'], 'action', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
	}

	// update the notify times meta

	$notify_times[ $notify_time ] = 1;

	update_post_meta( $workspace->ID, 'dispute_end_notify_times', $notify_times );
}

### Cron

/**
 * Look for closed workspaces with unopened disputes.
 *
 * @since 1.3
 *
 * @uses do_action() Calls 'hrb_workspace_dispute_period_ended'
 * @uses do_action() Calls 'hrb_workspace_dispute_period_ending'
 *
 */
function hrb_child_unopened_disputes_refund_or_notify() {

	$workspace_unopened_disputes = new WP_Query( array(
		'post_type'		=> HRB_WORKSPACE_PTYPE,
		'post_status'	=> array( HRB_PROJECT_STATUS_CANCELED, HRB_PROJECT_STATUS_CLOSED_INCOMPLETE ),
		'meta_query'	=> array(
			'relation' => 'AND',
			array(
				'key'		=> 'dispute_end_date',
				'value'		=> current_time('mysql'),
				'compare'	=> '>',
				'type'		=> 'datetime',
			),
			array(
				'key'		=> 'opened_dispute',
				'value'		=> 'dummy',
				'compare'	=> 'NOT EXISTS',
			),
		),
		'nopaging' => true,
	) );

	$time = current_time('mysql');

	foreach( $workspace_unopened_disputes->posts as $workspace ) {

		$end_time = get_post_meta( $workspace->ID, 'dispute_end_date', true );

		### fire a hook if dispute for the current workspace has expired

		if ( $end_time < $time ) {
			hrb_dispute_period_ended_notify_parties( $workspace, $end_time );

			do_action( 'hrb_workspace_dispute_period_ended', $workspace->ID, $end_time );
		} else {

			### fire a hook each time a pre-set dispute deadline notification time is reached

			$notify_times = get_post_meta( $workspace->ID, 'dispute_end_notify_times', true );

			foreach ( (array) $notify_times as $notify_time => $notified ) {
				// skip if notifications for this time period were already sent
				if ( $notified ) continue;

				if ( $notify_time < $time ) {
					hrb_child_dispute_period_ending_notify_parties( $workspace, $end_time, $notify_time, $notify_times );

					do_action( 'hrb_workspace_dispute_period_ending', $workspace, $end_time, $notify_time, $notify_times );
				}

			}

		}

	}

}

# Reviews

/**
 * Notify participants on new reviews.
 * Notification + Email
 */
function hrb_child_new_user_review_notify_parties( $review, $recipient_id ) {

	$reviewee = get_user_by( 'id', $recipient_id );
	$reviewer = get_user_by( 'id', $review->user_id );

	$project_id = $review->get_post_ID();

	$workspace_url = hrb_get_workspace_url_by( 'post_id', $project_id, array( $review->user_id, $recipient_id ) );

	$project_link = html_link( get_permalink( $project_id ), get_the_title( $project_id ) );
	$review_link = html_link( $workspace_url, __( 'review', APP_TD ) );

	### notify candidate

	$subject_message = sprintf( __( 'Your %1$s on - %2$s - was sent to \'%3$s\'. %1$s Rating: %1$s Comment: %1$s', APP_TD ), $review_link, $project_link, $reviewee->display_name );

	$content = sprintf(
		__( 'Hello %2$s,%1$s
		Your %3$s for %4$s was succesfully sent to \'%5$s\'. %1$s %1$s Rating: %7$s stars %6$s', APP_TD ),
		"\r\n\r\n", $reviewer->display_name, $review_link, $project_link, $reviewee->display_name, $review->comment_content, $review->get_rating()
	);


	$participant = array(
		'recipient' => $reviewer->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $project_id,
			'action' => $workspace_url,
		),
	);

	appthemes_send_notification( $partcipant['recipient'], $participant['message'], 'notification', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );

	### notify employer

	$subject_message = sprintf( __( 'User \'%1$s\' has just sent you a %2$s on - %3$s -', APP_TD ), $reviewer->display_name, $review_link, $project_link );

	$content = sprintf(
		__( 'Hello %2$s,%1$s
		You\'ve received a new %3$s for %4$s from \'%5$s\'.  %1$s %1$s Rating: %7$s stars %6$s', APP_TD ),
		"\r\n\r\n", $reviewee->display_name, $review_link, $project_link, $reviewer->display_name, $review->comment_content, $review->get_rating()
	);

	$participant = array(
		'recipient' => $reviewee->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $project_id,
			'action' => $workspace_url,
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'review', $participant['meta'], array( 'send_mail' => $participant['send_mail'] )  );
}


/**
 * Sends the Order confirmation receipt to the author by email only.
 * Email Only
 */
function hrb_child_send_order_receipt_confirmation( $order ) {

	$recipient = get_user_by( 'id', $order->get_author() );

	$content = '';
	$content .= html( 'p', sprintf( __( 'Hello %s,', APP_TD ), $recipient->display_name ) );
	if ( $order->is_escrow() ) {
		$workspace = $order->get_item();
		$workspace_link = html_link( hrb_get_workspace_url( $workspace['post_id'] ), $workspace['post']->post_title );

		$content .= html( 'p', sprintf( __( 'This email confirms that funds held in escrow for work on %s were released:', APP_TD ), $workspace_link ) );
	} else {
		$content .= html( 'p', __( 'This email confirms that you have purchased the following:', APP_TD ) );


		//do_action('order_created');

		//WP_die("<pre>" . var_dump($order). "</pre>");

	}
	$content .= _hrb_order_summary_email_body( $order ) . "\r\n\r\n";

	$subject = sprintf( __( '[%s] Payment Confirmation for Order #%d', APP_TD ), get_bloginfo( 'name' ), $order->get_id() );

	rcktshp_custom_email( $recipient->user_email, $subject, $content );
}

/**
 * Notify employer and candidate on a canceled agreement.
 * Notification + Email
 */
function hrb_child_agreement_canceled_notify_parties( $proposal, $sender ) {

	$proposal = hrb_get_proposal( $proposal );

	if ( $sender->ID == $proposal->project->post_author ) {
		// employer
		$recipient = get_user_by( 'id', $proposal->get_user_id() );
	} else {
		// candidate
		$recipient = get_user_by( 'id', $proposal->project->post_author );
	}

	$project_link = html_link( get_permalink( $proposal->project->ID ), $proposal->project->post_title );

	### notify recipient

	$subject_message = sprintf( __( 'User %1$s has canceled negotiations with you for - %2$s -', APP_TD ), $sender->display_name, $project_link );

	$content = sprintf(
		__( 'Hello %2$s,%1$s
		User %3$s has canceled negotiations with you on %4$s. ', APP_TD ),
		"\r\n\r\n", $recipient->display_name, $sender->display_name, $project_link
	);

	$content .= sprintf(
		__( '<br /><br /> This project may be re-listed and it will be open for proposals again.', APP_TD ),
		"\r\n\r\n", $recipient->display_name, $sender->display_name, $project_link
	);

	$participant = array(
		'recipient' => $recipient->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $proposal->project->ID,
			'action' => get_the_hrb_proposal_url( $proposal ),
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'action', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );

	### notify sender

	$subject_message = sprintf( __( 'You\'ve canceled negotiations with %1$s on - %2$s -', APP_TD ), $recipient->display_name, $project_link );

	$content = sprintf(
		__( 'Hello %2$s,%1$s
		You\'ve canceled negotiations with %3$s for %4$s. %1$s This project may be re-listed and it will be open for proposals again. ', APP_TD ),
		"\r\n\r\n", $sender->display_name, $recipient->display_name, $project_link
	);

	$participant = array(
		'recipient' => $sender->ID,
		'message' => $subject_message,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject_message ),
			'project_id' => $proposal->project->ID,
			'action' => get_the_hrb_proposal_url( $proposal ),
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
}

/**
 * Notify owner on canceled Orders.
 * Notification + Email
 */
function hrb_child_order_canceled_notify_author( $order ) {

	$order_link = html_link( hrb_get_dashboard_url_for('payments'), '#'.$order->get_id() );
	$recipient = get_user_by( 'id', $order->get_author() );

	$subject = sprintf( __( 'Your Order %s was Canceled', APP_TD ), $order_link );

	$content = sprintf(
		__( 'Hello %2$s,%1$s
		Your Order %3$s, has just been canceled.', APP_TD ), "\r\n\r\n", $recipient->display_name, $order_link
	);

	$participant = array(
		'recipient' => $recipient->ID,
		'message' => $subject,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject ),
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
}

/**
 * Notify user about credits added to balance.
 * Notification + Email
 */
function hrb_child_credits_added_notify_user( $user_id, $credits, $balance ) {

	if ( $credits <= 0 ) {
		return;
	}

	$recipient = get_user_by( 'id', $user_id );

	$dashboard_link = html_link( hrb_get_dashboard_url_for('payments'), __( 'account balance', APP_TD ) );
	$credits_text = sprintf( _n( '%d credit was', '%d credits were', $credits, APP_TD ), $credits );

	$content = sprintf(
		__( 'Hello %2$s,%1$s
		%3$s added to your %4$s.%1$s
		Current Balance: %5$d credit(s)', APP_TD ), "\r\n\r\n", $recipient->display_name, $credits_text, $dashboard_link, $balance
	) . "\r\n\r\n";

	$subject = sprintf( __( "%d credits added to your account. Your credit balance is %d", APP_TD ),$credits, $balance );

	$participant = array(
		'recipient' => $recipient->ID,
		'message' => $subject,
		'send_mail' => array(
			'content' => wpautop( $content ),
		),
		'meta' => array(
			'subject' => wp_strip_all_tags( $subject ),
			'action' => esc_url( hrb_get_dashboard_url_for('payments') ),
		),
	);

	appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta']);
}


# END EMAIL CUSTOMIZATIONS

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


/**** FACEBOOK OGP DATA **/


//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
		return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
	}
add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info

function insert_fb_in_head() {
	global $post;
	if ( !is_singular()){
		return;
	} //if it is not a post or a page
	else{

	if(has_post_thumbnail($post->ID)) {
        $img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'medium');
    } else {
        $img_src = get_stylesheet_directory_uri() . '/img/opengraph_image.jpg';
    }
		?>
	
   	<meta property="og:title" content="<?php echo the_title(); ?>"/>
    <meta property="og:description" content="<?php echo $excerpt; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <meta property="og:image" content="<?php echo $img_src; ?>"/>
 
        <?php
	}
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );




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


include 'user-details-functions.php';
include 'custom-fields-functions.php';

?>
