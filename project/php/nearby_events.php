<?php
/*
    nearby_requests.php

    Has functions that provide getting a list of nearby events
*/
// Include common functions
require_once("common.php");

session_start();

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