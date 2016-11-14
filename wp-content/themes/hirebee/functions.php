<?php
/**
 * Theme functions file
 *
 * DO NOT MODIFY THIS FILE!
 * Make a child theme instead: http://codex.wordpress.org/Child_Themes
 *
 * @package HireBee
 * @author AppThemes
 */

global $hrb_options;

// Versioning
define( 'APP_TD', 'hirebee' );
define( 'HRB_VERSION', '1.3.5' );

// Custom Roles
define( 'HRB_ROLE_FREELANCER', 'freelancer' );
define( 'HRB_ROLE_EMPLOYER', 'employer' );
define( 'HRB_ROLE_BOTH', 'employer_freelancer' );

// Post Types
define( 'HRB_PROJECTS_PTYPE', 'project' );
define( 'HRB_WORKSPACE_PTYPE', 'workspace' );
define( 'HRB_PRICE_PLAN_PTYPE', 'pricing-plan' );
define( 'HRB_PROPOSAL_PLAN_PTYPE', 'credit-plan' );

// "User Types"
define( 'HRB_FREELANCER_UTYPE', 'freelancer' );

// Comment Types
define( 'HRB_PROPOSAL_CTYPE', 'proposal' );
define( 'HRB_CLARIFICATION_CTYPE', 'clarification' );

// Taxonomies
define( 'HRB_PROJECTS_CATEGORY', 'project_category' );
define( 'HRB_PROJECTS_TAG', 'project_tag' );
define( 'HRB_PROJECTS_SKILLS', 'project_skill' );

// P2P Connection Names
define( 'HRB_P2P_CANDIDATES', 'project_candidates' );
define( 'HRB_P2P_WORKSPACES', 'project_workspaces' );
define( 'HRB_P2P_PARTICIPANTS', 'project_participant' );
define( 'HRB_P2P_PROJECTS_FAVORITES', 'project_favorite' );

// Attachment Types
define( 'HRB_ATTACHMENT_FILE', 'file' );
define( 'HRB_ATTACHMENT_GALLERY', 'gallery' );

// Posts Statuses
define( 'HRB_PROJECT_STATUS_TERMS', 'terms' );
define( 'HRB_PROJECT_STATUS_CANCELED_TERMS', 'canceled_terms' );
define( 'HRB_PROJECT_STATUS_WORKING', 'working' );
define( 'HRB_PROJECT_STATUS_CANCELED', 'canceled' );
define( 'HRB_PROJECT_STATUS_CLOSED_COMPLETED', 'closed_complete' );
define( 'HRB_PROJECT_STATUS_CLOSED_INCOMPLETE', 'closed_incomplete' );
define( 'HRB_PROJECT_STATUS_EXPIRED', 'expired' );
define( 'HRB_PROJECT_STATUS_WAITING_FUNDS', 'waiting_funds' );

// Post Meta Statuses :: Projects
define( 'HRB_PROJECT_META_STATUS_ARCHIVED', 'archived' );

// Post Meta Statuses :: Workspaces
define( 'HRB_WORK_STATUS_REVIEW', 'review' );
define( 'HRB_WORK_STATUS_WAITING', 'waiting' );
define( 'HRB_WORK_STATUS_WORKING', 'working' );
define( 'HRB_WORK_STATUS_COMPLETED', 'completed' );
define( 'HRB_WORK_STATUS_INCOMPLETE', 'incomplete' );

// Comment Meta Statuses :: Proposals
define( 'HRB_PROPOSAL_STATUS_ACTIVE', 'active' );
define( 'HRB_PROPOSAL_STATUS_PENDING', 'pending' );
define( 'HRB_PROPOSAL_STATUS_SELECTED', 'selected' );
define( 'HRB_PROPOSAL_STATUS_ACCEPTED', 'accepted' );
define( 'HRB_PROPOSAL_STATUS_DECLINED', 'declined' );
define( 'HRB_PROPOSAL_STATUS_CANCELED', 'canceled' );

