
document.onreadystatechange = function() {
  if (document.readyState == "interactive") {
  
  initMap();
}


};
   


function initMap() {

  console.log( '1' );

  var map, infoWindow;

  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 6
  });

  console.log( '2' );

  infoWindow = new google.maps.InfoWindow;

  console.log( '3' );

  // Try HTML5 geolocation.

  console.log( navigator );

  if (navigator.geolocation) {
    console.log( '4' );

    console.log( navigator.geolocation );

    navigator.geolocation.getCurrentPosition(
      function(position) {

        console.log( '5' );
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude

        };
        console.log( '6' );
     

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
        console.log( '7' );
      }, 
      function() {
        console.log( '8' );
        handleLocationError(true, infoWindow, map.getCenter());
      }
    );
  } 
  else {
    console.log( '9' );
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


		    