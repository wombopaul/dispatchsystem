<?php
define("API_KEY", "AIzaSyCkdyai5-p_kXTroX-gSz_mz-xeQ8Ht1iY");
?>
<html>
<head>
<title>GNEXT TECH</title>
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
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.0/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="https://mdbootstrap.com/api/snippets/static/download/MDB-Pro_4.19.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://mdbootstrap.com/api/snippets/static/download/MDB-Pro_4.19.2/css/mdb.min.css"><link rel="stylesheet" href="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/css/compiled-addons-4.19.2.min.css">
    <link rel="stylesheet" type="text/css" href="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/css/mdb-plugins-gathered.min.css">
</head>
<body>
    <div class="container" style="margin-top: 120px;">
        <div class="row">
            <div class="col-sm-3" >
               
            </div>
            <div class="col-sm-6">
                <h2 style="text-align:center">
                <img src="{{asset('assets/admin/images/logo.png')}}" width="90px" height="90px;">
                    <b>GNEXT TECH LOGISTIC</b>
                <h2>
                </div>
            <div class="col-sm-12 mt-3" style=" text-align: center;">
                <h2>Client Tracking Terminal</h2>
                    <div class="lbl-locations">Tracking  Mode</div> 
                    <div class="lbl-locations"><input type="radio" name="travel_mode" class="travel_mode" value="DRIVING" checked> DRIVING
                        <div class="locations-option"></div> 
                        <input type="hidden" name="travel_mode" class="travel_mode" value="WALKING"> 
                        
                        <input type="hidden" id="origin" name="way_start" class="way_points" placeholder="Start from" value=" {{ $courierInfo->sender_address }}"> 
                        <input type="hidden" id="destination" name="way_end" class="way_points" placeholder="Destination" value="{{ $courierInfo->receiver_address }}">
                        <div class="lbl-locations">
                            <h4>Pickup Location:</h4>
                            <label>{!! $courierInfo->sender_address !!}</label></div>
                        <div class="lbl-locations">
                            <h4>Drop off Location:</h4>
                             <label>{!! $courierInfo->receiver_address !!}</label>
                         </div>  
                </div>
               
                <div class="col-sm-12 mt-3" style="text-align: center;">
                    <button type="button" id="drawPath" value="Draw Path" class="btn btn-default" data-toggle="modal" data-target="#modalSatellite">
                        Track Drivers Location
                    </button>
                </div>

            </div>
        <div>
       
    </div>
    <div>
        
    
      
      <br>
       <br>
      
  
    

     <br>
     <br>
    </div>
    <!--Modal: Name-->
<div class="modal fade" id="modalSatellite" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">

    <!--Content-->
    <div class="modal-content">

      <!--Body-->
      <div class="modal-body mb-0 p-0">

        <!--Google map-->
        <div id="map-container-google-17" class="z-depth-1-half map-container-10" style="height: 400px">
         <div id="map-layer"></div>
        </div>

      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">

        <button type="button" class="btn btn-default btn-md">Save location <i class="fas fa-map-marker-alt ml-1"></i></button>
        <button type="button" class="btn btn-outline-default btn-md" data-dismiss="modal">Close <i class="fas fa-times ml-1"></i></button>

      </div>

    </div>
    <!--/.Content-->

  </div>
</div>
</div>
</div>
<!--Modal: Name-->



    <style>
    .map-container-9,
.map-container-10,
.map-container-11 {
overflow:hidden;
padding-bottom:56.25%;
position:relative;
height:0;
}
.map-container-9 iframe,
.map-container-10 iframe,
.map-container-11 iframe{
left:0;
top:0;
height:100%;
width:100%;
position:absolute;
}</style>
    <script>
        var map;
        var waypoints;
        function initMap() {
              var mapLayer = document.getElementById("map-layer"); 
              var centerCoordinates = new google.maps.LatLng(6.441922,3.53191);
            var defaultOptions = { center: centerCoordinates, mapTypeId: 'roadmap',zoom: 7

             }

            map = new google.maps.Map(mapLayer, defaultOptions);
  
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            directionsDisplay.setMap(map);

            $("#drawPath").on("click",function() {
                    var start =$("#origin").val();
                    var end = $("#destination").val();
                    drawPath(directionsService, directionsDisplay,start,end);
              
            });
            
        }
          function drawPath(directionsService, directionsDisplay,start,end) {
            directionsService.route({
              origin: start,
              destination: end,
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
    <script type="text/javascript" src="https://mdbootstrap.com/api/snippets/static/download/MDB-Pro_4.19.2/js/jquery.min.js"></script>
<script type="text/javascript" src="https://mdbootstrap.com/api/snippets/static/download/MDB-Pro_4.19.2/js/popper.min.js"></script>
<script type="text/javascript" src="https://mdbootstrap.com/api/snippets/static/download/MDB-Pro_4.19.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://mdbootstrap.com/api/snippets/static/download/MDB-Pro_4.19.2/js/mdb.min.js"></script>
<script type="text/javascript" src="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/js/bundles/4.19.2/compiled-addons.min.js"></script>
<script type="text/javascript" src="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/js/plugins/mdb-plugins-gathered.min.js"></script>
<script type="text/javascript">{}</script>
</body>
</html>