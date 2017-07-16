<?php
/*
    rso_requests.php

    Has functions that provide aprroving/disapproving rso requests
*/ 
// Include common functions
require_once("common.php");

session_start();

// Redirect if the user is not a superadmin
if (empty($_SESSION["userType"]) || $_SESSION["userType"] != "admin") 
    goto_default_page();

// List of universities and edit/delete buttons for current superadmin
$rso_requests = get_rsorequests_list();

/* 
    Returns all current event requests
*/
function find_current_requests() {
    // TODO: get actual requests (userIds)
    return array(array("Jan Michael Vicent", "Quadrant 7"), 
    array("Pickle Rick", "Club Sandwich"),
    array("Mr. Poopybutthole", "recovery"));
}

// Gets a table of request links for the current superadmin
function get_rsorequests_list() {
    $list = '<table>';
    foreach (find_current_requests() as $request) {
        $userId = $request[0];
        $rsoName = $request[1];
        $list = $list."<tr>"; // Row start      
        $list = $list.'<td>'.$userId.'wishes to join'.$rsoName.'</td>';
        $list = $list."<td>".create_approve_button($userId, $rsoName)."</td>"; // Approve button
        $list = $list."<td>".create_delete_button($userId, $rsoName)."</td>"; // Delete button
        $list = $list."<tr>"; // Row end
    }
    $list = $list."</table>"; // close list
    return $list;
}

// Creates a button that will delete a university
function create_delete_button($eid) {
    return '<form method="POST"> 
<input type=SUBMIT action="<?php delete_request('.$eid.') ?>"
value="delete"> 
</form>';
}

function create_approve_button($eid) {
    return '<form method="POST"> 
<input type=SUBMIT action="<?php approve_request('.$eid.') ?>"
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