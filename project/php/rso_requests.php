<?php
/*
    rso_requests.php

    Has functions that provide aprroving/disapproving rso requests
*/ 
// Include common functions
require_once("common.php");

session_start();

/*
    Gets a table of available pages to goto
*/
function get_accessable_page_links() {
	// TODO: ad more links
    $links = '<ul class="sidebar-nav navbar-nav">'; // start list
    $links = $links.'<li class="nav-item"><a class="nav-link" href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> </li>';
    $links = $links.'<li class="nav-item"><a class="nav-link" href="my_rso_list.php"><i class="fa fa-fw fa-address-book"></i> My RSOs</a> </li>';
    $links = $links.'<li class="nav-item"><a class="nav-link" href="all_universities.php"><i class="fa fa-fw fa-institution"></i> Universities</a> </li>';
    $links = $links.'<li class="nav-item"><a class="nav-link" href="my_event_list.php"><i class="fa fa-fw fa-calendar-o"></i> My Events</a> </li>';
    $links = $links.'<li class="nav-item"><a class="nav-link" href="search_join_rso.php"><i class="fa fa-fw fa-search"></i> Search/Join RSO</a> </li>';
    if ($_SESSION["userType"] == "admin") {
        $links = $links.'<li class="nav-item active"><a class="nav-link" href="rso_requests.php"><i class="fa fa-fw fa-area-chart"></i> RSO Join Requests</a> </li>';
    }
    if ($_SESSION["userType"] == "superadmin") {
        $links = $links.'<li class="nav-item"><a class="nav-link" href="my_university_list.php"><i class="fa fa-fw fa-sitemap"></i> My Universities</a> </li>';
        $links = $links.'<li class="nav-item"><a class="nav-link" href="event_requests.php"><i class="fa fa-fw fa-plus-square"></i> Non-RSO Event Requests</a> </li>';
    }
    $links = $links.'</ul>'; // close list
    return $links;
}

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