
document.onreadystatechange = function() {
	if (document.readyState == "interactive") {
	initMap();
}



   
var map, infoWindow;

function initMap() {

	

map = new google.maps.Map(document.getElementById('map'), {
  center: {lat: -34.397, lng: 150.644},
  zoom: 6
});
infoWindow = new google.maps.InfoWindow;

// Try HTML5 geolocation.
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(function(position) {
    var pos = {
      lat: position.coords.latitude,
      lng: position.coords.longitude

    };

 

    infoWindow.setPosition(pos);
    infoWindow.setContent('Location found.');
    infoWindow.open(map);
    map.setCenter(pos);

    lat = pos.lat;
    lng = pos.lng;

	console.log( "lat:" + lat );
    console.log( "lng:" + lng );
    document.getElementById('lattitude').value = lat;
    document.getElementById('longitude').value = lng;
    console.log(document.getElementById('longitude').value);

    // document.getElementById

}, function() {
    handleLocationError(true, infoWindow, map.getCenter());
  });
} else {
  // Browser doesn't support Geolocation
  handleLocationError(false, infoWindow, map.getCenter());
}
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
infoWindow.setPosition(pos);
infoWindow.setContent(browserHasGeolocation ?
                      'Error: The Geolocation service failed.' :
                      'Error: Your browser doesn\'t support geolocation.');
infoWindow.open(map);
}

};
		    