// Post Meta States :: Agreement
define( 'HRB_TERMS_SELECT', 'selected' );
define( 'HRB_TERMS_PROPOSE', 'propose' );
define( 'HRB_TERMS_ACCEPT', 'accepted' );
define( 'HRB_TERMS_DECLINE', 'declined' );
define( 'HRB_TERMS_CANCEL', 'canceled' );
define( 'HRB_TERMS_DECIDING', 'deciding' );
define( 'HRB_TERMS_UNASSIGNED', 'not_assigned' );

// Addons Meta Keys
define( 'HRB_ITEM_REGULAR', '_hrb_regular' );
define( 'HRB_ITEM_FEATURED_HOME', '_hrb_featured-home' );
define( 'HRB_ITEM_FEATURED_CAT', '_hrb_featured-cat' );
define( 'HRB_ITEM_URGENT', '_hrb_urgent' );


### File Dependencies

// Framework
require dirname(__FILE__) . '/framework/load.php';
require dirname(__FILE__) . '/theme-framework/load.php';
require dirname(__FILE__) . '/framework/admin/class-user-meta-box.php';

// Other Dependencies
$load_files = array(

	// Modules
	'payments/load.php',
	'reviews/load.php',
	'bidding/load.php',
	'notifications/load.php',
	'checkout/form-progress/load.php',
	'widgets/load.php',
	'geo/geo.php',
	'custom-forms/form-builder.php',
	'disputes/load.php',

	// Main Files
	'core.php',
	'capabilities.php',
	'setup-theme.php',
	'customizer.php',
	'users.php',
	'projects.php',
	'proposals.php',
	'agreement.php',
	'workspace.php',
	'disputes.php',
	'payments.php',
	'credits.php',
	'addons.php',
	'loops.php',
	'dashboard.php',
	'custom-forms.php',
	'reviews.php',
	'status.php',
	'activate.php',
	'favorites.php',
	'notifications.php',
	'widgets.php',
	'media.php',
	'categories.php',
	'options.php',
	'helper.php',
	'utils.php',
	'deprecated.php',

	// Template Tags
	'template-tags-site.php',
	'template-tags-projects.php',
	'template-tags-user.php',
	'template-tags-proposals.php',
	'template-tags-orders.php',

	// Sub-Modules Registration via 'add_theme_support()'
	'theme-support.php',

	// Views
	'views.php',
	'views-purchase.php',
	'views-projects.php',
	'views-proposals.php',
	'views-users.php',
	'views-dashboard.php',

	// Form Handling
	'forms-registration.php',
	'forms-projects.php',
	'forms-proposals.php',
	'forms-dashboard.php',
	'forms-purchase.php',

	// escrow
	'escrow.php',

	// security
	'security.php',

	// add-ons marketplace
	'admin/addons-mp/load.php',

);
appthemes_load_files( dirname( __FILE__ ) . '/includes/', $load_files );

// Admin Dependencies
if ( is_admin() ) {

	$load_files = array(
		'install.php',
		'dashboard.php',
		'settings.php',
		'admin.php',
		'users.php',
		'project-plans.php',
		'proposal-plans.php',
		'project-single.php',
		'project-list.php',
		'payments-list.php',
		'addons.php',
	);
	appthemes_load_files( dirname( __FILE__ ) . '/includes/admin/', $load_files );

	// Init Admin Views/Metaboxes
	$hrb_settings_admin = new HRB_Settings_Admin( $hrb_options );
	add_action( 'admin_init', array( $hrb_settings_admin, 'init_integrated_options' ), 10 );


	### Classes Instantiation

	$views = array(
		// Admin Dashboard & System Info
		'HRB_Dashboard',
		'APP_System_Info' => array( 'admin_action_priority' => 99 ),

		// Meta Boxes :: Pricing Plans
		'HRB_Pricing_General_Box',
		'HRB_Pricing_Addon_Box',

		// Meta Boxes :: Proposal
		'HRB_Proposal_General_Box',

		// Meta Boxes :: Projects
		//'HRB_Project_Attachments',
		'HRB_Project_Media' => array( '_app_media', __( 'Attachments', APP_TD ), HRB_PROJECTS_PTYPE, 'normal', 'high' ),
		'HRB_Project_Budget_Meta',
		'HRB_Project_Timeline_Meta',
		'HRB_Project_Location_Meta',
		'HRB_Project_Promotional_Meta',
		'HRB_Project_Publish_Moderation',
		'HRB_Project_Author_Meta',
	);
	appthemes_add_instance( $views );

}


