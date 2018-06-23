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
class API_Parser {

  /*
   * Public methods
   *
   */
  /*
	 * [region_name] => Pacific North
	    [areas] => Array
	        (
	            [0] => Array
	                (
	                    [area_name] => Alaska
	                )
	 */
	const MAX_LEVEL = 5; // change it as needed

public static function convert($a, $level=0)
{

    if(!is_array($a)) {
        throw new InvalidArgumentException(sprintf('Type %s cannot be cast, array expected', gettype($a)));
    }

    if($level > self::MAX_LEVEL) {
        throw new OverflowException(sprintf('%s stack overflow: %d exceeds max recursion level', __METHOD__, $level));
    }

    $o = new stdClass();
    foreach($a as $key => $value) {
        if(is_array($value)) { // convert value recursively
            $value = $this->convert($value, $level+1);
        }
        $o->{$key} = $value;
    }
    return $o;
}
	public static function convesrt($list) {
	
	//write_log($list);
		// return $list;
	}
}