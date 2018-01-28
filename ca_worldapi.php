<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.ca-world.org
 * @since             0.0.1
 * @package           CA_WORLDAPI
 *
 * Plugin Name:  Cocaine Anonymous (CA) World API plugin
 * Plugin URI:   
 * Description:  allow CA websites across the world to access data in the CA World API
 * Version:      20171126
 * Author:       Mina Demian
 * Author URI:   https://github.com/minademian
 * License:      Apache
 * License URI:  https://www.apache.org/licenses/LICENSE-2.0
 * Text Domain:  wporg
 * Domain Path:  /languages
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
define('PLUGIN_VERSION', '0.0.1' );
define('PLUGIN_NAME', 'ca_worldapi');

class ca_worldapi {
	public function __construct() {
//include shortcodes
include(plugin_dir_path(__FILE__) . 'includes/ca_worldapi_shortcode.php');
//include widgets
include(plugin_dir_path(__FILE__) . 'includes/ca_worldapi_widget.php');
include(plugin_dir_path(__FILE__) . 'includes/functions.php');
		register_activation_hook( __FILE__, array( 'ca_worldapi', 'activation'));
		register_uninstall_hook(__FILE__, array( 'ca_worldapi', 'uninstall'));
		register_deactivation_hook(__FILE__, array( 'ca_worldapi', 'deactivation'));
		add_action('admin_menu', 'ca_worldapi_menu');
	}

 	static function run() {
		error_log('plugin ' . PLUGIN_NAME . ' running!');
		$theBody = wp_remote_retrieve_body( wp_remote_get('http://159.65.30.176/meetings/?format=json'));
	}

	static function activation() {
		error_log('AC!');
	}

	static function deactivation() {
		error_log('DE!');
	}

	static function uninstall() {
		error_log('UNINSTALL!');
	}

	//enqueus scripts and stles on the back end
	public function enqueue_admin_scripts_and_styles(){
	    wp_enqueue_style('ca_worldapi_admin_styles', plugin_dir_url(__FILE__) . '/css/ca_worldapi_admin_styles.css');
	}

	//enqueues scripts and styled on the front end
	public function enqueue_public_scripts_and_styles(){
	    wp_enqueue_style('ca_worldapi_public_styles', plugin_dir_url(__FILE__). '/css/ca_worldapi_public_styles.css');

	}
}

function ca_worldapi_menu() {
	add_options_page( 'CA Meetings', 'CA Meetings', 'manage_options', 'caworldapi', 'ca_worldapi_options' );
}

function ca_worldapi_options() {
	if (!current_user_can( 'manage_options'))  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
  ?>
	<div class="wrap">
	<h2>CA Meetings</h2>
  <h3>Please select your country. You will only have to do this once.</h3>
  <form name="select-country" id="select-country">
	 <label for="country">Country</label>
   <select name="country" id="country">
    <option value="">-- none selected</option>
    <option value="se">Sweden</option>
    <option value="us">United States</option>
    <option value="uk">United Kingdom</option>
	 </select>
  </form>
	</div>
  <?php
}
	$plugin = new ca_worldapi();
	$plugin->run();
