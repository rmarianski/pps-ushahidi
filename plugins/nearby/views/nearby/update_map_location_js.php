<script type="text/javascript">
(function($) {
$(document).ready(function() {
    var lat = <?php echo $lat; ?>;
    var lng = <?php echo $lng; ?>;
    // this should get run after the map setup code
    setTimeout(function() {
        var layers = map.getLayersByName('Markers');
        if (layers.length > 0) {
            var layer = layers[0];
            if (layer.markers.length === 1) {
              var marker = layer.markers[0];
              var lonlat = new OpenLayers.LonLat(lng, lat);
              lonlat.transform(map.displayProjection,
                               map.getProjectionObject());
              var px = map.getLayerPxFromLonLat(lonlat);
              if (!marker.map) {
                marker.map = map;
              }
              marker.moveTo(px);

              map.setCenter(lonlat);
            }
        }
    }, 0);
});
})(jQuery);
</script>
