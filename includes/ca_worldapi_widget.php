<?php 

defined('ABSPATH') or die('Nope, not accessing this');

function register_ca_worldapi_widgets(){
    register_widget('ca_worldapi_widget');
}

add_action('widgets_init', 'register_ca_worldapi_widgets');

class ca_worldapi_widget extends WP_widget {
//initialise widget values
public function __construct() {
    //set base values for the widget (override parent)
    parent::__construct(
        'ca_worldapi_widget',
        'CA Meetings Widget', 
        array('description' => 'A widget that displays CA meetings in your country')
    );
    add_action('widgets_init',array($this,'register_ca_worldapi_meetings_widgets'));
}

    //handles the back-end admin of the widget
    //$instance - saved values for the form
    public function form($instance){
        //collect variables 
        $location_id = (isset($instance['location_id']) ? $instance['location_id'] : 'default');
        $number_of_locations = (isset($instance['number_of_locations']) ? $instance['number_of_locations'] : 5);

        ?>
        <p>Select your options below</p>
        <p>
            <label for="<?php echo $this->get_field_name('location_id'); ?>">Location to display</label>
            <select class="widefat" name="<?php echo $this->get_field_name('location_id'); ?>" id="<?php echo $this->get_field_id('location_id'); ?>" value="<?php echo $location_id; ?>">
                <option value="default">All Locations</option>
                <?php
                $args = array(
                    'posts_per_page'    => -1,
                    'post_type'         => 'wp_locations'
                );
                $locations = get_posts($args);
                if($locations){
                    foreach($locations as $location){
                        if($location->ID == $location_id){
                            echo '<option selected value="' . $location->ID . '">' . get_the_title($location->ID) . '</option>';
                        }else{
                            echo '<option value="' . $location->ID . '">' . get_the_title($location->ID) . '</option>';
                        }
                    }
                }
                ?>
            </select>
        </p>
        <p>
            <small>If you want to display multiple locations select how many below</small><br/>
            <label for="<?php echo $this->get_field_id('number_of_locations'); ?>">Number of Locations</label>
            <select class="widefat" name="<?php echo $this->get_field_name('number_of_locations'); ?>" id="<?php echo $this->get_field_id('number_of_locations'); ?>" value="<?php echo $number_of_locations; ?>">
                <option value="default" <?php if($number_of_locations == 'default'){ echo 'selected';}?>>All Locations</option>
                <option value="1" <?php if($number_of_locations == '1'){ echo 'selected';}?>>1</option>
                <option value="2" <?php if($number_of_locations == '2'){ echo 'selected';}?>>2</option>
                <option value="3" <?php if($number_of_locations == '3'){ echo 'selected';}?>>3</option>
                <option value="4" <?php if($number_of_locations == '4'){ echo 'selected';}?>>4</option>
                <option value="5" <?php if($number_of_locations == '5'){ echo 'selected';}?>>5</option>
                <option value="10" <?php if($number_of_locations == '10'){ echo 'selected';}?>>10</option>
            </select>
        </p>
        <?php
    }
//handles updating the widget 
//$new_instance - new values, $old_instance - old saved values
public function update($new_instance, $old_instance){

    $instance = array();

    $instance['location_id'] = $new_instance['location_id'];
    $instance['number_of_locations'] = $new_instance['number_of_locations'];

    return $instance;
}

//handles public display of the widget
//$args - arguments set by the widget area, $instance - saved values
public function widget( $args, $instance ) {

    //get wp_simple_location class (as it builds out output)
    global $wp_simple_locations;

    //pass any arguments if we have any from the widget
    $arguments = array();
    //if we specify a location

    //if we specify a single location
    if($instance['location_id'] != 'default'){
        $arguments['location_id'] = $instance['location_id'];
    }
    //if we specify a number of locations
    if($instance['number_of_locations'] != 'default'){
        $arguments['number_of_locations'] = $instance['number_of_locations'];
    }

    //get the output
    $html = '<h2>Meetings List</h2>';
    $html .= "<div><h3>Mina & Gus's happy meeting</h3><p>Hässelby gård, Stockholm, Sweden</p><p><strong>Monday, 19:00, 1hr</strong><h3>Cartmans meeting!</h3><p>Tired of getting FUUUUCKED!</p><p><strong>South Park, Colorado, United States</strong><p>Monday, 19:00, 1hr</p>";
    echo $html;
}
}
