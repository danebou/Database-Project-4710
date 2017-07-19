<?php
/*
    nearby_requests.php

    Has functions that provide getting a list of nearby events
*/
// Include common functions
require_once("common.php");

session_start();

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

// Redirect if the user is not a superadmin
if (empty($_SESSION["userType"])) 
    goto_default_page();

// List of nearby events and edit/delete buttons for current superadmin
$nearby_events = "";

// get nearby 
if (!empty($_GET["location"])) {
    $nearby_events = get_nearbyevents_list($_GET["location"]);
}

/* 
    Returns all current event requests
*/
function find_current_requests($location) {
    // TODO: get actual events
    return array("4", "5", "6");
}

// Gets a table of request links for the current superadmin
function get_nearbyevents_list($location) {
    $list = '<table>';
    foreach (find_current_requests($location) as $eid) {
        $list = $list."<tr>"; // Row start      
        $list = $list.'<td>'.create_event_link($eid).'</td>';
        $list = $list."<tr>"; // Row end
    }
    $list = $list."</table>"; // close list
    return $list;
}

function get_event_name($eid) {
    return "Event ".$eid;
}

/// create an event link
function create_event_link($eid) {
    return '<a href=event_view.php?eid='.$eid.'>'.get_event_name($eid).'</a>';
}

?>