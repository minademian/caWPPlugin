<?php
  $country = get_option('ca_worldapi_active_country');
	$message = 'Your default country is <strong>%s<strong>.';
?>
<div>
	<p><?php _e(sprintf($message, $country), 'CA_WORLDAPI_PLUGIN_TEXT_DOMAIN' ); ?></p>
</div>
<?php include_once plugin_dir_path( __FILE__ ) . './ca-worldapi-admin-meetings.php'; ?>