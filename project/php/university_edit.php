<?php
/*
    university_edit.php

    Has functions that provide access to the list of university editing and submission for data access
*/ 

// Include common functions
require_once("common.php");

session_start();

$error = "";

$name_value = "";
$studCount_value = "0";
$desc_value = "";

$uid = "";

if (!empty($_GET["uid"])) {
    $uid = $_GET["uid"]; // set uid
}
if (!empty($_POST["uid"])) {
    $uid = $_POST["uid"]; // set uid
}

// Returns true if the user has access to this page (is the superadmin of the university)
function verify_access() {
    if (empty($_SESSION["userType"]) || $_SESSION["userType"] != "superadmin") 
        return false;

    // TODO: verify access

    return true;
}

// Verify that the user has access to this page
if (!verify_access())
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

    $desc = htmlspecialchars($_POST["desc"]);

    // On success go to the next page
    if ($error == "") {
        university_edit_submit($uid, $name, $studCount, $desc);
        if ($error == "") {
            goto_page($success_page);
        }
    }
} 
// During a redirect to this page
else if ($_SERVER["REQUEST_METHOD"] == "GET") {
}

university_edit_fill($uid);

function university_edit_submit($uid, $name, $studCount, $desc) {
    if ($uid == "") { // create
        // TODO: create uni
    } else {
        // TODO: edit uni
    } // edit
}

function university_edit_fill($uid) {
    global $name_value, $studCount_value, $desc_value;
    if ($uid == "")
        return;
    // TODO: retreive name
    $name_value = "University ".$uid;
    $studCount_value = "42";
    $desc_value = "Wow. You are editing this university! You're a really cool guy! :)";
}
?>