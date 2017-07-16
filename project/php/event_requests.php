<?php
/*
    event_requests.php

    Has functions that provide approving/removing non-RSO events
*/ 
// Include common functions
require_once("common.php");

session_start();

// Redirect if the user is not a superadmin
if (empty($_SESSION["userType"]) || $_SESSION["userType"] != "superadmin") 
    goto_default_page();

// List of universities and edit/delete buttons for current superadmin
$event_requests = get_eventrequests_list();

/* 
    Returns all current event requests
*/
function find_current_requests() {
    // TODO: get actual requests
    return array("4", "5", "6");
}

// Gets a table of request links for the current superadmin
function get_eventrequests_list() {
    $list = '<table>';
    foreach (find_current_requests() as $eid) {
        $list = $list."<tr>"; // Row start      
        $list = $list.'<td>'.get_request_name($eid).'</td>';
        $list = $list."<td>".create_approve_button($eid)."</td>"; // Approve button
        $list = $list."<td>".create_delete_button($eid)."</td>"; // Delete button
        $list = $list."<tr>"; // Row end
    }
    $list = $list."</table>"; // close list
    return $list;
}

// Retreives the universty name with a given uid
function get_request_name($eid) {
    return "Request".$eid;
}

// Creates a button that will delete a university
function create_delete_button($eid) {
    return '<form method="POST"> 
<input type=SUBMIT action="<?php delete_request($eid) ?>"
value="delete"> 
</form>';
}

function create_approve_button($eid) {
    return '<form method="POST"> 
<input type=SUBMIT action="<?php approve_request($eid) ?>"
value="approve"> 
</form>';
}

// Deletes a request with a given eid
function delete_request($eid) {
    // TODO delete request
    refresh();
}

// approve a request with a given eid
function approve_request($eid) {
    // TODO approve request
    refresh();
}

?>