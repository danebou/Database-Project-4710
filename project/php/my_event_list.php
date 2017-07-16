<?php
/*
    my_event_list.php

    Has functions that provide access to the list of events created by the user
*/ 
// Include common functions
require_once("common.php");

session_start();

$edit = "";

// Redirect if the user if that are not loggedin
if (empty($_SESSION["userType"]) ) 
    goto_default_page();

// List of universities and edit/delete buttons for current superadmin
$event_list = get_event_list();

/* 
    Returns user's universities as uids
*/
function find_my_events() {
    // TODO: get actual universiteis
    return array("1", "2", "3");
}

// Gets a table of unversities links for the current superadmin
function get_event_list() {
    $list = '<table>';
    foreach (find_my_events() as $eid) {
        $list = $list."<tr>"; // Row start      
        $list = $list.'<td><a href=event_view.php?eid='.$eid.'>'.get_event_name($eid).'</a></td>';
        $list = $list.'<td><a href=event_edit.php?eid='.$eid.'>Edit</a></td>';
        $list = $list."<td>".create_delete_button($eid)."</td>"; // Delete button
        $list = $list."<tr>"; // Row end
    }
    $list = $list."</table>"; // close list
    return $list;
}

// Retreives the universty name with a given uid
function get_event_name($eid) {
    return "Event".$eid;
}

// Creates a button that will delete a university
function create_delete_button($eid) {
    return '<form method="POST"> 
<input type=SUBMIT action="<?php delete_event('.$eid.') ?>"
value="delete"> 
</form>';
}

// Deletes a university with a given uid
function delete_event($eid) {
    // TODO delete university
    refresh();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($_GET["edit"]) && $_GET["edit"] == "success")
        $edit = "Successfully edited!";
}

?>