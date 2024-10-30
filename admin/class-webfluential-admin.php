<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://webfluential.com
 * @since      1.0.0
 *
 * @package    Webfluential
 * @subpackage Webfluential/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Webfluential
 * @subpackage Webfluential/admin
 * @author     Webfluential <hello@webfluential.com>
 */
class Webfluential_Admin {

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
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Webfluential_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Webfluential_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( 'settings_page_wp-cbf' == get_current_screen() -> id ) {
			// CSS stylesheet for Color Picker
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/webfluential-admin.css', array( 'wp-color-picker' ), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Webfluential_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Webfluential_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if ( 'settings_page_webfluential' == get_current_screen() -> id ) {
			wp_enqueue_media();
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/webfluential-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, false );
		}
		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/webfluential-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */

	public function add_plugin_admin_menu() {

		/*
         * Add a settings page for this plugin to the Settings menu.
         *
         * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
         *
         *        Administration Menus: http://codex.wordpress.org/Administration_Menus
         *
         */
		add_options_page( 'Webfluential Settings', 'Webfluential', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
		);
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */

	public function add_action_links( $links ) {
		/*
        *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
        */
		$settings_link = array(
				'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
		);
		return array_merge(  $settings_link, $links );

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */

	public function display_plugin_setup_page() {
		include_once( 'partials/webfluential-admin-display.php' );
	}

	public function options_update() {
		//echo "err here";
		  // var_dump($_REQUEST['webfluential']['profile_url']);
		if (isset($_REQUEST['webfluential']['profile_url']))
		{

				// add_settings_error($this->setting,$key,$message,'error');
				register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
		}
		
	}

	public function validate($input) {
		// All checkboxes inputs
		$valid = array();
		// var_dump('https://webfluential.com/'. $_REQUEST['webfluential']['profile_url']);
		// $result = $this->curlRequest('https://webfluential.com/'. $input['profile_url']);
		// if ($result)
		// {
			$valid['profile_url'] = $input['profile_url'];
			$valid['form_description'] = $input['form_description'];
			$valid['theme_colour'] = $input['theme_colour'];
		// }

		return $valid;
	}

	function curlRequest($url, $params = null)
	{

		$fields_string = null;

		// is cURL installed yet?
		if (!function_exists('curl_init'))
		{
			die("CURL is not installed/available");
		}
		// OK cool - then let's create a new cURL resource handle
		$ch = curl_init();
		//set the number of POST vars, POST data
		//$url .= ("?" . http_build_query($params));
		curl_setopt($ch, CURLOPT_URL, $url);


		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		// Set a referer
		// curl_setopt($ch, CURLOPT_REFERER, "http://www.example.com/curl.htm");
		// User agent
		// curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
		// Include header in result? (0 = yes, 1 = no)
		curl_setopt($ch, CURLOPT_HEADER, 0);
		// Should cURL return or print out the data? (true = return, false = print)
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Timeout in seconds
		//curl_setopt($ch, CURLOPT_TIMEOUT, $this->_curlTimeout);

		// Download the given URL, and return output
		$output = curl_exec($ch);
//		var_dump($output);

		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		// Close the cURL resource, and free system resources
		$curlError = curl_errno($ch);
		curl_close($ch);
		if($curlError != CURLE_OK)
		{
			return false;
		}
		else
		{
			return $output;
		}
	}

}
