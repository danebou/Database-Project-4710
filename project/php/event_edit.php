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
$date_value = "";
$event_category_value = "";
$desc_value = "";
$topic_value = "";
$contact_email_value = "";
$contact_phone_value = "";
$published_value = "";
$type_value = "";
$loc_desc_value = "";
$loc_long_value = 0.0;
$loc_lat_value = 0.0;
$loc_use_default = true;

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

    $desc = $_POST["desc"];
    $event_category = $_POST["desc"];
    $topic = $_POST["desc"];
    $visibility = $_POST["visibility"];

    $location = array($_POST["loc_desc"], $_POST["loc_lat"], $_POST["loc_long"]); // (name, long, lat)

    // On success go to the next page
    if ($error == "") {
        rso_edit_submit($eid, $name, $date, $event_category, 
        $desc, $topic, $contact_email, $contact_phone, $location, $visibility, $rsoName);
        if ($error == "") {
            goto_page($success_page);
        }
    }
} 

event_edit_fill($eid);

function event_edit_submit($eid, $name, $date, $event_category, 
        $desc, $topic, $contact_email, $contact_phone, $location, $visibility, $rsoName) {
    $uid = get_uid();
    if ($eid == "") { // create
        event_create($name, $date, $event_category, 
        $desc, $topic, $contact_email, $contact_phone, $location);
    } else {
        event_edit($eid, $name, $date, $event_category, 
            $desc, $topic, $contact_email, $contact_phone, $location);
    } // edit
}

function event_create($name, $date, $event_category, 
        $desc, $topic, $contact_email, $contact_phone, $location, $visibility, $rsoName) {
        global $error;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return false;
    }

    $sql = "INSERT into location (description, latitude, longitude) 
        VALUES ('".$location[0]."', '".$location[1]."', '".$location[2]."')";
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }

    $sql = "SELECT LAST_INSERT_ID();";
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
    
    $lid = ($result->fetch_row())[0];

    $sql = sprintf("INSERT into event (name, dateTime, topic, contactEmail, eventCategory, contactPhone, description, visibility, rsoName, lid, uid, owner, approved) 
         VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %s, '%s', %s, '%s', '%s')",
         $name,
         $date,
         $topic,
         $contact_email,
         $contact_phone,
         $description
         $visibility,
         $rsoName == "" ? NULL : "'" + $rsoName + "'",
         $lid,
         $uid == "" ? NULL : "'" + $uid + "'",
         $SESSION["userId"],
         (visibility == "Public" ? "0" : "1")
         );
    if (!$conn->query($sql)) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }

    $conn->close();
}

function event_edit($eid, $name, $date, $event_category, 
        $desc, $topic, $contact_email, $contact_phone, $location) {

}

function event_edit_fill($eid) {
    global $name_value, $date_value, $event_category_value, 
    $desc_value, $topic_value, $contact_email_value, $contact_phone_value, $published_value;
    global $error;

    if ($eid == "")
        return;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return false;
    }

    $sql = "SELECT *
            FROM event E
            WHERE E.eid = '".$eid."'";
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
    $row = $result->fetch_row();

    $lid = $row["lid"];
    $name_value = $row["name"];
    $date_value = $row["dateTime"];
    $event_category_value = $row["eventCategory"];
    $desc_value = $row["description"];
    $topic_value = $row["topic"];
    $contact_email_value = $row["contactEmail"];
    $contact_phone_value = $row["contactPhone"];

    $sql = "SELECT description, latitude, longitude
            FROM location L
            WHERE L.lid = '".$lid."'";
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
    $row = $result->fetch_row();
    $conn->close();

    // TODO: retreive name
    $loc_use_default=false;
    $loc_desc_value=$row[0];
    $loc_long_value=floatval($row[2]);
    $loc_lat_value=floatval($row[1]);
}
?>