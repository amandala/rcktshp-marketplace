<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    rcktshp-tax-reporting
 * @subpackage rcktshp-tax-reporting/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    rcktshp-tax-reporting
 * @subpackage rcktshp-tax-reporting/includes
 * @author     Your Name <email@example.com>
 */
class Tax_Reporting_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
	   global $wpdb;

	   $table_name = $wpdb->prefix . "tax_reporting"; 
	   $backup_table_name = $wpdb->prefix . 'tax_backup';

	   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE IF NOT EXISTS $backup_table_name (
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

		dbDelta( $sql );

		$sql2 = "INSERT INTO $backup_table_name (SELECT * FROM $table_name)";
		
		dbDelta( $sql2 );

		$sql3 = "DROP TABLE $table_name;";


		$wpdb->query($sql3);

		
	}

}
