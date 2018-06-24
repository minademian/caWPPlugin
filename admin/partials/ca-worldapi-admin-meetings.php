<section id="content" class="ca-worldapi-meetings-list">
  <ol id="meetings" class="hfeed">
 <?php
  $meetings = unserialize(get_option('ca_worldapi_meetings_list'));

  $address_format = "%s, %s";
  $search = array('(',')');
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
  <article class="hentry">
    <header>
      <h2><?php echo $name; ?></h2>
    </header>
    <section>
      <p><?php echo $desc; ?></p>
    </section>
    <section class="meeting-map">
    <div id="map" class="map">
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
    </section>
    <footer class="meeting-info">
      <section>
        <p><time><?php echo $start; ?></time> - <time><?php echo $end; ?></time></p>
      </section>
      <address><?php echo $address; ?></address>
    </footer>
  </article>
  </li>
 <?php
  }
  } else {
  ?>
    There was a problem communicating with the CA World API.
  <?php
  }
  ?>
  </ol>
</section>