<?php
/*
    rso_edit.php

    Has functions that provide access for editing an rso
*/ 

// Include common functions
require_once("common.php");
require_once("database.php");

session_start();

$error = "";

$name_value = "";
$studCount_value = "0";
$desc_value = "";

$rsoName = "";

if (!empty($_GET["rsoName"])) {
    $rsoName = urldecode($_GET["rsoName"]); // set name
}
if (!empty($_POST["rsoName"])) {
    $rsoName = $_POST["rsoName"]; // set namne
}

//Function to hide the big admin link cards
function hide_admin_links() {
	
	if ($_SESSION["userType"] == "admin") {
		$style = 'style="display:visible"';
	}
	else {
		$style = 'style="display:none"';
	}
	return $style;
}

//Function to hide the big super admin link cards
function hide_superadmin_links() {
	
	if ($_SESSION["userType"] == "superadmin") {
		$style = 'style="display:visible"';
	}
	else {
		$style = 'style="display:none"';
	}
	return $style;
}

/*
    Gets a table of available pages to goto
*/
function get_accessable_page_links() {
	// TODO: ad more links
    $links = '<ul class="sidebar-nav navbar-nav">'; // start list
    $links = $links.'<li class="nav-item"><a class="nav-link" href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> </li>';
    $links = $links.'<li class="nav-item"><a class="nav-link" href="my_rso_list.php"><i class="fa fa-fw fa-address-book"></i> My RSOs</a> </li>';
    $links = $links.'<li class="nav-item"><a class="nav-link" href="all_universities.php"><i class="fa fa-fw fa-institution"></i> Universities</a> </li>';
    $links = $links.'<li class="nav-item"><a class="nav-link" href="my_event_list.php"><i class="fa fa-fw fa-calendar-o"></i> My Events</a> </li>';
    $links = $links.'<li class="nav-item"><a class="nav-link" href="search_join_rso.php"><i class="fa fa-fw fa-search"></i> Search/Join RSO</a> </li>';
    if ($_SESSION["userType"] == "admin") {
        $links = $links.'<li class="nav-item"><a class="nav-link" href="rso_requests.php"><i class="fa fa-fw fa-user-plus"></i> RSO Join Requests</a> </li>';
    }
    if ($_SESSION["userType"] == "superadmin") {
        $links = $links.'<li class="nav-item"><a class="nav-link" href="my_university_list.php"><i class="fa fa-fw fa-sitemap"></i> My Universities</a> </li>';
        $links = $links.'<li class="nav-item"><a class="nav-link" href="event_requests.php"><i class="fa fa-fw fa-plus-square"></i> Non-RSO Event Requests</a> </li>';
    }
    $links = $links.'</ul>'; // close list
    return $links;
}


// Returns true if the user has access to this page (is the superadmin of the university)
function verify_access($rsoName) {
    global $error;
    if (empty($_SESSION["userType"])) 
        return false;

    // Give access to new rso
    if ($rsoName == "" && $_SESSION["userType"] != "superadmin")
        return true;

    if ($_SESSION["userType"] != "admin")
        return false;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return false;
    }

    $sql = sprintf("SELECT count(*) 
    FROM rso as R 
    WHERE R.adminid = '%s'
    AND R.rsoName = '%s'", $_SESSION["userId"], $rsoName);
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }

    if (($result->fetch_row())[0] <= 0)
        return false;

    $conn->close();
    
    return true;
}

// Verify that the user has access to this page
if (!verify_access($rsoName))
    goto_default_page();

// During a submission ...
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check name 
    if (empty($_POST["newName"])) {
        $error = "Name is required";
    } else {
        $newName = test_input($_POST["newName"]);
    }

    $desc = htmlspecialchars($_POST["desc"]);

    // On success go to the next page
    if ($error == "") {
        rso_edit_submit($rsoName, $newName, $desc);
        if ($error == "") {
            goto_page($success_page);
        }
    }
} 

rso_edit_fill($rsoName);

function rso_edit_submit($rsoNameOld, $rsoNameNew, $desc) {
    if ($rsoNameOld == "") { // create
        rso_create($rsoNameNew, $desc);
    } else {
        rso_edit($rsoNameOld, $rsoNameNew, $desc);
    } // edit
}

function rso_create($name, $desc) {
    global $error;
    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return false;
    }

    // Give user admin
    $sql = "UPDATE user
            SET userType = 'admin'
            WHERE userType = 'student' and userid = '".$_SESSION["userId"]."'";
    if (!$conn->query($sql)) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
    if ($_SESSION["userType"] == 'student')
        $_SESSION["userType"] = 'admin';

    // Insert rso
    $sql = "INSERT into rso (rsoName, adminid, description, status) 
         VALUES ('".$name."', '".$_SESSION["userId"]."', '".$desc."', 'needs_members')";
    if (!$conn->query($sql)) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }

    $conn->close();
}

function rso_edit($rsoNameOld, $rsoNameNew, $desc) {
    global $error;
    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return false;
    }

    // Insert rso
    $sql = "UPDATE rso
        SET rsoName='".$rsoNameNew."', description='".$desc."' 
        WHERE rsoName = '".$rsoNameOld."' AND adminid='".$_SESSION["userId"]."'";
    if (!$conn->query($sql)) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }

    $conn->close();
}

function rso_edit_fill($rsoName) {
    global $name_value, $studCount_value, $desc_value;
    if ($rsoName == "")
        return;
    $name_value = $rsoName;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return false;
    }

    $sql = "SELECT description
            FROM rso R
            WHERE R.rsoName ='".$rsoName."'";
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
    
    $row = $result->fetch_row();
    $desc_value = $row[0];
    $conn->close();
}
?>