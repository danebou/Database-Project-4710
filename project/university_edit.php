<!-- 
    university_edit.php

    This will be used as the page to edit an university
-->
<?php
    // If there is a successful registration, it will then jump to this page:
    $success_page = "my_university_list.php?edit=success"; 
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/university_edit.php");
?>
<html>
<head>
   <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link href="css/map.css" rel="stylesheet">
</head>
<body>

<a href="index.php">Home</a>
<br>
<b> Edit University </b>

<!-- Registration form (Submit to backend in php/register.php"-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
University Name: <input type="text" name="name" value="<?php echo $name_value?>">
<br>
Number of Students: <input type="text" name="studCount" value="<?php echo $studCount_value?>">
<br>
Email Domain (ex: knights.ucf.edu): <input type="text" name="domain" value="<?php echo $domain_value?>">
<br>
Description: <textarea name="desc" rows="5" cols="40"><?php echo $desc_value?></textarea>
<br>
Location: <textarea name="loc_desc" rows="5" cols="40"><?php echo $loc_desc_value?></textarea>
<br>
<input type="hidden" id="loc_lat" name="loc_lat" value="0">
<input type="hidden" id="loc_long" name="loc_long" value="0">
<input type="hidden" name="uid" value="<?php echo $uid?>">
<input type="submit" name="submit" value="Submit"> 
</form>

<input id="pac-input" class="controls" type="text" placeholder="Search Box">
<div id="map"></div>
<script>
    var map;
    function initMap() {
        var lat_val = <?php echo $loc_lat_value ?>;
        var long_val = <?php echo $loc_long_value ?>;
        var use_default_loc = "<?php echo $loc_use_default ?>";
        var myLatlng = {lat: lat_val, lng: long_val};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: myLatlng,
          mapTypeId: 'roadmap'
        });

        var marker = new google.maps.Marker({
          position: myLatlng,
          map: map,
          title: 'Click to zoom'
        });

        map.addListener('center_changed', function() {
          // 3 seconds after the center of the map has changed, pan back to the
          // marker.
          window.setTimeout(function() {
            map.panTo(marker.getPosition());
          }, 3000);
           var center = map.getCenter();
           marker.setPosition(center);
           document.getElementById("loc_lat").value = center.lat();
           document.getElementById("loc_long").value = center.lng();
        });

        marker.addListener('click', function() {
          map.setZoom(8);
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });

              // Try HTML5 geolocation.
        if (use_default_loc && navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            map.setCenter(pos);
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
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgku-7Byl_9eaBVgYoZRhjp_hrONxe4Jc&libraries=places&callback=initMap"
async defer></script>

<!-- This displays any error when registering -->
<span><?php echo $error?></span>

</body>
</html>