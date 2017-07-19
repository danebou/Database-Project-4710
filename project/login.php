<!-- 
    Login.php

    This will be used as the main page to login
    Once the submit button is hit, if there is an error, a refresh occurs and displays 
    the error at the bottom. If there is no error, it will automatically got to the appropriate next page
-->
<?php
    // If there is a successful login, it will then jump to this page:
    $login_success_page = "index.php"; 
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/login.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
<body>
	<div style="height:200px; top:20%; margin:0 auto;">
    </div>
    <div class="container" style="width:450px; margin:0 auto;">
        <div class="row">
            <div class="col-md-12 col-md-offset-1">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="panel-title" >Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="userId" type="userID" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
	                            <!-- Change this to a button or input when using this as a form -->
                                <input class="btn btn-lg btn-success btn-block" type="submit" name="submit" value="Submit">
                                								<div>
                                <!-- This displays any error when logging in -->
								<span><?php echo $error?></span> <br>
                                </div>
                                <div>
                                New User? <a href="register.php">Register</a>
                                <!-- This displays a successful registration -->
								<span><?php echo $registration?></span>
								</div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>