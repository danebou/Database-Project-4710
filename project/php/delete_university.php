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

if (!empty($_GET["uid"])) {
    $uid = $_GET["uid"]; // set uid
    delete_uni($uid);
    goto_page("my_university_list.php");
}