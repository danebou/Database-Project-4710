<?php
/*
    my_university_list.php

    Has functions that provide access to the list of universities for a current superadmin
*/ 
// Include common functions
require_once("common.php");

session_start();

// Redirect if the user is not a logged in
if (empty($_SESSION["userType"])) 
    goto_default_page();

// List of universities and edit/delete buttons for current superadmin
$university_list = get_university_list();

/* 
    Returns user's universities as uids
*/
function find_my_universities() {
    // TODO: get all  universiteis
    return array("1", "2", "3");
}

// Gets a table of unversities links for the current superadmin
function get_university_list() {
    $list = '<table>';
    foreach (find_my_universities() as $uid) {
        $list = $list."<tr>"; // Row start      
        $list = $list.'<td><a href=university_view.php?uid='.$uid.'>'.get_university_name($uid).'</a></td>';
        $list = $list."<tr>"; // Row end
    }
    $list = $list."</table>"; // close list
    return $list;
}

// Retreives the universty name with a given uid
function get_university_name($uid) {
    return "University".$uid;
}
?>