### Frontend/Backend Classes Instantiation

$views = array(

	// Meta Boxes :: User Profile
	'HRB_Edit_Profile_Social_Meta_Box',
	'HRB_Edit_Profile_Extra_Meta_Box',
	'HRB_Edit_Profile_Account_Meta_Box',

	// Views :: Login/Registration
	'HRB_Login_Registration',

	// Views :: Static Pages
	'HRB_Home_Archive',
	'HRB_Blog_Archive',
	'HRB_Blog_Single',
	'HRB_How_Works_Page',
	'HRB_Site_Terms_Page',

	// Views :: User Profile
	'APP_User_Profile',
	'HRB_User_Profile',
	'HRB_Edit_Profile',

	// Views :: Users
	'HRB_Users_Listings',
	'HRB_Users_Archive',
	'HRB_Users_Search',

	// Views :: Projects
	'HRB_Project_Single',
	'HRB_Project_Archive',
	'HRB_Project_Search',
	'HRB_Project_Saved_Filter',
	'HRB_Project_Taxonomy',
	'HRB_Project_Categories',
	'HRB_Project_Create',
	'HRB_Project_Edit',
	'HRB_Project_Relist',

	// Views :: Projects :: Form Handling/Processing
	'HRB_Project_Form_Create',
	'HRB_Project_Form_Edit',
	'HRB_Project_Form_Relist',
	'HRB_Project_Form_Preview',
	'HRB_Project_Form_Submit_Free',
	'HRB_Project_Form_Relist_Free',

	// Views :: Proposals
	'HRB_Proposal_Create',
	'HRB_Proposal_Edit',

	// Views :: Proposals :: Form Handling/Processing
	'HRB_Proposal_Form_Edit',
	'HRB_Proposal_Form_Create',

	// Views :: Workspace
	'HRB_Workspace_Form_Review',
	'HRB_Workspace_Form_Manage',

	// Views :: Purchases
	'HRB_Credits_Purchase',
	'HRB_Select_Credits_Plan_New',
	'HRB_Project_Form_Relist_Select_Plan',

	// Views :: Escrow
	'HRB_Escrow_Transfer',

	// Views :: Purchases :: Form Handling/Processing
	'HRB_Order',
	'HRB_Select_Plan_New',
	'HRB_Gateway_Select',
	'HRB_Gateway_Process',
	'HRB_Order_Summary',

	// Views :: Dashboard
	'HRB_User_Dashboard_Secure',
	'HRB_User_Dashboard_Single_Project',
	'HRB_User_Dashboard',
	'HRB_User_Dashboard_Main',
	'HRB_User_Dashboard_Notifications',
	'HRB_User_Dashboard_Projects',
	'HRB_User_Dashboard_Proposals',
	'HRB_User_Dashboard_Reviews',
	'HRB_User_Dashboard_Payments',
	'HRB_User_Dashboard_Agreement',
	'HRB_User_Dashboard_Workspace',
	'HRB_User_Dashboard_Workspace_Review',

	// Views :: Dashboard :: Form Handling/Processing
	'HRB_User_Dashboard_Form_Notifications',
	'HRB_User_Dashboard_Form_Projects',
	'HRB_User_Dashboard_Form_Proposals',
	'HRB_User_Dashboard_Form_Payments',
	'HRB_User_Dashboard_Form_Agreement',
);

if ( current_theme_supports( 'app-disputes' ) ) {
	$views[] = 'HRB_Workspace_Form_Dispute';
	$views[] = 'HRB_User_Dashboard_Workspace_Dispute';
}

appthemes_add_instance( $views );

APP_Mail_From::init();

### Init

appthemes_init();
