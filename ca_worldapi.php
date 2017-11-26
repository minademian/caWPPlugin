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
 * @package           ca-worldapi
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
define( 'PLUGIN_NAME_VERSION', '0.0.1' );

function caworldapi_setup_post_types()
{
    // register the "book" custom post type
    register_post_type( 'book', ['public' => 'true'] );
}
add_action( 'init', 'caworldapi_setup_post_type' );
 
function caworldapi_install()
{
    // trigger our function that registers the custom post type
    caworldapi_setup_post_type();
 
    // clear the permalinks after the post type has been registered
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'caworldapi_install' );

function caworldapi_deactivation()
{
    // our post type will be automatically removed, so no need to unregister it
 
    // clear the permalinks to remove our post type's rules
    flush_rewrite_rules();
}

function caworldapi_uninstall()
{
    // our post type will be automatically removed, so no need to unregister it
 
    // clear the permalinks to remove our post type's rules
    flush_rewrite_rules();
}

register_uninstall_hook(__FILE__, 'caworldapi_function_to_run');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_name() {
	$plugin = new ca_worldapi();
	$plugin->run();
}

run_plugin_name();
