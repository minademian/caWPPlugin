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
	function __construct() {
		include(plugin_dir_path(__FILE__) . 'includes/functions.php');
		register_activation_hook( __FILE__, array( 'ca_worldapi', 'activation'));
		register_uninstall_hook(__FILE__, array( 'ca_worldapi', 'uninstall'));
		register_deactivation_hook(__FILE__, array( 'ca_worldapi', 'deactivation'));
		add_action('admin_menu', 'ca_worldapi_menu');
	}

 	static function run() {
		error_log('plugin ' . PLUGIN_NAME . ' running!');
		//$theBody = wp_remote_retrieve_body( wp_remote_get('http://188.166.70.137:8000/') );
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
}

function ca_worldapi_menu() {
	add_options_page( 'CA World API Options', 'CA World API', 'manage_options', 'caworldapi', 'ca_worldapi_options' );
}

function ca_worldapi_options() {
	if (!current_user_can( 'manage_options'))  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<p>HALLOWWWW IM ON THE BOGGGG.</p>';
	echo '</div>';
}
	$plugin = new ca_worldapi();
	$plugin->run();
