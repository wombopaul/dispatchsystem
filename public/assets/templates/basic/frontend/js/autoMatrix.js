$(function() {
        // add input listeners
    google.maps.event.addDomListener(window, 'load', function () {
        var from_places = new google.maps.places.Autocomplete(document.getElementById('from_places'));
        var to_places = new google.maps.places.Autocomplete(document.getElementById('to_places'));
        

        google.maps.event.addListener(from_places, 'place_changed', function () {
            var from_place = from_places.getPlace();
            var from_address = from_place.formatted_address;
            $('#origin').val(from_address);
        });

        google.maps.event.addListener(to_places, 'place_changed', function () {
            var to_place = to_places.getPlace();
            var to_address = to_place.formatted_address;
            $('#destination').val(to_address);
        });

    });
});

var destinationArray = [];
// calculate distance
function calculateDistance(origin, destination) {   

    var destinations = $('input[name^=receiver_address_hidden]').map(function(idx, elem) {
        return $(elem).val();
    }).get();
    
    destinationArray.push(destination);

    for (var i=0; i < destinations.length; i++){
        destinationArray.push(destinations[i]);
    }

    var service = new google.maps.DistanceMatrixService();
    service.getDistanceMatrix({
        origins: [origin],
        destinations: destinationArray,
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.IMPERIAL, // miles and feet.
        // unitSystem: google.maps.UnitSystem.metric, // kilometers and meters.
        avoidHighways: false,
        avoidTolls: false
    }, callback);
}
// get distance results
function callback(response, status) {
    if (status != google.maps.DistanceMatrixStatus.OK) {
        $('#result').html(err);
    } else {
        var origin = response.originAddresses[0];
        var destination = response.destinationAddresses[0];
        if (response.rows[0].elements[0].status === "ZERO_RESULTS") {
            $('#result').html("Better get on a plane. There are no roads between "  + origin + " and " + destination);
        } else {
            console.log(response);
            var distance = 0;
            var duration = 0;
            for (var i=0; i < destinationArray.length; i++){
                distance += response.rows[0].elements[i].distance.value / 1609.34;
            }
            for (var i=0; i < destinationArray.length; i++){
                duration += response.rows[0].elements[i].duration.value;
            }
            
            var typedelivery = $('#typedelivery').val(); 
            var categoryDelivery = $('#categoryDelivery').val(); 
            var costOfTripDeci = (distance * 200) + (categoryDelivery + typedelivery); 
            var costOfTrip = Math.round(costOfTripDeci);
            
            $('#duration_cost').val(costOfTrip);
            $('#duration_text').text(secondsToHms(duration));
            $('#from').text(origin);
            
            var ds = $('input[name^=receiver_address]').map(function(idx, elem) {
                return $(elem).val();
            }).get();          

            
            var to = '';
            for (var i = 0; i < ds.length; i++){
                to += ds[i] + ' To ';
            }
            $('#to').text(to);
            $('#duration_cost2').text('₦ '+ costOfTrip);
            
        }
    }
}
function secondsToHms(d) {
    d = Number(d);
    var h = Math.floor(d / 3600);
    var m = Math.floor(d % 3600 / 60);
    var s = Math.floor(d % 3600 % 60);

    var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : " hours, ") : "";
    var mDisplay = m > 0 ? m + (m == 1 ? " minute, " : " minutes, ") : "";
    var sDisplay = s > 0 ? s + (s == 1 ? " second" : " seconds") : "";
    return hDisplay + mDisplay + sDisplay; 
}

// print results on submit the form
$(document).on('click', '#nextPageBtn', function(e){
    e.preventDefault();
    var origin = $('#origin').val();
    var destination = $('#destination').val();
    if(origin != '' && destination != ''){
        calculateDistance(origin, destination);
    }
});