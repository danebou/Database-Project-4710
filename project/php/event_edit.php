<?php
/*
    rso_edit.php

    Has functions that provide access for editing an rso
*/ 

// Include common functions
require_once("common.php");

session_start();

$error = "";

$name_value = "";
$date_value = "";
$start_time_value = "";
$end_time_value = "";
$event_category_value = "";
$desc_value = "";
$topic_value = "";
$contact_email_value = "";
$contact_phone_value = "";
$published_value = "";

$eid = "";

if (!empty($_GET["eid"])) {
    $eid = $_GET["eid"]; // set eid
}
if (!empty($_POST["eid"])) {
    $eid = $_POST["eid"]; // set eid
}

// Returns true if the user has access to this page (is the superadmin of the university)
function verify_access($eid) {
    if (empty($_SESSION["userType"])) 
        return false;

    // TODO: verify access
    return true;
}

// Verify that the user has access to this page
if (!verify_access($eid))
    goto_default_page();

// During a submission ...
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check name 
    if (empty($_POST["name"])) {
        $error = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    if (empty($_POST["date"])) {
        $error = "Date is required";
    } else {
        $date = test_input($_POST["date"]);
    }

    if (empty($_POST["start_time"])) {
        $error = "Start time is required";
    } else {
        $start_time = test_input($_POST["start_time"]);
    }

    if (empty($_POST["end_time"])) {
        $error = "End time is required";
    } else {
        $end_time = test_input($_POST["end_time"]);
    }

    if (empty($_POST["contact_email"])) {
        $error = "Contact email is required";
    } else {
        $contact_email = test_input($_POST["contact_email"]);
    }

    if (empty($_POST["contact_phone"])) {
        $error = "Contact phone is required";
    } else {
        $contact_phone = test_input($_POST["contact_phone"]);
    }

    $desc = htmlspecialchars($_POST["desc"]);

    // On success go to the next page
    if ($error == "") {
        rso_edit_submit($eid, $name, $date, $start_time, $end_time, $event_category, 
        $desc, $topic, $contact_email, $contact_phone, $published);
        if ($error == "") {
            goto_page($success_page);
        }
    }
} 

rso_edit_fill($eid);

function rso_edit_submit($eid, $name, $date, $start_time, $end_time, $event_category, 
    $desc, $topic, $contact_email, $contact_phone, $published) {
    if ($eid == "") { // create
        // TODO: create event
    } else {
        // TODO: edit event
    } // edit
}

function rso_edit_fill($eid) {
    global $name_value, $date_value, $start_time_value, $end_time_value, $event_category_value, 
    $desc_value, $topic_value, $contact_email_value, $contact_phone_value, $published_value;
    if ($eid == "")
        return;
    // TODO: retreive name
    $name_value = "Event".$eid;
    $date_value = "yesterday";
    $start_time_value = "now";
    $end_time_value = "yesterday";
    $event_category_value = "alchohol";
    $desc_value = "Wow. You are editing this Event! You're a really really really cool guy! :) Your so cool you approach absolute zero. Your really, really, ugh, ooooh, ahhh!! So mhmm.. oh yeah.. Cooooooooooooooooooool. (so cool)";
    $topic_value = "r/mechanicalkeyboards";
    $contact_email_value = "unprof3ssional6969@Thisprojectshallbefinished.xyzbecausexyzsarecool";
    $contact_phone_value = "555-555-5555";
    $pushlished_value = "soon";
}
?>
<!--
"name"                  $name_value
"date"                  $date_value
"start_time"            $start_time_value
"end_time"              $end_time_value
"event_category"        $event_category_value
"desc"                  $desc_value
"topic"                 $topic_value
"contact_email"         $contact_email_value
"contact_phone"         $contact_phone_value
"published"             $published_value
-->