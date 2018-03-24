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

require_once(plugin_dir_path(__FILE__) . 'includes/constants.php');

class ca_worldapi {

	private $api = API_PROTOCOL . API_HOST;
	private $active_country;

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
		add_action('admin_post_custom_action_hook', 'set_active_country_callback');
		//add_action('admin_notices', 'sample_admin_notice__success');
		add_action('admin_notices', 'ca_worldapi_add_settings_errors');
	}

	private function retrieve_countries_list() {
		error_log($this->api.'/countries');
		$request = wp_remote_get($this->api.'/countries');

		if (is_wp_error($request)) {
			return false;
		}

		$body = wp_remote_retrieve_body($request);
		$data = json_decode($body, true);
		if (!empty($data)) return serialize($data);
		else return false;
	}

 	public function run() {
		if (!get_option('ca_worldapi_countries_list')) {
			$theBody = $this->retrieve_countries_list();
			add_option('ca_worldapi_countries_list', $theBody, '', 'yes');
		} else {
			if (get_option('ca_worldapi_active_country')) {
				$this->active_country = get_option('ca_worldapi_active_country');
			} else {
				add_option('ca_worldapi_country_set', false, '', 'yes');
				error_log('no active country set.');
			}
		}
	}

	public function activation() {
		error_log('AC!');
	}

	public function deactivation() {
		error_log('DE!');
	}

	public function uninstall() {
		error_log('UNINSTALL!');
	}

	public function enqueue_admin_scripts_and_styles(){
	    wp_enqueue_style('ca_worldapi_admin_styles', plugin_dir_url(__FILE__) . '/css/ca_worldapi_admin_styles.css');
	}

	public function enqueue_public_scripts_and_styles(){
	    wp_enqueue_style('ca_worldapi_public_styles', plugin_dir_url(__FILE__). '/css/ca_worldapi_public_styles.css');
	}

	public function ca_worldapi_options() {
		if (!current_user_can( 'manage_options'))  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		include(plugin_dir_path(__FILE__) . 'includes/templates/admin-view.php');
	}


	public function ca_worldapi_menu() {
		add_options_page( 'CA Meetings', 'CA Meetings', 'manage_options', 'caworldapi', 'ca_worldapi_options' );
	}

	public function sample_admin_notice__success() {
	    ?>
	    <div class="notice notice-success is-dismissible">
	        <p><?php _e( 'Done! Your default country has been set.', 'sample-text-domain' ); ?></p>
	    </div>
	    <?php
	}

	public function set_active_country_callback() {
		if (isset($_POST["country"])) {
				add_option('ca_worldapi_active_country', $_POST["country"], '', 'yes');
				add_option('ca_worldapi_country_set', true, '', 'yes');
				// add the admin notice
				$admin_notice = "success";

				// redirect the user to the appropriate page
				$this->custom_redirect( $admin_notice, $_POST );
				exit;
			}
			else {
				wp_die( __( 'Invalid nonce specified', $this->plugin_name ), __( 'Error', $this->plugin_name ), array(
							'response' 	=> 403,
							'back_link' => 'admin.php?page=' . $this->plugin_name,
					) );
			}

	}
}

function ca_worldapi_add_settings_errors() {
  settings_errors();
}

$plugin = new ca_worldapi();
$plugin->run();