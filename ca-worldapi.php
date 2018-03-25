<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              
 * @since             0.0.2
 * @package           ca-worldapi
 *
 * @wordpress-plugin
 * Plugin Name:       ca-worldapi
 * Plugin URI:        
 * Description:       allows fellowship websites to access and display the data from the World API
 * Version:           0.0.2
 * Author:            Mina Demian
 * Author URI:        http://github.com/minademian
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plugin-name
 * Domain Path:       /languages
 */

namespace CA_Worldapi;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */

define( __NAMESPACE__ . '\NS', __NAMESPACE__ . '\\' );

define( NS . 'PLUGIN_NAME', 'ca-worldapi' );
define( NS . 'PLUGIN_VERSION', '0.0.2' );

define( NS . 'PLUGIN_NAME_DIR', plugin_dir_path( __FILE__ ) );
define( NS . 'PLUGIN_NAME_URL', plugin_dir_url( __FILE__ ) );
define( NS . 'PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( NS . 'PLUGIN_TEXT_DOMAIN', 'ca-worldapi' );

define( 'API_PROTOCOL', 'http://' );
define( 'API_HOST', 'localhost:3000' );
define( 'API_ENDPOINT_COUNTRIES', API_PROTOCOL . API_HOST . '/countries' );
define( 'API_ENDPOINT_MEETINGS', API_PROTOCOL . API_HOST . '/meetings' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_ca_worldapi() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ca-worldapi-activator.php';
	CA_Worldapi_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_ca_worldapi() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ca-worldapi-deactivator.php';
	CA_Worldapi__Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ca_worldapi' );
register_deactivation_hook( __FILE__, 'deactivate_ca_worldapi' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ca-worldapi.php';

require_once plugin_dir_path( __FILE__ ) . 'public/frontend-widget.php';

/**
 * Helper libraries
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/common/lib-autoloader.php' ;
require_once plugin_dir_path( __FILE__ ) . 'includes/common/lib-functions.php';


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.0.2
 */
function run_ca_worldapi() {

	$plugin = new CA_Worldapi();
	$plugin->run();

}
run_ca_worldapi();
