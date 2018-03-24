<div id="ca-worldapi-add_notice"></div>
<p><strong>Please select your country.</strong> You will only have to do this once.</p>
<form name="select-country" id="select-country" action="<?php echo site_url( 'wp-admin', 'relative' ) . '/admin-post.php'?>" method="POST">
 <input type="hidden" name="action" value="country-callback">
 <?php
  $list = unserialize(get_option('ca_worldapi_countries_list'));
  if (is_array($list) && count($list) > 0) {
 ?>
 <label for="country">Country</label>
   <select name="country" id="country">
    <option value="">-- none selected</option>
	 <?php foreach($list as $key=>$country) { ?>
    <option value="<?php echo $country["code"]; ?>"><?php echo $country["name"]; ?></option>
	 <?php } ?>
	 </select>
	 <button type="submit" name="submit" id="submit">Set</button>
 <?php
  } else {
  ?>
    There was a problem communicating with the CA World API.
  <?php
  }
  ?>
</form>