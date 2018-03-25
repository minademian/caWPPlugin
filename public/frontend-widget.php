<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      0.0.2
 *
 * @package    ca-worldapi
 * @subpackage ca-worldapi/includes/public
 */

class Frontend_Widget extends WP_Widget {
  //initialise widget values
  public function __construct() {
    //set base values for the widget (override parent)
    parent::__construct(
        'Frontend_Widget',
        'CA Meetings Widget',
        array('description' => 'A widget that displays CA meetings in your country')
    );
  }

//handles public display of the widget
//$args - arguments set by the widget area, $instance - saved values
  public function widget( $args, $instance ) {

    include(plugin_dir_path(__FILE__) . 'partials/ca-worldapi-public-display.php');
  }
}