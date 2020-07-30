<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              pivotaldesign.ca
 * @since             1.0.0
 * @package           Sales_Banner
 *
 * @wordpress-plugin
 * Plugin Name:       sales-banner
 * Plugin URI:        pivotaldesign.ca
 * Description:       Add a simple banner between the header and content to showcase sales to visitors
 * Version:           1.0.0
 * Author:            Gary Tohill
 * Author URI:        pivotaldesign.ca
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sales-banner
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('SALES_BANNER_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sales-banner-activator.php
 */
function activate_sales_banner()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-sales-banner-activator.php';
	Sales_Banner_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sales-banner-deactivator.php
 */
function deactivate_sales_banner()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-sales-banner-deactivator.php';
	Sales_Banner_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_sales_banner');
register_deactivation_hook(__FILE__, 'deactivate_sales_banner');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-sales-banner.php';


add_action('customize_register', 'my_theme_customizer');
function my_theme_customizer($wp_customize)
{
	$wp_customize->add_section('sales_banner_color_scheme', array(
		'title'    => __('Sales Banner Color Scheme', 'salesbanner'),
		'description' => 'Change background color',
		'priority' => 200,
	));

	//  =============================
	//  = Pick Background Color              =
	//  =============================
	$wp_customize->add_setting('back_color', array(
		'default'     => '#000000',
		'type' => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
		'transport'   => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'back_color', array(
		'label'    => __('Background Color', 'themename'),
		'section'  => 'sales_banner_color_scheme',
		'settings' => 'back_color',
	)));

	//  ================================
	//  = Pick Primary Color(Offer Text)=
	//  ================================
	$wp_customize->add_setting('text_color', array(
		'default'     => '#ffffff',
		'type' => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
		'transport'   => 'refresh',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'text_color', array(
		'label'    => __('Text Color', 'themename'),
		'section'  => 'sales_banner_color_scheme',
		'settings' => 'text_color',
	)));
}

add_action('wp_head', 'sales_banner_customize_css');
function sales_banner_customize_css()
{
?>	
	<style type="text/css">
		#sales_banner_wrapper {
			background-color: <?php echo get_option('back_color', '#000000'); ?>;
			color: <?php echo get_option('text_color', '#ffffff'); ?>;
		}

		.sales_banner_text_offer {
			color: <?php echo get_option('offer_text_color', '#ffffff'); ?>;
		}
	
	</style>
<?php
}


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sales_banner()
{
	$plugin = new Sales_Banner();
	$plugin->run();
}
run_sales_banner();
