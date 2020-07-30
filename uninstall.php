<?php

/*
 *
 * @link       pivotaldesign.ca
 * @since      1.0.0
 *
 * @package    Sales_Banner
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
delete_option('show_sales_banner');