<?php

/**
 * Fired during plugin deactivation
 *
 * @link       
 * @since      0.0.2
 *
 * @package    ca-worldapi
 * @subpackage ca-worldapi/includes
 */

namespace CA_Worldapi;

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      0.0.2
 * @package    ca-worldapi
 * @subpackage ca-worldapi/includes
 * @author     Mina Demian <mina@minademian.com>
 */
class CA_Worldapi_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		write_log('Plugin deactivated.');
	}

}
