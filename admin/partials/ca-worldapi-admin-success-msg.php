<?php
  $country = get_option('ca_worldapi_active_country');
	$message = 'Your default country is <strong>%s<strong>.';
?>
<div>
	<p><?php _e(sprintf($message, $country), 'CA_WORLDAPI_PLUGIN_TEXT_DOMAIN' ); ?></p>
</div>