<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://webfluential.com
 * @since             1.0.6
 * @package           Webfluential
 *
 * @wordpress-plugin
 * Plugin Name:       Webfluential
 * Plugin URI:        webfluential.com
 * Description:       Makes managing your Webfluential profile.
 * Version:           1.0.6
 * Author:            webfluential <hello@webfluential.com>
 * Author URI:        http://webfluential.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       webfluential
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-webfluential-activator.php
 */
function activate_webfluential() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-webfluential-activator.php';
	Webfluential_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-webfluential-deactivator.php
 */
function deactivate_webfluential() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-webfluential-deactivator.php';
	Webfluential_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_webfluential' );
register_deactivation_hook( __FILE__, 'deactivate_webfluential' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-webfluential.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_webfluential() {

	$plugin = new Webfluential();
	$plugin->run();

}

class webfluential_plugin extends WP_Widget {

	// constructor
	function webfluential_plugin() {
		parent::__construct(false, $name = __('Webfluential Profile', 'webfluential_plugin') );
	}

	// widget form creation
	function form($instance) {
	$result = '';
// Check values
		if( $instance) {

			$url = esc_attr($instance['url']);
			if (isset($instance['result'])) {
				$result = esc_attr($instance['result']);
				$instance['result'] = null;
			}

			$book_url = esc_attr($instance['book_url']);
			// if (isset($instance['book'])) {
				// $result = esc_attr($instance['result']);
				// $instance['result'] = null;
			// }

			//$content = esc_attr($instance['content']);
		} else {
			$url = '';
			//$content = '';
		}
		//var_dump($instance);

		$defaults = array( 'url' => 'YOURNAME', 'show_img' => true, 'show_social' => true, 'show_wheel' => true, 'book_url' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
			<label for="<?php echo $this->get_field_id('url'); ?>">https://webfluential.com/
				<input id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('book_url'); ?>">Full URL to page where booking form is set up
				<input style="width:100%" id="<?php echo $this->get_field_id('book_url'); ?>" name="<?php echo $this->get_field_name('book_url'); ?>" type="text" value="<?php echo $book_url; ?>" />
			</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_img'], true ); ?> value="1" id="<?php echo $this->get_field_id( 'show_img' ); ?>" name="<?php echo $this->get_field_name( 'show_img' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_img' ); ?>">Show Profile Image</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_social'], true ); ?> value="1" id="<?php echo $this->get_field_id( 'show_social' ); ?>" name="<?php echo $this->get_field_name( 'show_social' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_social' ); ?>">Show Social Links</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_wheel'], true ); ?> value="1" id="<?php echo $this->get_field_id( 'show_wheel' ); ?>" name="<?php echo $this->get_field_name( 'show_wheel' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_wheel' ); ?>">Show Influence Wheel</label>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'show_wheel' ); ?>">Widget Colour</label>
		<select id="<?php echo $this->get_field_id( 'styles' ); ?>" name="<?php echo $this->get_field_name( 'styles' ); ?>">
		<option <?php if ( $instance['styles'] == 1 ) echo 'selected'; ?> value="1">Green</option>
		<option <?php if ( $instance['styles'] == 3 ) echo 'selected'; ?> value="3">Purple</option>
		<option <?php if ( $instance['styles'] == 2 ) echo 'selected'; ?> value="2">Black</option>
	  
		</select>
		</p>
		
		<p><?=$result?></p>
		<?php
	}

	// widget update
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// Fields
		$instance['url'] = strip_tags($new_instance['url']);
		$instance['show_img'] = $new_instance['show_img'];
		$instance['show_social'] = $new_instance['show_social'];
		$instance['show_wheel'] = $new_instance['show_wheel'];
		$instance['styles'] = $new_instance['styles'];
		$instance['book_url'] = $new_instance['book_url'];
		//var_dump($instance);
		//die();
		// curlRequest to see if user is valid
		$content = json_decode($this->curlRequest("http://bookings.webfluential.io/profiles/wp_plugin_ajax_slug_test/" . $instance['url']));
		if (isset($content->status) && $content->status == 1)
		{
			$instance['result'] = 'Successful';
		} else {
			$instance['result'] = 'invalid profile!';
		}

		return $instance;
	}

	// widget display
	function widget($args, $instance) {
		extract( $args );
		$show_img = is_null($instance['show_img']) ? 0 : 1;
		$show_social = is_null($instance['show_social']) ? 0 : 1;
		$show_wheel = is_null($instance['show_wheel']) ? 0 : 1;
		$styles = is_null($instance['styles']) ? 1 : $instance['styles'];
		$book_url = is_null($instance['book_url']) ? 1 : $instance['book_url'];
		$url = "http://bookings.webfluential.io/profiles/wp_plugin_channel_stats/" . $instance['url'].'/'.$show_img.'/'.$show_social.'/'.$show_wheel. '/'. $styles. '/'. base64_encode($book_url) ;
		// Display the widget
		$content = $this->curlRequest($url);

		// Check if content is set
		if( $content ) {
			echo $before_widget;
			echo '<div class="widget-text webfluential_plugin_box">';
			echo ($content);
//			echo '</div>';
			echo $after_widget;
		}

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

function booking_form()	{

//	$content = curlRequest("http://plugin.10.0.0.119.xip.io/booking_form.html");
	$options = get_option('webfluential');
	//var_dump($options);
	// $content = curlRequest("http://dev.webfluential.io/profiles/wp_plugin_contact_form/" . $options['profile_url'].'/1/'.$options['theme_colour'].'/'.base64_encode($options['form_description']));

	$content = '<iframe id="bookingIframe" src="http://bookings.webfluential.io/profiles/wp_plugin_contact_form/' .$options['profile_url'].'/3/'.$options['theme_colour'].'/'.base64_encode($options['form_description']).'" width="100%" height="1500px"></iframe>';
	
	// Check if content is set
	if( $content ) {
		return $content;
	}
	return '';

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




add_shortcode('webfluential_booking_form', 'booking_form');

// register widget
add_action('widgets_init', create_function('', 'return register_widget("webfluential_plugin");'));

run_webfluential();

