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
                    <i class="fa fa-calendar"></i> <?php echo $name?>
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