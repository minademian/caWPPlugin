<?php $list = unserialize(get_option('ca_worldapi_countries_list')); ?>
<div class="wrap">
	<h2>CA Meetings</h2>
	<?php
		settings_errors();
 		if (get_option('ca_worldapi_country_set') == false) {
	?>
  <p><strong>Please select your country.</strong> You will only have to do this once.</p>
  <form name="select-country" id="select-country" action="<?php echo site_url( 'wp-admin', 'relative' ) . '/admin-post.php'?>" method="POST">
	 <input type="hidden" name="action" value="custom_action_hook">
	 <label for="country">Country</label>
   <select name="country" id="country">
    <option value="">-- none selected</option>
	 <?php foreach($list as $key=>$country) { ?>
    <option value="<?php echo $country["code"]; ?>"><?php echo $country["name"]; ?></option>
	 <?php } ?>
	 </select>
	 <button type="submit" name="submit" id="submit">Set</button>
  </form>
  <?php
		} else {
			var_dump($_POST) . '<br>';
			echo 'your selected country is ' . get_option('ca_worldapi_active_country');
	?>

	<?php
		}
	?>
	</div>