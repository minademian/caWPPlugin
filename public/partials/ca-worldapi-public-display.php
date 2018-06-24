<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public/partials
 */

  $meetings = unserialize(get_option('ca_worldapi_meetings_list'));

  $address_format = "%s, %s";
  $search = array('(',')');
?>
<section id="content" class="ca-worldapi-meetings-list">
  <ol id="meetings" class="hfeed">
  <?php
  if (is_array($meetings) && count($meetings) > 0) {
	 foreach($meetings as $key=>$meeting) {
    $name = $meeting['name'];
    $desc = $meeting['description'];

    $address = sprintf($address_format, $meeting['street'], $meeting['formatted_address']);
    $data = str_replace($search, '', $meeting['longlat']);
    $coords = explode(',', $data);
    list($long,$lat) = $coords;

    $duration = $meeting['when']['duration'];

    $day = $meeting['when']['day'];
    $start = date('H:i', strtotime($meeting['when']['time']));
    $end = date('H:i', strtotime($meeting['when']['time']) + $duration * $duration);
 ?>
  <li>
      <h2><?php echo $name; ?></h2>
      <p><?php echo $desc; ?></p>
      <p><time><?php echo $start; ?></time> - <time><?php echo $end; ?></time></p>
      <address><?php echo $address; ?></address>
    <div id="map" class="smallmap">
      <script type="text/javascript">
      (function($) {
       $(document).ready(function() {
        var map = new OpenLayers.Map("map");
        map.addLayer(new OpenLayers.Layer.OSM());

    		var lat = <?php echo $lat; ?>;
    		var long = <?php echo $long; ?>;
        var lonLat = new OpenLayers.LonLat(lat,long)
              .transform(
                new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
                map.getProjectionObject() // to Spherical Mercator Projection
              );
        var zoom=16;

        var markers = new OpenLayers.Layer.Markers("Markers");
        map.addLayer(markers);

        markers.addMarker(new OpenLayers.Marker(lonLat));

        map.setCenter (lonLat, zoom);
          });
       })( jQuery );
      </script>
    </div>
  </li>
 <?php
  }
  } else {
  ?>
    There are no meetings listed in CA World for this country!
  <?php
  }
  ?>
  </ol>
</section>