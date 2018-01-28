<?php

defined( 'ABSPATH' ) or die( 'Nope, not accessing this' );

class ca_worldapi_shortcode{
//on initialize
public function __construct(){
    add_action('init', array($this,'register_meetings_shortcodes')); //shortcodes
}

//location shortcode
public function register_meetings_shortcodes(){
    add_shortcode('ca_meetings', array($this,'meetings_shortcode_output'));
}
}