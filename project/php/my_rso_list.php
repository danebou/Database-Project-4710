<?php
/*
    my_rso_list.php

    Has functions that provide access to the list of rsos
*/ 
// Include common functions
require_once("common.php");

session_start();

$edit = "";

// Redirect if the user is not a user
if (empty($_SESSION["userType"])) 
    goto_default_page();

// List of rso and edit/delete buttons for current rso
$rso_list = get_rso_list();

/* 
    Returns user's universities as rsos
*/
function find_my_rsos() {
    // TODO: get actual rsos
    return array(urlencode("Fight Club"), urlencode("Breakfast Club"));
}

function is_owner_of_rso($rsoName) {
    if ($_SESSION["userType"] != "admin")
        return false;
    
    // TODO: determine if admin of page
    return ($rsoName == urlencode("Fight Club"));
}

// Gets a table of unversities links for the current rso
function get_rso_list() {
    $list = '<table>';
    foreach (find_my_rsos() as $rsoName) {
        $list = $list."<tr>"; // Row start     
        $list = $list.'<td><a href=rso_view.php?rsoName='.$rsoName.'>'.urldecode($rsoName).'</a></td>';
        if (is_owner_of_rso($rsoName)) {
            $list = $list.'<td><a href=rso_edit.php?rsoName='.$rsoName.'>Edit</a></td>';
            $list = $list."<td>".create_delete_button($rsoName)."</td>"; // Delete button
        }
        $list = $list."<tr>"; // Row end
    }
    $list = $list."</table>"; // close list
    return $list;
}

// Creates a button that will delete a university
function create_delete_button($rsoName) {
    return '<form method="POST"> 
<input type=SUBMIT action="<?php delete_rso('.$rsoName.') ?>"
value="delete"> 
</form>';
}

// Deletes a rso with a given name
function delete_rso($rsoName) {
    // TODO delete rso
    refresh();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($_GET["edit"]) && $_GET["edit"] == "success")
        $edit = "Successfully edited!";
}

?>