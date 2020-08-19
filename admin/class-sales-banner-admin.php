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
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . '/css/sales-banner-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . '/js/sales-banner-admin.js', array('jquery'), $this->version, false);
	}


	/**
	 * grave form
	 */
	public static function sales_banner_form()
	{
		add_menu_page('Add To Sales Banner', 'Sales Banner', 'manage_options', 'sales-banner', 'sales_banner_custom_form', '', 25);
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
					<textarea name="sales_banner_field_1" cols="150" rows="2"><?php echo esc_attr(get_option('sales_banner_field_1')); ?></textarea><br>
					<label for="sales_banner_field_2">Second Offer</label><br>
					<textarea name="sales_banner_field_2" cols="150" rows="2"><?php echo esc_attr(get_option('sales_banner_field_2')); ?></textarea><br>
					<label for="sales_banner_field_3">Third Offer</label><br>
					<textarea name="sales_banner_field_3" cols="150" rows="2"><?php echo esc_attr(get_option('sales_banner_field_3')); ?></textarea><br>

					<?php
					submit_button();
					?>
				</form>
			</div>
		<?php
		}

		function sales_banner_custom_form()
		{
		?>
			<div class="wrap">
				<h1>Sales Banner Custom Settings </h1>
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
					<label for="add_sales_banner">Add Offer</label><br>
					<textarea name="add_sales_banner" cols="150" rows="2"></textarea><br>

					<?php
					submit_button();
					?>
				</form>

				<section class="neumorph">
					<div style="padding: 25px 0">
						<h2 style="text-align:center">Active - Inactive - Update Entries</h4>
					</div>

					<?php
					global $wpdb;
					$tablename = $wpdb->prefix . 'sales_banner';
					$entries = $wpdb->get_results("SELECT * FROM $tablename");
					?>
					<button class="tablink" onclick="openPage('active', this, '#448D76')" id="defaultOpen">Active Offers</button>
					<button class="tablink" onclick="openPage('inactive', this, '#FCBA12')">Inactive Offers</button>
					<button class="tablink" onclick="openPage('update', this, '#DDE3FD')">Update/Delete Offers</button>

					<div id="active" class="tabcontent">
						<?php
						$active = 0;
						?>
						<table class="banner-tables">
							<tr>
								<th style="border-bottom:1px black solid" class="banner-first-column">Change To Inactive</th>
								<th style="border-bottom:1px black solid" class="banner-second-column">Offer</th>
							</tr>

							<?php
							foreach ($entries as $entry) {
								if ($entry->active == 1) {
									$active += 1;
							?>
									<tr>
										<form method="post" action="options.php">
											<?php settings_fields('sales_banner_settings_group'); ?>
											<?php do_settings_sections('sales_banner_settings_group'); ?>											
											<td style="border-bottom:1px black dotted" class="banner-first-column"><button class="button-offer-inactive" name="inactive_banner" value="">Make Inactive</button></td>
											<td style="border-bottom:1px black dotted" class="banner-second-column"><?php echo $entry->information; ?> </td>
											<input type="hidden" name="banner_id" value="<?php echo $entry->id; ?>">
										</form>
									</tr>
							<?php }
							}

							?>
						</table>
						<?php
						if ($active == 0) {
							echo '<h3>No Offers are Active</h3>';
						}
						?>
					</div>

					<div id="inactive" class="tabcontent">
						<table class="banner-tables">
							<tr>
								<th style="border-bottom:1px black solid" class="banner-first-column">Change To Active</th>
								<th  style="border-bottom:1px black solid" class="banner-second-column">Offer</th>
							</tr>
							<?php
							$inactive = 0;
							foreach ($entries as $entry) {
								if ($entry->active == 0) {
									$inactive += 1;
							?>
									<tr>
										<form method="post" action="options.php">
											<?php settings_fields('sales_banner_settings_group'); ?>
											<?php do_settings_sections('sales_banner_settings_group'); ?>
											<td style="border-bottom:1px black dotted" class="banner-first-column"><button class="button-offer-active" name="active_banner" value="">Make Active</button></td>
											<td style="border-bottom:1px black dotted" class="banner-second-column"><?php echo $entry->information; ?> </td>
											<input type="hidden" name="banner_id" value="<?php echo $entry->id; ?>">
										</form>
									</tr>
							<?php }
							} ?>
						</table>
						<?php
						if ($inactive == 0) {
							echo '<h3> No Offers Are Inactive</h3>';
						} ?>
					</div>

					<div id="update" class="tabcontent">
						<table>
							<tr>
								<th style="border-bottom:1px black solid" class="update-first-column">Offer</th>
								<th style="border-bottom:1px black solid" class="update-second-column">Update</th>
								<th style="border-bottom:1px black solid" class="update-third-column">Delete</th>
							</tr>
							<?php
							foreach ($entries as $entry) { ?>
								<tr>
									<form method="post" action="options.php">
										<?php settings_fields('sales_banner_settings_group'); ?>
										<?php do_settings_sections('sales_banner_settings_group'); ?>
										<td  class="update-first-column"><input size=90 type="text" name="banner" value="<?php echo $entry->information; ?>">
										<input type="hidden" name="id" value="<?php echo $entry->id; ?>" ></td>
										<td class="update-second-column"><button class="update-button" type="submit" name="update_banner">Update</button></td>
										<td class="update-third-column"><button class="delete-button" type="submit" name="delete_banner">Delete</button></td>
									</form>
								</tr>
							<?php } ?>
						</table>
					</div>
				</section>
				<script>
					// Get the element with id="defaultOpen" and click on it
					document.getElementById("defaultOpen").click();
				</script>
			</div>
<?php

		}
	}
}
