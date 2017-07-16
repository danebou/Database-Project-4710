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
$studCount_value = "0";
$desc_value = "";

$rsoName = "";

if (!empty($_GET["rsoName"])) {
    $rsoName = $_GET["rsoName"]; // set name
}
if (!empty($_POST["rsoName"])) {
    $rsoName = $_POST["rsoName"]; // set namne
}

// Returns true if the user has access to this page (is the superadmin of the university)
function verify_access($rsoName) {
    if (empty($_SESSION["userType"])) 
        return false;

    // TODO: verify access

    return true;
}

// Verify that the user has access to this page
if (!verify_access($rsoName))
    goto_default_page();

// During a submission ...
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check name 
    if (empty($_POST["newName"])) {
        $error = "Name is required";
    } else {
        $newName = test_input($_POST["newName"]);
    }

    $desc = htmlspecialchars($_POST["desc"]);

    // On success go to the next page
    if ($error == "") {
        rso_edit_submit($rsoName, $newName, $desc);
        if ($error == "") {
            goto_page($success_page);
        }
    }
} 

rso_edit_fill($rsoName);

function rso_edit_submit($rsoNameOld, $rsoNameNew, $desc) {
    if ($rsoNameOld == "") { // create
        // TODO: create uni
    } else {
        // TODO: edit uni
    } // edit
}

function rso_edit_fill($rsoName) {
    global $name_value, $studCount_value, $desc_value;
    if ($rsoName == "")
        return;
    // TODO: retreive name
    $name_value = $rsoName;
    $studCount_value = "42"; // TODO: get student count
    $desc_value = "Wow. You are editing this RSO! You're a really cool guy! :)";
}
?>