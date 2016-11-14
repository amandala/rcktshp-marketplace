<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    rcktshp-tax-reporting
 * @subpackage rcktshp-tax-reporting/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    rcktshp-tax-reporting
 * @subpackage rcktshp-tax-reporting/public
 * @author     Amanda Haynes
 */
class Tax_Reporting_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $tax_reporting    The ID of this plugin.
	 */
	private $tax_reporting;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.2.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $tax_reporting       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $tax_reporting, $version ) {

		$this->tax_reporting = $tax_reporting;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tax_Reporting_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tax_Reporting_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->tax_reporting, plugin_dir_url( __FILE__ ) . 'css/tax-reporting-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tax_Reporting_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tax_Reporting_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->tax_reporting, plugin_dir_url( __FILE__ ) . 'js/tax-reporting-public.js', array( 'jquery' ), $this->version, false );

	}




	public function rcktshp_escrow_entry($order){
		
		require_once(ABSPATH . 'wp-content/plugins/rcktshp-tax-reporting/public/class-tax-item.php' );

		global $wpdb;

		$all_vars = get_defined_vars();
		$order = $all_vars['order'];

		
		$details = appthemes_get_escrow_details($order);	//get all the order details
		$receivers = $order->get_receivers();				
		$paid_amount = $receivers[ $worker->ID ];
		
		$payment_info = $details['paymentInfoList']['paymentInfo'];
		$freelancer = $payment_info[1];
		$receiver = $freelancer['receiver'];
		
		$email = $receiver['email'];
		$gross_fees = (float)($receiver['amount']/85)*15;
		$total_amount = (float)($receiver['amount']/85)*100;


		
		//get the user object given the meta value of their paypal email address
		$freelancer_object = reset(
						 get_users(
						  array(
						   'meta_key' => 'edfg_pp_adaptive_paypal_email',
						   'meta_value' => $email,
						   'number' => 1,
						   'count_total' => false
						  )
						 )
						);

		
	    // search the memo string for the project name and the order id
	    preg_match('/(Funds for ".+")/', $details['memo'], $order_title);
	    preg_match('/\(Order ID \#(\d\d\d)\)/', $details['memo'], $order_id);

	    $table_name = $wpdb->prefix . "tax_reporting";

	    $freelancer_meta = get_user_meta($freelancer_object->ID);
	    $tax_rate = 0.00;


		if (isset($freelancer_meta['province'][0])){	

				$user_province = $freelancer_meta['province'][0];
				

				switch ($user_province) {
					case 'AB':
					case 'BC':
					case 'MB':
					case "NT":
					case "NU":
					case "QC":
					case "SK":
					case "YT":
						$tax_rate = 0.05;
						break;
					case "NL":
					case "ON":
					case "NB":
						$tax_rate = 0.13;
						break;
					case "PE":
						$tax_rate = 0.14;
						break;
					case "NS":
						$tax_rate = 0.15; 
						break;
					default:
						$tax_rate = 0;
						break;

				}
			}
			else{

			}


		$tax_calc_rate = ($tax_rate + 1);
		$net_fees = $gross_fees / $tax_calc_rate;
		$tax_amount = $gross_fees - $net_fees;

		$project_name = $order->items[0]['post'];


		$wpdb->insert(
			$table_name, 
			array( 
				'time' => current_time( 'mysql' ), 
				'user_id' => $freelancer_object->ID,
				'user_province' => $freelancer_meta['province'][0],
				'tax_rate' => $tax_rate,
				'trans_type' => $project_name->post_name,
				'total_amount' => $total_amount,
				'gross_fees' => $gross_fees,
				'net_fees' => $net_fees,
				'tax_amount' => $tax_amount, 
			) 
		);

		
	}

	/*
	Enters a record into the edfg_tax_reporting table for every purchase in the RCKTSHP Marketplace.
	Purchases include credit packs and promotional purchases.
	The information recorded is dependent on the user's province meta field.
	Fields:
		time -> the time of the transaction
		user_id -> the ID of the purchaser
		user_province -> the province code saved in the user's metadata table entry
		tax_rate -> the rate of tax for the province the user is asscoaited with
		trans_type -> the title of the purchase
		trans_id -> the post id in the Hirebee system
		total_amount -> teh total amount of the purchase
		tax_amount -> the amount of tax added onto the base price of the purchase
	*/

	public function rcktshp_order_entry($order){

		global $wpdb;
		$table_name = $wpdb->prefix . "tax_reporting";

		$order = $order->items;
		$order_data = $order[0];
		$tax_data = $order[1];

		$user_id = $order[1]['post']->post_author;
		$user_meta = get_user_meta($user_id);

	   	$tax_rate = 0.00;

	   	$price = (float)$order_data['price'] ;
	   	$tax = (float)$tax_data['price'];
	   	$total_amount = $price += $tax;


		if (isset($user_meta['province'][0])){

				$user_province = $user_meta['province'][0];

				switch ($user_province) {
					case 'AB':
					case 'BC':
					case 'MB':
					case "NT":
					case "NU":
					case "QC":
					case "SK":
					case "YT":
						$tax_rate = 0.05;
						break;
					case "NL":
					case "ON":
					case "NB":
						$tax_rate = 0.13;
						break;
					case "PE":
						$tax_rate = 0.14;
						break;
					case "NS":
						$tax_rate = 0.15; 
						break;
					default:
						$tax_rate = 0.0;
						break;

				}
			}

			if($order_data['type'] !== 'workspace'){
					$wpdb->insert( 
					$table_name, 
					array( 
						'time' => current_time( 'mysql' ), 
						'user_id' => $user_id,
						'user_province' => $user_meta['province'][0],
						'tax_rate' => $tax_rate,
						'trans_type' => $order_data['type'],
						'total_amount' => $total_amount,
						'tax_amount' => $tax, 
					) 
				);
			}



	}
}


