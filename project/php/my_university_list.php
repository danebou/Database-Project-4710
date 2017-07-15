<?php
/*
    Index.php

    Has functions that provide access to 
*/ 
// Include common functions
require_once("common.php");

session_start();

// Redirect if the user is not a superadmin
if (empty($_SESSION["userType"]) || $_SESSION["userType"] != "superadmin") 
    goto_default_page();

/* 
    Returns user's universities as uids
*/
function find_my_universities() {
    // TODO: get actual universiteis
    return array("1", "2", "3");
}

/*
    Gets a table of available pages to goto
*/
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

function get_university_name($uid) {
    return "University".$uid;
}

function create_delete_button($uid) {
    return '<form method="POST"> 
<input type=SUBMIT action="<?php delete_university($uid) ?>"
value="delete"> 
</form>';
}

function delete_university($uid) {
    // TODO delete university
    refresh();
}

?>