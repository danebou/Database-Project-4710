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
$uni_name = "";
$uni_desc = "";
$uni_student_count = "";
$uni_pics = "";
$uni_event_list = "";

$error = "";

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

function verify_member() {
    if (empty($_SESSION["userType"])) 
        return false;
    // TODO verify user is a member of 
    return true;
}

function get_rso_events($uid) {
    global $error;

    if (!verify_member()) // Only members can see events
        return array();

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return false;
    }

    $conn->close();

    // TODO: get event
    return array("156", "45");
}

function set_university($uid) {
    global $error;
    global $uni_name, $uni_desc, $uni_student_count, $uni_pics, $uni_event_list;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return false;
    }

    $sql = "SELECT numOfStudents, name, description, pictures, lid
            FROM university";
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
    $row = $result->fetch_row();
    $conn->close();

    $picsValue = "test1.png,test2.png,test3.png";

    $uni_name = $row[1];
    $uni_desc = $row[2];
    $uni_student_count = $row[0];
    $uni_pics = create_pictures_list($picsValue);
    $uni_event_list = create_event_list(get_rso_events($uid));
}

// create a html list of pictures given comma separated pic file nmaes
function create_pictures_list($picsValue) {
    global $uni_pics_dir; 
    $list = "<ul>"; // Start list
    $pics_list = explode(",", $picsValue);
    foreach ($pics_list as $pic) {
        $list = $list."<li>".create_picture($uni_pics_dir.$pic)."</li>";
    }

    $list = $list."</ul>";
    return $list;
}

// create a html picture with a given resource
function create_picture($resourceId) {
    return '<img src="'.$resourceId.'" />';
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
    if (!empty($_GET["uid"])) {
       set_university($_GET["uid"]);
    }
}
?>