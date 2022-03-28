<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css">   
        html { height: 100% }   
        body { height: 100%; margin: 0px; padding: 0px }   
        #map_canvas { height: 100% } 
    </style> 
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript">
		function initialize()
		{
		<?php
			$counts = 0;
			$address = new Address();
			$results = $address->getAll($user->getId());
			while($results && $result = mysql_fetch_array($results))
			{
				$lat = $result["lat"];
				$lng = $result["lng"];
				$fulladdress = $result["number"]." ".$result["street"]." ".$result["apartment"];
		?>
			var latlng = new google.maps.LatLng(<?php echo($lat) ?>, <?php echo($lng) ?>);
		<?php if($counts == 0) { ?>
			var myOptions = {
				zoom: 18, 
				center: latlng, 
				navigationControl: true,
				scaleControl: true,
				scaleControlOptions: {         
					position: google.maps.ControlPosition.TOP_LEFT     
				},					
				navigationControlOptions: {
					style: google.maps.NavigationControlStyle.ZOOM_PAN,         
					position: google.maps.ControlPosition.TOP_RIGHT     
				}, 
				mapTypeId: google.maps.MapTypeId.HYBRID,
				mapTypeControlOptions: { 
					style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
					position: google.maps.ControlPosition.BOTTOM
				}
			};
			var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		<?php 
			};
			$counts += 1;
		?>
			var marker = new google.maps.Marker({
					position: latlng,
					title:'<?php echo($fulladdress) ?>'
			}); 
			
			// Set marker on map
			marker.setMap(map);
		<?php
			}
		?>
		}
    </script>
</head>

<body onload="initialize()">
	<div id="map_canvas" style="width:100%; height:100%"></div>
</body>
</html>