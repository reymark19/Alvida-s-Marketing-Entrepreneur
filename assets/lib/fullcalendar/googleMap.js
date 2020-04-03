
//GOOOGLE MAP INIT

// Create the search box and link it to the UI element.
//var input = document.getElementById('address');
//var searchBox = new google.maps.places.SearchBox(input);

  function initMap() {
	$(document).ready(function() {
		console.log('Map is Set')

		var input = document.getElementById('pac-input');
	    var autocomplete = new google.maps.places.Autocomplete(input);
	    var directionsService = new google.maps.DirectionsService;
	    var directionsDisplay = new google.maps.DirectionsRenderer;
	    var latlng = new google.maps.LatLng(10.334442, 123.941725);
	    var map = new google.maps.Map(document.getElementById('map'), {
	      zoom: 17,
	      center: latlng,
	      fullscreenControl: true
	    });
	    directionsDisplay.setMap(map);
	    //$('#map').hide();	

	    var onChangeHandler = function() {
	      calculateAndDisplayRoute(directionsService, directionsDisplay);
	    };
	    document.getElementById('pac-input').addEventListener('focusout', onChangeHandler);
	    var autocomplete = new google.maps.places.Autocomplete(input);
	    //autocomplete.bindTo('bounds', map);
	     $('#showMap').click(function(){
		        $('#map').slideDown(500);
		        //$('#showMap').text('Zoom Map');
		        calculateAndDisplayRoute(directionsService, directionsDisplay);
		        //$('#pac-input').focus();
		        //$('#pac-input').focusout();
		  		//$('#pac-input').trigger('focusout');
		  });
	    $(window).resize(function() {
	        google.maps.event.trigger(map, 'resize');
	    });
	    google.maps.event.trigger(map, 'resize');
	});
  }

  function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        directionsService.route({
          origin: '530 A. C. Cortes Ave, Mandaue City, Central Visayas, Philippines',
          destination: document.getElementById('pac-input').value,
          travelMode: 'DRIVING'
        }, function(response, status) {
	    google.maps.event.trigger(map, 'resize');
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            $('#map').slideDown(500);
            //$('#pac-input').trigger('focusout');
            //console.log($('.gm-fullscreen-control'));
            //$('.gm-fullscreen-control').trigger('click');
          } else {
            error('Directions request failed');
          }
        });
      }

