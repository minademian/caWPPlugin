<?php

/**
 * Fired during plugin activation
 *
 * @link       
 * @since      0.0.2
 *
 * @package    ca-worldapi
 * @subpackage ca-worldapi/includes
 */

namespace CA_Worldapi;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      0.0.2
 * @package    ca-worldapi
 * @subpackage ca-worldapi/includes
 * @author     Mina Demian <mina@minademian.com>
 */
class CA_Worldapi_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    0.0.2
	 */
	public static function activate() {
		write_log('Plugin activated.');
	}

}