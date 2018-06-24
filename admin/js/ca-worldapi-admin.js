(function($) {
   $(document).ready(function() {
    var map = new OpenLayers.Map("map");
    map.addLayer(new OpenLayers.Layer.OSM());
		var lat = "<?php echo $lat; ?>";
		var long = "<?php echo $long; ?>"
console.log(lat, long);
    var lonLat = new OpenLayers.LonLat(lat,long)
          .transform(
            new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
            map.getProjectionObject() // to Spherical Mercator Projection
          );

    var zoom=16;

    var markers = new OpenLayers.Layer.Markers( "Markers" );
    map.addLayer(markers);

    markers.addMarker(new OpenLayers.Marker(lonLat));

    map.setCenter (lonLat, zoom);
      });
 })( jQuery );