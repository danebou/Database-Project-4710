<!-- 
    rso_requests.php

    This will be used to list all the rso requests for an admin
-->
<?php
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/rso_requests.php");
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
                <li class="breadcrumb-item active"> Page Title</li>
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
            </div>

            <!-- Area Chart Example -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-user-plus"></i> RSO Join Requests
                </div>
                <div class="card-block">
                    <p class="small-text"> These are RSO Join Requests requiring approval </p>
                    <p class="small-text"> Now check out these groovy rso join requests you can approve/remove: </p>
                    <p class="small-text">
                    	<!-- Displays available universities --> 
						<?php echo $rso_requests?>
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

</body>

</html>