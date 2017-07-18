<?php
/*
    my_rso_list.php

    Has functions that provide access to the list of rsos
*/ 
// Include common functions
require_once("common.php");
require_once('database.php');

session_start();

$edit = "";

$error = "";

// Redirect if the user is not a user
if (empty($_SESSION["userType"])) 
    goto_default_page();

// List of rso and edit/delete buttons for current rso
$rso_list = get_rso_list();

/* 
    Returns user's universities as rsos
*/
function find_my_rsos() {
    global $error;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return array();
    }

    $sql = "SELECT DISTINCT R.rsoName, R.adminid 
            FROM rso R
            WHERE R.adminid='".$_SESSION["userId"]."'
            OR EXISTS(SELECT * 
            FROM stud_joins S
            WHERE S.rsoName = R.rsoName
            AND S.userid='".$_SESSION["userId"]."')";
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

function is_owner_of_rso($rsoName, $rsoAdmin) {
    if ($_SESSION["userType"] != "admin")
        return false;

    return ($rsoAdmin == $_SESSION["userId"]);
}

// Gets a table of unversities links for the current rso
function get_rso_list() {
    $list = '<table>';
    foreach (find_my_rsos() as $row) {
        $rsoName = $row["rsoName"];
        $rsoAdmin = $row["adminid"];
        $list = $list."<tr>"; // Row start     
        $list = $list.'<td><a href=rso_view.php?rsoName='.$rsoName.'>'.urldecode($rsoName).'</a></td>';
        if (is_owner_of_rso($rsoName, $rsoAdmin)) {
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