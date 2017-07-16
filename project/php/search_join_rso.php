<?php
/*
    event_requests.php

    Has functions that provide approving/removing non-RSO events
*/ 
// Include common functions
require_once("common.php");

session_start();

$status = "";
$searchName = "";

// Redirect if the user is not a student
if (empty($_SESSION["userType"])) 
    goto_default_page();

if (!empty($_GET["name"]))
    $searchName = $_GET["name"];

// List of universities and edit/delete buttons for current superadmin
$rso_list = get_rso_list($searchName);

/* 
    Returns all current event requests
*/
function find_current_requests($searchName) {
    // TODO: get actual requests
    return array("Plumbus club", "Jan Michael Vincents");
}

// Gets a table of searched for RSO
function get_rso_list($searchName) {
    $list = '<table>';
    foreach (find_current_requests($searchName) as $rsoName) {
        $list = $list."<tr>"; // Row start      
        $list = $list.'<td>'.$rsoName.'</td>';
        $list = $list."<td>".join_request_button($rsoName)."</td>"; // Join button
        $list = $list."<tr>"; // Row end
    }
    $list = $list."</table>"; // close list
    return $list;
}

// Creates a button that will join a request
function join_request_button($rsoName) {
    return '<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
<input type="hidden" name="rsoName" value="'.$rsoName.'">
<input type=SUBMIT
value="Request to Join"> 
</form>';
}

// During a submission ...
if ($_SERVER["REQUEST_METHOD"] == "POST") { // Request
    if (!empty($_POST["rsoName"])) {
        create_join_request($_POST["rsoName"]);
    }
} 

// approve a request with a given eid
function create_join_request($rsoName) {
    global $status;
    // TODO create join request
    $status = "Requested to join ".$rsoName;
}

?>