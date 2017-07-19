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
<!DOCTYPE html>
<html lang="en">

<head>

   <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link href="css/map.css" rel="stylesheet">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="">
    <title>COP4710 Group 12</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar static-top navbar-toggleable-md navbar-inverse bg-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">College Event Planner</a>
        <div class="collapse navbar-collapse" id="navbarExample">
			<?php echo get_accessable_page_links()?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content-wrapper py-3">

        <div class="container-fluid">

            <!-- Breadcrumbs -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Edit University</li>
            </ol>

            <!-- Icon Cards -->
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card card-inverse card-primary o-hidden h-100">
                        <div class="card-block">
                            <div class="card-block-icon">
                                <i class="fa fa-fw fa-address-book"></i>
                            </div>
                            <div class="mr-5">
                                My RSO's
                            </div>
                        </div>
                        <a href="my_rso_list.php" class="card-footer clearfix small z-1">
                            <span class="float-left">View the RSO's you're a member of</span>
                            <span class="float-right"><i class="fa fa-angle-right"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card card-inverse card-success o-hidden h-100">
                        <div class="card-block">
                            <div class="card-block-icon">
                                <i class="fa fa-fw fa-institution"></i>
                            </div>
                            <div class="mr-5">
                                Universities
                            </div>
                        </div>
                        <a href="all_universities.php" class="card-footer clearfix small z-1">
                            <span class="float-left">View the list of Universities</span>
                            <span class="float-right"><i class="fa fa-angle-right"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card card-inverse card-warning o-hidden h-100">
                        <div class="card-block">
                            <div class="card-block-icon">
                                <i class="fa fa-fw fa-calendar"></i>
                            </div>
                            <div class="mr-5">
                                My Events
                            </div>
                        </div>
                        <a href="my_event_list.php" class="card-footer clearfix small z-1">
                            <span class="float-left">View your events</span>
                            <span class="float-right"><i class="fa fa-angle-right"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card card-inverse card-danger o-hidden h-100">
                        <div class="card-block">
                            <div class="card-block-icon">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                            <div class="mr-5">
                                Search/Join RSO
                            </div>
                        </div>
                        <a href="search_join_rso.php" class="card-footer clearfix small z-1">
                            <span class="float-left">Search or join the avaiable RSO's</span>
                            <span class="float-right"><i class="fa fa-angle-right"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3" <?php echo hide_admin_links()?> >
                    <div class="card card-inverse card-danger o-hidden h-100">
                        <div class="card-block">
                            <div class="card-block-icon">
                                <i class="fa fa-fw fa-user-plus"></i>
                            </div>
                            <div class="mr-5">
                                RSO Join Requests
                            </div>
                        </div>
                        <a href="rso_requests.php" class="card-footer clearfix small z-1">
                            <span class="float-left">View the requests to join your RSOs</span>
                            <span class="float-right"><i class="fa fa-angle-right"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3" <?php echo hide_superadmin_links()?>>
                    <div class="card card-inverse card-primary o-hidden h-100">
                        <div class="card-block">
                            <div class="card-block-icon">
                                <i class="fa fa-fw fa-sitemap"></i>
                            </div>
                            <div class="mr-5">
                                My Universities
                            </div>
                        </div>
                        <a href="my_university_list.php" class="card-footer clearfix small z-1">
                            <span class="float-left">View the Universities you manage</span>
                            <span class="float-right"><i class="fa fa-angle-right"></i></span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3" <?php echo hide_superadmin_links()?>>
                    <div class="card card-inverse card-success o-hidden h-100">
                        <div class="card-block">
                            <div class="card-block-icon">
                                <i class="fa fa-fw fa-plus-square"></i>
                            </div>
                            <div class="mr-5">
                                Non-RSO Event Requests
                            </div>
                        </div>
                        <a href="event_requests.php" class="card-footer clearfix small z-1">
                            <span class="float-left">View the requests for Non-RSO Events</span>
                            <span class="float-right"><i class="fa fa-angle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Area Chart Example -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-area-chart"></i> Edit University
                </div>
                <div class="card-block">
                    <p class="small-text">
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
                    </p>
                </div>
            </div> 
        </div>
        <!-- /.container-fluid -->
		
            
        
    </div>
    <!-- /.content-wrapper -->

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/sb-admin.min.js"></script>
	<span><?php echo $error?></span>
</body>

</html>
