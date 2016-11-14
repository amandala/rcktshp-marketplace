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
 * @author     Your Name <email@example.com>
 */


class Tax_Item {


	public function __construct(array $attrs){
		foreach($attrs as $key=>$value){
			$this->{$key}=$value;
		}	
		//echo "<pre>WP_die($attrs)</pre>";
		
	}

	public function get_tax_id(){return $this->id;}
	public function get_tax_time(){return $this->time;}
	public function get_tax_user_id(){return $this->user_id;}
	public function get_tax_trans_type(){return $this->trans_type;}
	public function get_tax_trans_id(){return $this->trans_id;}
	public function get_tax_total_amount(){return $this->total_amount;}
	public function get_tax_tax_amount(){return $this->tax_amount;}




	
}



?>