<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://example.com
 * @since      0.0.2
 *
 * @package    ca-worldapi
 * @subpackage ca-worldapi/includes
 */

namespace CA_Worldapi;

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      0.0.2
 * @package    ca-worldapi
 * @subpackage ca-worldapi/includes
 * @author     Mina Demian <mina@minademian.com>
 */
class CA_Worldapi_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    0.0.2
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ca-worldapi',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
