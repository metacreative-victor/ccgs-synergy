jQuery( function($) {
	function render_map( $el ) {
		// var
		var $markers = $el.find('.marker');
		// vars
		var args = {
			scrollwheel : false,
			zoom		: 16,
			center		: new google.maps.LatLng(0, 0),
			mapTypeId	: google.maps.MapTypeId.ROADMAP,
			styles: [
			  {
			    "stylers": [
			      {
							//"saturation": -100
						}
			    ]
			  }
			]
		};
		// create map
		var map = new google.maps.Map( $el[0], args);
		// add a markers reference
		map.markers = [];
		// add markers
		$markers.each(function(){
	    add_marker( $(this), map );
		});
		// center map
		center_map( map );
	}

	/*
	*  add_marker
	*/
	function add_marker( $marker, map ) {
		// var
		var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

		function getBaseURL() {
		    var url = location.href;  // entire url including querystring - also: window.location.href;
		    var baseURL = url.substring(0, url.indexOf('/', 14));

		    if (baseURL.indexOf('http://localhost') != -1) {
		        // Base Url for localhost
		        var url = location.href;  // window.location.href;
		        var pathname = location.pathname;  // window.location.pathname;
		        var index1 = url.indexOf(pathname);
		        var index2 = url.indexOf("/", index1 + 1);
		        var baseLocalUrl = url.substr(0, index2);
		        return baseLocalUrl + "/";
		    }
		    else {
		        // Root Url for domain name
		        return baseURL + "/";
		    }
		}

		if (document.location.hostname == "localhost") {
			var imageMarker = 'http://localhost/SITE_NAME/wp-content/themes/SITE_NAME/assets/img/map-marker.png';
		}
		else if (document.location.hostname == "birdbrain.io") {
			var imageMarker = 'http://birdbrain.io/SITE_NAME/wp-content/themes/SITE_NAME/assets/img/map-marker.png';
		}
		else {
			var imageMarker = 'SITE_URL/wp-content/themes/SITE_NAME/assets/img/map-marker.png';
		}

		var image = imageMarker;
		// create marker
		var marker = new google.maps.Marker({
			position	: latlng,
			map				: map,
			icon    	: image
		});
		// add to array
		map.markers.push( marker );
		// if marker contains HTML, add it to an infoWindow
		if( $marker.html() )
		{
			// create info window
			var infowindow = new google.maps.InfoWindow({
				content		: $marker.html()
			});
			// show info window when marker is clicked
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open( map, marker );
			});
		}
	}

	/*
	*  center_map
	*/

	function center_map( map ) {
		// vars
		var bounds = new google.maps.LatLngBounds();
		// loop through all markers and create bounds
		$.each( map.markers, function( i, marker ){
			var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
			bounds.extend( latlng );
		});
		// only 1 marker?
		if( map.markers.length == 1 )
		{
			// set center of map
		    map.setCenter( bounds.getCenter() );
		    map.setZoom( 16 );
		}
		else
		{
			// fit to bounds
			map.fitBounds( bounds );
		}
	}

	$('.acf-map').each(function(){
		render_map( $(this) );
	});
});
