<?php
/*
    event_view.php

    Has functions that retrieves data for an event
*/ 
// Include common functions
require_once("common.php");

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