<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    ca-worldapi
 * @subpackage ca-worldapi/public
 */

namespace CA_Worldapi;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    ca-worldapi
 * @subpackage ca-worldapi/public
 * @author     Mina Demian <mina@minademian.com>
 */
class CA_Worldapi_Public {

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
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ca-worldapi-public.css', array(), $this->version, 'all' );
	}

	// public function include_custom_jquery() {
	// 	wp_deregister_script('jquery');
	// 	wp_enqueue_script('jquery', '//code.jquery.com/jquery-1.8.3.min.js', array(), null, true);
	// }
	// 
	// public function include_openlayers() {
	//   wp_enqueue_script('openlayers', '//www.openlayers.org/api/OpenLayers.js', array('jquery'), null, false );
	// }

	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ca-worldapi-public.js', array( 'jquery' ), $this->version, false );

	}

	public function register_ca_worldapi_widgets() {
	    register_widget('Frontend_Widget');
	}
}
