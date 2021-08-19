<?php
define("API_KEY", "AIzaSyA5l7mjh_T5UCviwCoPTeRaUT-5tF_C7sU");
$wayPoints = ["Garki International Market, Abuja, Nigeria","Gwarinpa Ultra Morden Market, Zuba Garki Road, Abuja, Nigeria","Kubwa Village Market, NYSC Road, Abuja, Nigeria"];
?>
<html>
<head>
<title>GNT MAP</title>
<style>
#map-layer {
    max-width: 900px;
    min-height: 550px;
}
.lbl-locations {
    font-weight: bold;
    margin-bottom: 15px;
}
.locations-option {
    display:inline-block;
    margin-right: 15px;
}
.btn-draw {
    background: green;
    color: #ffffff;
}
</style>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
</head>
<body>
    <h1>GNT MAAP</h1>
    <div class="lbl-locations">Travel Mode</div>

    <div>
       <!--  <input type="radio" name="travel_mode" class="travel_mode" value="WALKING"> WALKING -->

        <input type="radio" name="travel_mode" class="travel_mode" value="DRIVING" checked> DRIVING
    </div>
    <div>&nbsp;</div>
    <div class="lbl-locations">Way Points</div>
    <div>
        
    <?php
    foreach ($wayPoints as $wayPoint) {
    ?>
      <div class="locations-option"><input type="hidden" name="way_points[]" class="way_points" value="<?php echo $wayPoint; ?>"> <?php echo $wayPoint; ?></div>
    <?php
    }
    ?>
    <input type="button" id="drawPath" value="Draw Path" class="btn-draw" />
    </div>
    
    <div id="map-layer"></div>
    <script>
      	var map;
		var waypoints
      	function initMap() {
        	  	var mapLayer = document.getElementById("map-layer"); 
            	var centerCoordinates = new google.maps.LatLng(6.441922,3.53191);
        		var defaultOptions = { center: centerCoordinates, zoom: 8 }
        		map = new google.maps.Map(mapLayer, defaultOptions);
	
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            directionsDisplay.setMap(map);

            $("#drawPath").on("click",function() {
            	    waypoints = Array();
                	$('.way_points:input').each(function() {
                    waypoints.push({
                        location: $(this).val(),
                        stopover: true
                    });
                	});
                var locationCount = waypoints.length;
                if(locationCount > 0) {
                    var start = waypoints[0].location;
                    var end = waypoints[locationCount-1].location;
                    drawPath(directionsService, directionsDisplay,start,end);
                }

            });
            
      	}
        	function drawPath(directionsService, directionsDisplay,start,end) {
            directionsService.route({
              origin: start,
              destination: end,
              waypoints: waypoints,
              optimizeWaypoints: true,
              travelMode: $("input[name='travel_mode']:checked"). val()
            }, function(response, status) {
                if (status === 'OK') {
                directionsDisplay.setDirections(response);
                } else {
                window.alert('Problem in showing direction due to ' + status);
                }
                
            });
      }
	</script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo API_KEY; ?>&callback=initMap">
    </script>
</body>
</html>