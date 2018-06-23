<div id="ca-worldapi-add_notice"></div>
<p><strong>Please select your region and country.</strong> You will only have to do this once.</p>
<form name="select-country" id="select-country" action="<?php echo site_url( 'wp-admin', 'relative' ) . '/admin-post.php'?>" method="POST">
 <input type="hidden" name="action" value="country-callback">
 <?php
  $data = unserialize(get_option('ca_worldapi_locations'));

  if (is_array($data) && count($data) > 0) {
?>
  <label for="country">Country</label>
  <select name="country" id="country">
   <option value="">-- none selected</option>
    <?php
    	 foreach($data as $index=>$array) {
          foreach($array as $key=>$value) {
            if ($key == 'region_name') $region = $value;
            if ($key == 'areas') {
              $countries = $value;
              foreach ($countries as $key=>$array) {
                foreach ($array as $key => $row) {
                    $country = $row;
                    $input = $region . '|' . $country;
                  ?> <option value="<?php echo $input; ?>"><?php echo $country;?></option> <?php
                }
              }
            }
          }
    	 }
    ?>
  </select>
  <button type="submit" name="submit" id="submit">Set</button>
</form>
<?php
}
?>