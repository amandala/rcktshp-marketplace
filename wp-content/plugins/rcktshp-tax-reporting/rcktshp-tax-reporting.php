<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.2.0
 * @package           Tax_Reporting
 *
 * @wordpress-plugin
 * Plugin Name:       RCKTSHP Tax Reporting
 * Plugin URI:        
 * Description:       This plugin was created to keep track of tax related informtaion for the RCKTSHP Marketplace. Recent Updates: Default tax rate is now 0%
 * Version:           1.0.0
 * Author:            Amanda Haynes
 * Author URI:        
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tax-reporting
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tax-reporting-activator.php
 */
function activate_tax_reporting() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tax-reporting-activator.php';
	Tax_Reporting_Activator::activate();


}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tax-reporting-deactivator.php
 */
function deactivate_tax_reporting() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tax-reporting-deactivator.php';
	Tax_Reporting_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tax_reporting' );
register_deactivation_hook( __FILE__, 'deactivate_tax_reporting' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tax-reporting.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tax_reporting() {

	$plugin = new Tax_Reporting();
	$plugin->run();

}

run_tax_reporting();






