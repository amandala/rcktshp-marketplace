<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    rcktshp-tax-reporting
 * @subpackage rcktshp-tax-reporting/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    rcktshp-tax-reporting
 * @subpackage rcktshp-tax-reporting/includes
 * @author     Your Name <email@example.com>
 */
class Tax_Reporting_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */

	public static function activate() {
	   global $wpdb;

	   $table_name = $wpdb->prefix . "tax_reporting"; 



		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
		  id INT NOT NULL AUTO_INCREMENT,
		  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  user_id varchar(100) NOT NULL,
		  user_province varchar(2) NOT NULL,
		  tax_rate DECIMAL(4, 2) NOT NULL, 
		  trans_type varchar(55) DEFAULT '' NOT NULL,
		  total_amount DECIMAL(12, 2) NOT NULL,
		  gross_fees DECIMAL(10, 2),
		  net_fees DECIMAL(10, 2),
		  tax_amount DECIMAL(10, 2) NOT NULL,
		  PRIMARY KEY (id, time)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

		

	}


}
