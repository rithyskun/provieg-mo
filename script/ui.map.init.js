$(function() {

	google.maps.event.addDomListener(window, 'load', function() {
		// Latitudes & Langtitudes in Singapore
		/*var center = new google.maps.LatLng(8.468996, 106.578503);*/
		var center = new google.maps.LatLng(1.358763, 103.833553);
		var option =  {
			zoom : 15,
			center : center,
			disableDefaultUI: true,
			mapTypeId : google.maps.MapTypeId.ROADMAP
		}
		var map = new google.maps.Map(document.getElementById('map_canvas'), option);
		
		var marker = null;
		var onMarkerClick = function() {
			marker = this;
			marker.info.open(map, marker);
		};
		
		google.maps.event.addListener(map, 'click', function() {
			if(marker != null) marker.info.close();
		});
		
		// Latitudes & Langtitudes marker in Singapore
		var s_LatLng = new google.maps.LatLng(1.358763, 103.833553);
		var s_Marker = new google.maps.Marker({
			map : map,
			position : s_LatLng
		});
		s_Marker.info = new google.maps.InfoWindow({
			  content: '<div class="info-window">' +
							'<h4>PROVIVAGLOBAL PTE LTD</h4>' +
							'<div>' +
								'MIDVIEW CITY BLOCK 8, #08-01, Sin Ming Lane Singapore 573969<br>' +
								'Please contact us<br>' +
								'Email:</span>&nbsp;&nbsp;<a href="mailto:info@provivaglobal.com">info@provivaglobal.com</a>' +
							'</div>' +
						'</div>'
		});
		
		// Latitudes & Langtitudes marker in Cambodia
		/*var c_LatLng = new google.maps.LatLng(11.574277, 104.891581);
		var c_Marker = new google.maps.Marker({
			map : map,
			position : c_LatLng
		});
		c_Marker.info = new google.maps.InfoWindow({
			  content: '<div class="info-window">' +
							'<h4>CCPL Global Co.Ltd</h4>' +
							'<div>' +
								'No. 59, Street 313 Toul Kork Phnom Penh<br>' +
								'Please contact us<br>' +
								'Email:</span>&nbsp;&nbsp;<a href="mailto:info@provivaglobal.com">info@provivaglobal.com</a>' +
							'</div>' +
						'</div>'
		});*/
		google.maps.event.addListener(s_Marker, 'click', onMarkerClick);
		/*google.maps.event.addListener(c_Marker, 'click', onMarkerClick);*/
	});

});