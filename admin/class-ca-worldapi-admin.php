<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       
 * @since      0.0.2
 *
 * @package    ca-worldapi
 * @subpackage ca-worldapi/admin
 * @todo security checks in form post callback
 * @todo nonce in form
 * @todo switch to api key from ca sweden google account
 */

namespace CA_Worldapi;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    ca-worldapi
 * @subpackage ca-worldapi/admin
 * @author     Mina Demian <mina@minademian.com>
 */
class CA_Worldapi_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.0.2
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.0.2
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	private $locations;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.0.2
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function show_stored_locations() {
		return $this->locations;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    0.0.2
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in CA_Worldapi_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CA_Worldapi_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ca-worldapi-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    0.0.2
	 */
	public function enqueue_scripts() {
   	// wp_register_script( 'gmaps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCL5S4F2fWMgdG_icTgTjG1eEBFEndsk18&callback=initMap', array(), '1.0', true );
		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ca-worldapi-admin.js', array( 'jquery' ), $this->version, false );
	}

  public function menu() {
		add_options_page( 'CA Meetings', 'CA Meetings', 'manage_options', 'ca-worldapi', array(new Admin_Helper, "options") );
	}

	public function prepare_api_connection() {
		includes\admin\API::initialize_connection();
	}

	public function initialize_options() {
  	add_option( 'ca_worldapi_locations', '', '', 'yes' );
		add_option( 'ca_worldapi_active_region', '', '', 'yes' );
		add_option( 'ca_worldapi_active_country', '', '', 'yes' );
		add_option( 'ca_worldapi_country_set', '', '', 'yes' );
		add_option( 'ca_worldapi_meetings_list', '', '', 'yes' );
		return true;
	}

	public function get_locations() {
		$list = includes\admin\API::retrieve_locations();
		if (is_wp_error($list)) {
			wp_die( __( $list->get_error_message() ) );
		} elseif (is_bool($list) == true) {
			wp_die( __( 'No country data returned from API.' ) );
		} else {
			$this->persist_locations($list);
		}
	}

	public function persist_locations($list) {
  	if (!get_option('ca_worldapi_locations')) {
  		  update_option('ca_worldapi_locations', serialize($list), '', 'yes');
      } else {
        return false;
      }
  }

	public function display_locations($list) {
  	$list = unserialize(get_option('ca_worldapi_locations'));
  	$this->locations = includes\admin\API_Parser::convert($list);
	}

	public function get_meetings($country) {
		$list = includes\admin\API::retrieve_meetings($country);
		if (is_wp_error($list)) {
			wp_die( __( $list->get_error_message() ) );
		} elseif (is_bool($list) == true) {
			wp_die( __( 'No meetings data returned from API.' ) );
		} else {
			write_log('Retrieved list of meetings for ' . $country);
			$this->persist_meetings($list);
		}
	}

	public function persist_meetings($list) {
  	if (!get_option('ca_worldapi_meetings_list')) {
  		  update_option('ca_worldapi_meetings_list', serialize($list), '', 'yes');
				write_log('Persisted list of meetings!');
      } else {
        return false;
      }
  }

	public function set_active_country_callback() {
		if (isset($_POST["country"])) {
				$location = explode('|', $_POST["country"]);
				list($region, $country) = $location;

				update_option('ca_worldapi_country_set', 1, '', 'no');
				update_option('ca_worldapi_active_region', $region, '', 'no');
				update_option('ca_worldapi_active_country', $country, '', 'no');

				$this->get_meetings($country);

				$admin_notice = "success";
				$this->custom_redirect($admin_notice, $_POST);
				exit;
			}
			else {
				wp_die( __( 'Invalid nonce specified', $this->plugin_name ), __( 'Error', $this->plugin_name ), array(
							'response' 	=> 403,
							'back_link' => 'admin.php?page=' . $this->plugin_name,
					) );
			}
	}

	/**
	 * custom_redirect
	 *
	 * @since    1.0.0
	 */
	private function custom_redirect( $admin_notice, $response ) {
		wp_redirect(
			esc_url_raw(
				add_query_arg(
					array( 'ca-worldapi-add_notice' => $admin_notice, 'ca-worldapi-form_response' => $response), admin_url('admin.php?page='. $this->plugin_name )
				)
			)
		);
	}
}

class Admin_Helper {
	public function options() {
		if (!current_user_can( 'manage_options'))  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		include_once plugin_dir_path( __FILE__ ) . 'partials/ca-worldapi-admin-display.php';
	}
}