<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       pivotaldesign.ca
 * @since      1.0.0
 *
 * @package    Sales_Banner
 * @subpackage Sales_Banner/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Sales_Banner
 * @subpackage Sales_Banner/public
 * @author     Gary Tohill <gtohill@pivotaldesign.ca>
 */
class Sales_Banner_Public
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sales_Banner_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sales_Banner_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_register_style('google-styles', "https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap");
		wp_enqueue_style('google-styles');
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/sales-banner-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/sales-banner-public.js', $this->version, '', true);
	}

	public static function show_sale_banner()
	{

		function filter_the_content_in_the_main_loop($content)
		{

			$is_sales_banner_active = get_option('show_sales_banner');


			// Check if we're inside the main loop in a single post page.
			if ((is_front_page() || is_single()) && $is_sales_banner_active === "1") {
				$banner_1 = get_option('sales_banner_field_1', 'add your sales offer here');
				$banner_2 = get_option('sales_banner_field_2', 'add your sales offer here');
				$banner_3 = get_option('sales_banner_field_3', 'add your sales offer here');
				$banner_arr = array($banner_1, $banner_2, $banner_3);

				$add_content = "<div id='sales_banner_wrapper'>";
				foreach ($banner_arr as $banner) {
					if($banner != ''){
						$add_content .= "<div class='mySlides sales_banner_text_offer'>" . $banner . "</div>";
					}
				}
				$add_content .=
					'<button class="previous-banner banner-button" onclick="plusSlides(-1)">&#10094;</button>
				<button class="next-banner banner-button" onclick="plusSlides(1)">&#10095;</button>';
				$add_content .= "</div>";
				
				return $add_content . $content;
			}

			return $content;
		}

		add_filter('the_content', 'filter_the_content_in_the_main_loop');
	}
}
