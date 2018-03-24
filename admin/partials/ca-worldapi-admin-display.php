<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       
 * @since      0.0.2
 *
 * @package    ca-worldapi
 * @subpackage ca-worldapi/admin/partials
 */
?>
<div class="wrap">
	<h2>CA Meetings</h2>
	<?php
 		if (get_option('ca_worldapi_country_set') == false && !isset($_GET)) {
			include_once plugin_dir_path(__FILE__) . './ca-worldapi-admin-select-country.php';
		} else {
			include_once plugin_dir_path( __FILE__ ) . './ca-worldapi-admin-success-msg.php';
		}
	?>
</div>
