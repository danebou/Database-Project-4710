<!-- 
    university_view.php

    This will be used as the page to publically view a university
-->
<?php
    $uni_pics_dir = "img/"; // The directory where the pics are stored for the university
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/university_view.php");
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
<b> <?php echo $uni_name?> </b>
<br>
<p> <?php echo $uni_desc?> </p>
<br>
Students: <?php echo $uni_student_count?> 
<br>

<?php echo $uni_pics ?>
<br>
<?php echo $uni_event_list?>
<br>
<p> Location: <?php echo $loc_desc?> </p>
<div id="map"></div>
<script>
    var map;
    function initMap() {
        var lat_val = <?php echo $loc_lat ?>;
        var long_val = <?php echo $loc_long ?>;
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

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            var cur_loc_marker = new google.maps.Marker({
            position: pos,
            map: map,
            title: 'My location'
            });
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