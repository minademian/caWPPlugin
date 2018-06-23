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

  protected static $countries;
  protected static $countries_endpoint;
  protected static $meetings_endpoint;

  /*
   * Public methods
   *
   */
  public static function initialize_connection() {
    $url = '%s%s';
    API::$countries_endpoint = sprintf($url, API_URI, COUNTRIES_ENDPOINT);
    API::$meetings_endpoint = sprintf($url, API_URI, MEETINGS_ENDPOINT);
  }

  public static function retrieve_locations() {
  	$request = wp_remote_get(API::$countries_endpoint);
  		if (is_wp_error($request)) {
  			return $request;
  		}

  		$body = wp_remote_retrieve_body($request);
  		$data = json_decode($body, true);

  		if (!empty($data)) return $data;
  		else {
        return false;
      }
  }

  public static function retrieve_meetings($country) {
  	$request = wp_remote_get(API::$meetings_endpoint);
  		if (is_wp_error($request)) {
  			return $request;
  		}

  		$body = wp_remote_retrieve_body($request);
  		$data = json_decode($body, true);
      foreach ($data as $key => $array) {
        if ($array['area'] == $country) $filtered[] = $array;
      }

  		if (!empty($filtered)) return $filtered;
  		else {
        return false;
      }
  }
}