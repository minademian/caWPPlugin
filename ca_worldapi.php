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
define( 'CA_WORLDAPI_VERSION', '0.0.1' );

class ca_worldapi {
	function __construct() {
register_activation_hook( __FILE__, 'ca_worldapi_install' );
register_uninstall_hook(__FILE__, 'ca_worldapi_uninstall');
register_deactivation_hook(__FILE__, 'ca_worldapi_deactivation');
	// include(plugin_dir_path(__FILE__) . 'inc/wp_location_shortcode.php');
	// include(plugin_dir_path(__FILE__) . 'inc/wp_location_widget.php');
	}
 function run() {
		echo 'HALLOW';
}
function ca_worldapi_install()
{
	echo 'INSTALL!';
}

function ca_worldapi_deactivation()
{
	echo 'DEACTIVATE!';
}

function ca_worldapi_uninstall()
{
	echo 'UNINSTALL!!!!';
}
}

	$plugin = new ca_worldapi();
	$plugin->run();
