<?php
/*
    university_view.php

    Has functions that retrieves data for a universtiy
*/ 
// Include common functions
require_once("common.php");
require_once("database.php");

session_start();

// default
$rso_name = "";
$rso_desc = "";
$rso_student_count = "";
$rso_event_list = "";

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

$error = "";

function verify_member($rsoName) {
    global $error;
    if (empty($_SESSION["userType"])) 
        return false;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return false;
    }

    // Check admin
    $sql = sprintf("SELECT count(*) 
    FROM rso as R 
    WHERE R.adminid = '%s'
    AND R.rsoName = '%s'", 
    $_SESSION["userId"], $rsoName);
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }

    if (($result->fetch_row())[0] > 0) {
        $conn->close();
        return true;
    }

    $sql = sprintf("SELECT count(*) 
    FROM stud_join as J 
    WHERE J.userid = '%s'
    AND R.rsoName = '%s'", 
    $_SESSION["userId"], $rsoName);
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }

    if (($result->fetch_row())[0] > 0)
        return true;

    $conn->close();
}

function get_rso_events($rsoName) {
    if (!verify_member($rsoName)) // Only members can see events
        return array();

    // TODO: get event
    return array("156", "45");
}

function get_student_count($rsoName) {
    global $error;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return false;
    }

    $sql = sprintf("SELECT count(*) 
    FROM stud_joins as J
    WHERE J.rsoName = '%s'", 
    $rsoName);
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return 0;
    }

    $conn->close();

    return ($result->fetch_row())[0];
}

function set_rso($rsoName) {
    global $rso_name, $rso_desc, $rso_student_count, $rso_event_list, $error;
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
    $conn->close();
    
    // TODO: get rso values
    $rso_name = $rsoName;
    $rso_desc = $row[0];
    $rso_student_count = get_student_count($rsoName);
    $rso_event_list = create_event_list(get_rso_events($rsoName));
}

// create a html list of pictures given comma separated pic file nmaes
function create_event_list($events) {
    $list = "<ul>"; // Start list
    foreach ($events as $eid) {
        $list = $list."<li>".create_event($eid)."</li>";
    }

    $list = $list."</ul>";
    return $list;
}

// create a html picture with a given resource
function create_event($eid) {
    return '<a href=event_view.php?eid='.$eid.'>'.get_event_name($eid).'</a>';
}

function get_event_name($eid) {
    return "Some event ".$eid;
}

// Set university values
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($_GET["rsoName"])) {
       set_rso(urldecode($_GET["rsoName"]));
    }
}
?>