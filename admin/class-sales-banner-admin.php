<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       pivotaldesign.ca
 * @since      1.0.0
 *
 * @package    Sales_Banner
 * @subpackage Sales_Banner/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sales_Banner
 * @subpackage Sales_Banner/admin
 * @author     Gary Tohill <gtohill@pivotaldesign.ca>
 */
class Sales_Banner_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/sales-banner-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/sales-banner-admin.js', array('jquery'), $this->version, false);
	}


	/**
	 * grave form
	 */
	public static function sales_banner_form()
	{
		add_menu_page('Add To Sales Banner', 'Sales-Banner', 'manage_options', 'sales-banner', 'sales_banner_form', '', 25);
		add_action('admin_init', 'register_sales_banner_settings');


		function register_sales_banner_settings()
		{
			require(plugin_dir_path(__FILE__) . 'options.php');
			register_setting('sales_banner_settings_group', 'sales_banner_name');
		}

		function sb_get_checked_val()
		{
			$checked_array = array(
				'checked-yes' => '',
				'checked-no' => '',
			);
			$checkbox_val = esc_attr(get_option('show_sales_banner'));
			if ('1' === $checkbox_val) {
				$checked_array['checked-yes'] = 'checked';
			} else if ('0' === $checkbox_val) {
				$checked_array['checked-no'] = 'checked';
			}
			return $checked_array;
		}


		function sales_banner_form()
		{
?>
			<div class="wrap">
				<h1>Sales Banner Settings</h1>
				<form method="post" action="options.php">
					<?php settings_fields('sales_banner_settings_group'); ?>
					<?php do_settings_sections('sales_banner_settings_group'); ?>
					<h2>Enable / Disable Sales Banner</h2>
					<table class="form-table">
						<tr valign="top">
							<th scope="row">Enable ( Y/N ): <span class="ihs-otp-red">*</span></th>
							<td><label for="">
									<?php $checked_array = sb_get_checked_val(); ?>
									<input type="radio" name="update_sales_banner" class="" value="1" <?php echo esc_attr($checked_array['checked-yes']); ?> />Yes
									<input type="radio" name="update_sales_banner" class="" value="0" <?php echo esc_attr($checked_array['checked-no']); ?> />No
								</label>
							</td>
						</tr>
					</table>
					<label for="sales_banner_field_1">First Offer</label><br>
					<textarea name="sales_banner_field_1" cols="150" rows="2"><?php echo esc_attr(get_option('sales_banner_field_1'));?></textarea><br>
					<label for="sales_banner_field_2">Second Offer</label><br>
					<textarea name="sales_banner_field_2" cols="150" rows="2"><?php echo esc_attr(get_option('sales_banner_field_2'));?></textarea><br>
					<label for="sales_banner_field_3">Third Offer</label><br>
					<textarea name="sales_banner_field_3" cols="150" rows="2"><?php echo esc_attr(get_option('sales_banner_field_3'));?></textarea><br>

					<?php
					submit_button();
					?>
				</form>
			</div>
<?php
		}
	}
}

?>