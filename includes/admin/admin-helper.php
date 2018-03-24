<?php

/**
 * Fired during plugin activation
 *
 * @link       
 * @since      0.0.2
 *
 * @package    ca-worldapi
 * @subpackage ca-worldapi/includes/admin
 */

namespace CA_Worldapi\includes\admin;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      0.0.2
 * @package    ca-worldapi
 * @subpackage ca-worldapi/includes/admin
 * @author     Mina Demian <mina@minademian.com>
 */
class Admin_Helper {

	public function options() {
		if (!current_user_can( 'manage_options'))  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		include_once plugin_dir_path( __FILE__ ) . 'admin/partials/ca-worldapi-admin-display.php';
	}
}