<?php
/*
    university_edit.php

    Has functions that provide access to the list of university editing and submission for data access
*/ 

// Include common functions
require_once("common.php");
require_once("database.php");

session_start();

$error = "";

$name_value = "";
$studCount_value = "0";
$desc_value = "";
$domain_value = "";
$loc_desc_value = "";
$loc_long_value = 0.0;
$loc_lat_value = 0.0;
$loc_use_default = true;

$uid = "";

$event_threshold = 1.0;

if (!empty($_GET["uid"])) {
    $uid = $_GET["uid"]; // set uid
}
if (!empty($_POST["uid"])) {
    $uid = $_POST["uid"]; // set uid
}

// Returns true if the user has access to this page (is the superadmin of the university)
function verify_access($uid) {
    global $error;

    if (empty($_SESSION["userType"]) || $_SESSION["userType"] != "superadmin") 
        return false;

    // TODO: verify access
    if ($uid == "") // New uni. We are okay
        return true;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return false;
    }

    $sql = "SELECT count(*) FROM university as U WHERE U.createProfileBy = '".$_SESSION["userId"]."'
    AND U.uid = '".$uid."'";
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }

    $conn->close();

    if (($result->fetch_row())[0] <= 0)
        return false;

    return true;
}

// Verify that the user has access to this page
if (!verify_access($uid))
    goto_default_page();

// During a submission ...
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check name 
    if (empty($_POST["name"])) {
        $error = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    // Check student count 
    if (empty($_POST["studCount"])) {
        $error = "Student count is required";
    } else {
        $studCount = htmlspecialchars($_POST["studCount"]);
    }

    // Check domain
    if (empty($_POST["domain"])) {
        $error = "Domain is required";
    } else {
        $domain = htmlspecialchars($_POST["domain"]);
    }

    $desc = htmlspecialchars($_POST["desc"]);
    $pictures = "";
    $location = array($_POST["loc_desc"], $_POST["loc_lat"], $_POST["loc_long"]); // (name, long, lat)

    // On success go to the next page
    if ($error == "") {
        university_edit_submit($uid, $name, $studCount, $desc, $pictures, $domain, $location);
        if ($error == "") {
            goto_page($success_page);
        }
    }
} 
// During a redirect to this page
else if ($_SERVER["REQUEST_METHOD"] == "GET") {
}

university_edit_fill($uid);

function university_edit_submit($uid, $name, $studCount, $desc, $pictures, $domain, $location) {
    
    if ($uid == "") { // create
        create_university($uid, $name, $studCount, $desc, $pictures, $domain, $location);
    } else {
        edit_university($uid, $name, $studCount, $desc, $pictures, $domain, $location);
    } // edit
}

function create_university($uid, $name, $studCount, $desc, $pictures, $domain, $location) {
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

    $sql = "INSERT into university (numOfStudents, name, description, domain, pictures, createProfileBy, lid) 
         VALUES ('".$studCount."', '".$name."', '".$desc."', '".$domain."', '".$pictures."', '".$_SESSION["userId"]."', '".$lid."')";
    if (!$conn->query($sql)) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }

    $conn->close();
}

function edit_university($uid, $name, $studCount, $desc, $pictures, $domain, $location) {
    global $error;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return false;
    }

    $sql = "SELECT (lid)
            FROM university U
            WHERE U.uid = '".$uid."'";
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }

    $lid = $result->fetch_row()[0];

    $sql = "UPDATE university 
        SET numOfStudents='".$studCount."', name='".$name."', description='".$desc."', 
        domain='".$domain."', pictures='".$pictures."'
        WHERE uid='".$uid."'"; 
    if (!$conn->query($sql)) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }

    $sql = "UPDATE location 
        SET description='".$location[0]."', latitude='".$location[1]."', longitude='".$location[2]."'
        WHERE lid='".$lid."'"; 
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }

    $conn->close();
}

function university_edit_fill($uid) {
    global $error;
    global $name_value, $studCount_value, $desc_value, $domain_value,
        $loc_desc_value, $loc_lat_value, $loc_long_value, $loc_use_default;
    if ($uid == "")
        return;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return false;
    }

    $sql = "SELECT numOfStudents, name, description, domain, pictures, lid
            FROM university U
            WHERE U.uid = '".$uid."'";
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
    $row = $result->fetch_row();

    $lid = $row[5];
    $name_value = $row[1];
    $studCount_value = $row[0];
    $desc_value = $row[2];
    $domain_value = $row[3];

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