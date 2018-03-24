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
class API {

  public static function persist_countries_list() {
  	if (!get_option('ca_worldapi_countries_list')) {
  		update_option('ca_worldapi_countries_list', self::retrieve_countries_list(), '', 'yes');
  	} else {
  		// if (!get_option('ca_worldapi_active_country')) {
  		// 	update_option('ca_worldapi_country_set', false, '', 'yes');
  		// 	write_log('no active country set.');
  		// }
  	}
  }

  private static function retrieve_countries_list() {
  	if ( defined( 'API_PROTOCOL' ) ) {
  		$request = wp_remote_get(API_ENDPOINT_COUNTRIES);

  		if (is_wp_error($request)) {
  			return false;
  		}

  		$body = wp_remote_retrieve_body($request);
  		$data = json_decode($body, true);
  		if (!empty($data)) return serialize($data);
  		else return false;
  	}
  }
}