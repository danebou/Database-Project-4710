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
$rsoName = "";
$userid = "";
$value = "";

// Returns true if the user has access to this page (is the superadmin of the university)
function verify_access($rsoName) {
    global $error;
    if (empty($_SESSION["userType"])) 
        return false;

    // Give access to new rso
    if ($rsoName == "" && $_SESSION["userType"] != "superadmin")
        return true;

    if ($_SESSION["userType"] != "admin")
        return false;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return false;
    }

    $sql = "SELECT count(*) FROM rso as R WHERE R.adminid = '".$_SESSION["userId"]."'
    AND R.rsoName = '".$rsoName."'";
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

if (!empty($_GET["rsoName"]))
    $rsoName = urldecode($_GET["rsoName"]); // set uid

if (!empty($_GET["userid"]))
    $userid = urldecode($_GET["userid"]); // set uid

if (!empty($_GET["value"]))
    $value = urldecode($_GET["value"]); // set uid

// Verify that the user has access to this page
if (!verify_access($rsoName))
    goto_default_page();

function aprove_request($rsoName, $userid, $value) {
    global $error;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return;
    }

    // Delete
    $sql = "DELETE FROM stud_requests WHERE userid = '".$userid."'
    AND rsoName = '".$rsoName."'";
    if (!$conn->query($sql)) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return;
    }

    if ($value != "approve") {
        $conn->close();
        return;
    }

    // Approve
    $sql = sprintf("INSERT INTO stud_joins (userid, rsoName) 
    VALUES('%s', '%s')",
    $userid, $rsoName);
    if (!$conn->query($sql)) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return;
    }

    $conn->close();
}

if ($rsoName != "" && $userid != "" && $value != "") {
    aprove_request($rsoName, $userid, $value);
    if ($error == "") 
        goto_page("rso_requests.php");
}

