<?php
/*
    event_view.php

    Has functions that retrieves data for an event
*/ 
// Include common functions
require_once("common.php");

session_start();

// default
$eid = "";
$name = "";
$date = "";
$start_time = "";
$end_time = "";
$event_category = "";
$desc = "";
$topic = "";
$contact_email = "";
$contact_phone = "";
$published = "";
$comments_list = "";

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

function verify_access($rsoName) {
    // TODO verify user is a member of 
    return true;
}

function set_event($eid) {
    global $name, $date, $start_time, $end_time, $category, $desc, $topic, $contact_email, $contact_phone, $published, $comments_list;
    $name = "Event ".$eid;
    $date = "In a day and a half from the day before yesterday";
    $start_time = "before the age of time";
    $end_time = "after the age of now";
    $category = "paradoxes";
    $desc = "This is a crazy off the china event. I meant to say chains but china will do just as well";
    $topic = "Craziness";
    $contact_email = "Professor Pickle Chips";
    $contact_phone = "555-5-5-5-5-5-5-5-55555";
    $published = "About now";
    $comments_list = "Wow what a super cool event.\n\n this event is cookl!";
    // TODO: get event values
}

if (!empty($_GET["eid"]))
    $eid = $_GET["eid"];
if (!empty($_POST["eid"]))
    $eid = $_POST["eid"];

// Set university values
if ($_SERVER["REQUEST_METHOD"] == "GET") {

}

function add_comment($comment, $eid) {
    // TODO add comment to event
}

function update_rating($rating) {
    
}

if ($eid != "") {
    if (!verify_access($eid))
        goto_default_page();
    set_event($eid);
}

?>