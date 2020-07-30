<?php

/**
 * Fired during plugin activation
 *
 * @link       pivotaldesign.ca
 * @since      1.0.0
 *
 * @package    Sales_Banner
 * @subpackage Sales_Banner/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Sales_Banner
 * @subpackage Sales_Banner/includes
 * @author     Gary Tohill <gtohill@pivotaldesign.ca>
 */
class Sales_Banner_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		add_option('show_sales_banner', 'No');	
	}

}
