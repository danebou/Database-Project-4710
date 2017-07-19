<?php
/*
    my_university_list.php

    Has functions that provide access to the list of universities for a current superadmin
*/ 
// Include common functions
require_once("common.php");
require_once('database.php');

session_start();

$edit = "";

// Redirect if the user is not a superadmin
if (empty($_SESSION["userType"]) || $_SESSION["userType"] != "superadmin") 
    goto_default_page();

// List of universities and edit/delete buttons for current superadmin
$university_list = get_university_list();

/* 
    Returns user's universities as uids
*/
function find_my_universities() {
    global $error;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return array();
    }

    $sql = "SELECT uid, name
            FROM university U
            WHERE U.createProfileBy='".$_SESSION["userId"]."'";
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return array();
    }
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    $conn->close();

    return $rows;
}

// Gets a table of unversities links for the current superadmin
function get_university_list() {
    $list = '<table>';
    foreach (find_my_universities() as $row) {
        $uid = $row["uid"];
        $name = $row["name"];
        $list = $list."<tr>"; // Row start      
        $list = $list.'<td><a href=university_view.php?uid='.$uid.'>'.$name.'</a></td>';
        $list = $list.'<td><a href=university_edit.php?uid='.$uid.'>Edit</a></td>';
        $list = $list.'<td><a href=delete_university.php?uid='.$uid.'>Delete</a></td>'; // Delete button
        $list = $list."<tr>"; // Row end
    }
    $list = $list."</table>"; // close list
    return $list;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($_GET["edit"]) && $_GET["edit"] == "success")
        $edit = "Successfully edited!";
}

?>