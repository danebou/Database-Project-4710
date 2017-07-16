<?php
/*
    my_university_list.php

    Has functions that provide access to the list of universities for a current superadmin
*/ 
// Include common functions
require_once("common.php");

session_start();

$edit = "";

// Redirect if the user is not a superadmin
if (empty($_SESSION["userType"])) 
    goto_default_page();

// List of universities and edit/delete buttons for current superadmin
$university_list = get_university_list();

/* 
    Returns user's universities as uids
*/
function find_my_universities() {
    // TODO: get actual universiteis
    return array("1", "2", "3");
}

// Gets a table of unversities links for the current superadmin
function get_university_list() {
    $list = '<table>';
    foreach (find_my_universities() as $uid) {
        $list = $list."<tr>"; // Row start      
        $list = $list.'<td><a href=university_view.php?uid='.$uid.'>'.get_university_name($uid).'</a></td>';
        $list = $list.'<td><a href=university_edit.php?uid='.$uid.'>Edit</a></td>';
        $list = $list."<td>".create_delete_button($uid)."</td>"; // Delete button
        $list = $list."<tr>"; // Row end
    }
    $list = $list."</table>"; // close list
    return $list;
}

// Retreives the universty name with a given uid
function get_university_name($uid) {
    return "University".$uid;
}

// Creates a button that will delete a university
function create_delete_button($uid) {
    return '<form method="POST"> 
<input type=SUBMIT action="<?php delete_university('.$uid.') ?>"
value="delete"> 
</form>';
}

// Deletes a university with a given uid
function delete_university($uid) {
    // TODO delete university
    refresh();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($_GET["edit"]) && $_GET["edit"] == "success")
        $edit = "Successfully edited!";
}

?>