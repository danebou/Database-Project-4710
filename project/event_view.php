<!-- 
    event_view.php

    This will be used to view an event
-->
<?php
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/event_view.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

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
    
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'>
	</script>

</head>

<body id="page-top">

	<!-- submits radio star button -->
	<script type='text/javascript'>

 	$(document).ready(function() { 
   		$('input[name=rating]').change(function(){
        	$('form').submit();
   		});
  	});

	</script>

    <!-- Navigation -->
    <nav id="mainNav" class="navbar static-top navbar-toggleable-md navbar-inverse bg-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">College Event Planner</a>
        <div class="collapse navbar-collapse" id="navbarExample">
			<?php echo get_accessable_page_links()?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-2" href="#" id="messagesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-envelope"></i> <span class="hidden-lg-up">Messages <span class="badge badge-pill badge-primary">12 New</span></span>
                        <span class="new-indicator text-primary hidden-md-down"><i class="fa fa-fw fa-circle"></i><span class="number">12</span></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">New Messages:</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>David Miller</strong> <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>Jane Smith</strong> <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>John Doe</strong> <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item small" href="#">
                            View all messages
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-2" href="#" id="alertsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-bell"></i> <span class="hidden-lg-up">Alerts <span class="badge badge-pill badge-warning">6 New</span></span>
                        <span class="new-indicator text-warning hidden-md-down"><i class="fa fa-fw fa-circle"></i><span class="number">6</span></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
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
                <li class="breadcrumb-item active"><?php echo $name?></li>
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
                                <i class="fa fa-fw fa-users"></i>
                            </div>
                            <div class="mr-5">
                                Browse RSO's
                            </div>
                        </div>
                        <a href="search_join_rso.php" class="card-footer clearfix small z-1">
                            <span class="float-left">Search or join the avaiable RSO's</span>
                            <span class="float-right"><i class="fa fa-angle-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Area Chart Example -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-area-chart"></i> <?php echo $name?>
                </div>
                <div class="card-block">
                    <p class="small-text"> Date: <?php echo $date?> </p>
                    <p class="small-text"> Time: <?php echo $start_time?> - <?php echo $end_time?> </p>
                    <p class="small-text"> Category: <?php echo $category?> </p>
                    <p class="small-text"> Description: <?php echo $desc?> </p>
                    <p class="small-text"> Topic: <?php echo $topic?> </p>
                    <p class="small-text"> Contact Email: <?php echo $contact_email?> </p>
                    <p class="small-text"> Contact Phone: <?php echo $contact_phone?> </p>
                    <p class="small-text"> Published: <?php echo $published?> </p>
                    <p class="small-text">
                    	<iframe width="500" height="400" frameborder="0" src="https://www.bing.com/maps/embed?h=400&w=500&cp=20.418073553978985~-80.4865173441178&lvl=6&typ=d&sty=r&src=SHELL&FORM=MBEDV8" scrolling="no">
     					</iframe>
                    </p>
                    <p class="small-text">
                    	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						Add Comment: <textarea name="desc" rows="5" cols="40"></textarea><br>
						<input type="hidden" name="eid" value="<?php echo $eid?>">
						<input type="submit" name="submit" value="Comment"> 
						</form>
                    </p>
                    <p class="small-text"> Comments:<br><?php echo $comments_list ?> </p>
                </div>
                <div class="card-footer small text-muted">
                    Updated yesterday at 11:59 PM
                </div>
            </div>

            <div class="row">

                <div class="col-lg-8">

                    <!-- Example Bar Chart Card -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-bar-chart"></i> Bar Chart Example
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-8">
                                    <canvas id="myBarChart" width="100" height="50"></canvas>
                                </div>
                                <div class="col-sm-4 text-center">
                                    <hr class="hidden-sm-up">
                                    <div class="h4 mb-0 text-primary">$34,693</div>
                                    <div class="small text-muted">YTD Revenue</div>
                                    <hr>
                                    <div class="h4 mb-0 text-warning">$18,474</div>
                                    <div class="small text-muted">YTD Expenses</div>
                                    <hr>
                                    <div class="h4 mb-0 text-success">$16,219</div>
                                    <div class="small text-muted">YTD Margin</div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer small text-muted">
                            Updated yesterday at 11:59 PM
                        </div>
                    </div>

                    <!-- Card Columns Example Social Feed -->
                    <div class="card-columns">

                        <!-- Example Social Card -->
                        <div class="card mb-3">
                            <a href="#">
                                <img class="card-img-top img-fluid w-100" src="https://unsplash.it/700/450?image=610" alt="">
                            </a>
                            <div class="card-block">
                                <h6 class="card-title mb-1"><a href="#">David Miller</a></h6>
                                <p class="card-text small">These waves are looking pretty good today! <a href="#">#surfsup</a></p>
                            </div>
                            <hr class="my-0">
                            <div class="card-block py-2 small">
                                <a class="mr-3 d-inline-block" href="#">
                                    <i class="fa fa-fw fa-thumbs-up"></i> Like
                                </a>
                                <a class="mr-3 d-inline-block" href="#">
                                    <i class="fa fa-fw fa-comment"></i> Comment
                                </a>
                                <a class="d-inline-block" href="#">
                                    <i class="fa fa-fw fa-share"></i> Share
                                </a>
                            </div>
                            <hr class="my-0">
                            <div class="card-block small bg-faded">
                                <div class="media">
                                    <img class="d-flex mr-3" src="http://placehold.it/45x45" alt="">
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1"><a href="#">John Smith</a></h6> Very nice! I wish I was there! That looks amazing!
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="#">Like</a>
                                            </li>
                                            <li class="list-inline-item">
                                                ·
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">Reply</a>
                                            </li>
                                        </ul>
                                        <div class="media mt-3">
                                            <a class="d-flex pr-3" href="#">
                                                <img src="http://placehold.it/45x45" alt="">
                                            </a>
                                            <div class="media-body">
                                                <h6 class="mt-0 mb-1"><a href="#">David Miller</a></h6> Next time for sure!
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item">
                                                        <a href="#">Like</a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        ·
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="#">Reply</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer small text-muted">
                                Posted 32 mins ago
                            </div>
                        </div>

                        <!-- Example Social Card -->
                        <div class="card mb-3">
                            <a href="#">
                                <img class="card-img-top img-fluid w-100" src="https://unsplash.it/700/450?image=180" alt="">
                            </a>
                            <div class="card-block">
                                <h6 class="card-title mb-1"><a href="#">John Smith</a></h6>
                                <p class="card-text small">Another day at the office... <a href="#">#workinghardorhardlyworking</a></p>
                            </div>
                            <hr class="my-0">
                            <div class="card-block py-2 small">
                                <a class="mr-3 d-inline-block" href="#">
                                    <i class="fa fa-fw fa-thumbs-up"></i> Like
                                </a>
                                <a class="mr-3 d-inline-block" href="#">
                                    <i class="fa fa-fw fa-comment"></i> Comment
                                </a>
                                <a class="d-inline-block" href="#">
                                    <i class="fa fa-fw fa-share"></i> Share
                                </a>
                            </div>
                            <hr class="my-0">
                            <div class="card-block small bg-faded">
                                <div class="media">
                                    <img class="d-flex mr-3" src="http://placehold.it/45x45" alt="">
                                    <div class="media-body">
                                        <h6 class="mt-0 mb-1"><a href="#">Jessy Lucas</a></h6> Where did you get that camera?! I want one!
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="#">Like</a>
                                            </li>
                                            <li class="list-inline-item">
                                                ·
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#">Reply</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer small text-muted">
                                Posted 46 mins ago
                            </div>
                        </div>

                        <!-- Example Social Card -->
                        <div class="card mb-3">
                            <a href="#">
                                <img class="card-img-top img-fluid w-100" src="https://unsplash.it/700/450?image=281" alt="">
                            </a>
                            <div class="card-block">
                                <h6 class="card-title mb-1"><a href="#">Jeffery Wellings</a></h6>
                                <p class="card-text small">Nice shot from the skate park! <a href="#">#kickflip</a> <a href="#">#holdmybeer</a> <a href="#">#igotthis</a></p>
                            </div>
                            <hr class="my-0">
                            <div class="card-block py-2 small">
                                <a class="mr-3 d-inline-block" href="#">
                                    <i class="fa fa-fw fa-thumbs-up"></i> Like
                                </a>
                                <a class="mr-3 d-inline-block" href="#">
                                    <i class="fa fa-fw fa-comment"></i> Comment
                                </a>
                                <a class="d-inline-block" href="#">
                                    <i class="fa fa-fw fa-share"></i> Share
                                </a>
                            </div>
                            <div class="card-footer small text-muted">
                                Posted 1 hr ago
                            </div>
                        </div>

                    </div>
                    <!-- /Card Columns -->

                </div>

            </div>
            
            <!-- Example Tables Card -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Data Table Example
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted">
                    Updated yesterday at 11:59 PM
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

</body>

</html>