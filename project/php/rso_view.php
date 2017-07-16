<?php
/*
    university_view.php

    Has functions that retrieves data for a universtiy
*/ 
// Include common functions
require_once("common.php");

// default
$rso_name = "";
$rso_desc = "";
$rso_student_count = "";
$rso_event_list = "";

function verify_member($rsoName) {
    // TODO verify user is a member of 
    return true;
}

function get_rso_events($rsoName) {
    if (!verify_member($rsoName)) // Only members can see events
        return array();

    // TODO: get event
    return array("156", "45");
}

function set_rso($rsoName) {
    global $rso_name, $rso_desc, $rso_student_count, $rso_event_list;
    $rso_name = $rsoName;
    // TODO: get rso values
    $rso_desc = "This is a todo-er. But this rso likes to party!";
    $rso_student_count = "43 (Wow! That's a lot of students! More than any university. Weird. You're weird. No, I'm werid. Well, aren't we all";
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
       set_rso($_GET["rsoName"]);
    }
}
?>