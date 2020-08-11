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
class Sales_Banner_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		add_option('show_sales_banner', 'No');

		function sb_install_table()
		{
			global $wpdb;

			$table_name = $wpdb->prefix . "sales_banner";

			$charset_collate = $wpdb->get_charset_collate();

			$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,			
			information tinytext NOT NULL,			
			active boolean NOT NULL DEFAULT 1,			
			PRIMARY KEY  (id)
			) $charset_collate;";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
		sb_install_table();
	}
}
