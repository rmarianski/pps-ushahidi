function initialize() {
	var myLatlng = new google.maps.LatLng(<?php echo $latitude; ?>,<?php echo $longitude; ?>);
	var myOptions = {
	  zoom: 12,
	  center: myLatlng,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	}

	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    
	var marker = new google.maps.Marker({
	    position: myLatlng,
	    map: map,
		title: 'Marker'
	});
	
	marker.setMap(map);
}