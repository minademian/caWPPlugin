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

  /*
   * Public methods
   *
   */
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

  public static function persist_meetings_list($countrycode) {
    if (!get_option('ca_worldapi_meetings_list')) {
      update_option('ca_worldapi_meetings_list', self::retrieve_meetings_list($countrycode), '', 'yes' );
    }
  }

  /*
   * Private methods
   */

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

  private static function retrieve_meetings_list($code) {
  	if ( defined( 'API_PROTOCOL' ) ) {
  		$request = wp_remote_get(API_ENDPOINT_MEETINGS);

  		if (is_wp_error($request)) {
  			return false;
  		}

  		$body = wp_remote_retrieve_body($request);
  		$data = self::filter_data(json_decode($body, true), $code);

  		if (!empty($data)) return serialize($data);
  		else return false;
  	}
  }

  private static function filter_data($data, $code) {
    $result = array();

    $country = self::code_to_country($code);

    if ($country != false) {
      foreach ($data as $key => $value){
        if ($value['area'] == self::code_to_country($code)) {
            $result[] = $value;
        }
      }
      return $result;
    } else {
      return false;
    }
  }

  /*
   * Helper functions
   */
  private static function code_to_country($code) {
		/**
		 * This function is temporary until changes are made to the API.
		 */
		$dictionary = array(
      'se' => 'Sweden',
      'gb' => 'United Kingdom',
      'us' => 'United States',
      'nl' => 'Netherlands'
    );
    return (array_key_exists($code, $dictionary)) ? $dictionary[$code] : FALSE;
  }
}