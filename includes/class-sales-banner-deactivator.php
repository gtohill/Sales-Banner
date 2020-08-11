<?php

/**
 * Fired during plugin deactivation
 *
 * @link       pivotaldesign.ca
 * @since      1.0.0
 *
 * @package    Sales_Banner
 * @subpackage Sales_Banner/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Sales_Banner
 * @subpackage Sales_Banner/includes
 * @author     Gary Tohill <gtohill@pivotaldesign.ca>
 */
class Sales_Banner_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		global $wpdb;
		$table  = $wpdb->prefix . 'sales_banner';
		$wpdb->query("DROP TABLE $table");
		
		update_option('show_sales_banner', '0');

	}

}
