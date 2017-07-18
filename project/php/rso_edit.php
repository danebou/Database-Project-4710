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
    global $error;
    if (empty($_SESSION["userType"])) 
        return false;

    // Give access to new rso
    if ($rsoName == "")
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

// Verify that the user has access to this page
if (!verify_access($rsoName))
    goto_default_page();

// During a submission ...
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check name 
    if (empty($_POST["newName"])) {
        $error = "Name is required";
    } else {
        $newName = urlencode(test_input($_POST["newName"]));
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
        rso_create($rsoNameNew, $desc);
    } else {
        // TODO: edit uni
    } // edit
}

function rso_create($name, $desc) {
    global $error;
    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return false;
    }

    // Give user admin
    $sql = "UPDATE user
            SET userType = 'admin'
            WHERE userType = 'student' and userid = '".$_SESSION["userId"]."'";
    if (!$conn->query($sql)) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
    if ($_SESSION["userType"] == 'student')
        $_SESSION["userType"] = 'admin';

    // Insert rso
    $sql = "INSERT into rso (rsoName, adminid, description, status) 
         VALUES ('".$name."', '".$_SESSION["userId"]."', '".$desc."', 'needs_members')";
    if (!$conn->query($sql)) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }

    $conn->close();
}

function rso_edit() {

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