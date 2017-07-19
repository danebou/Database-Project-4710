<?php
/*
    rso_requests.php

    Has functions that provide aprroving/disapproving rso requests
*/ 
// Include common functions
require_once("common.php");
require_once('database.php');

$error = "";

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
    global $error;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return array();
    }

    $sql = "SELECT S.userid, S.rsoName
            FROM stud_requests AS S, rso AS R
            WHERE R.adminid='".$_SESSION["userId"]."'
            AND S.rsoName = R.rsoName";
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return array();
    }
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $userid = $row["userid"];
        $rsoName = $row["rsoName"];
        $sql = "SELECT name
        FROM user AS U
        WHERE U.userid='".$userid."'";
        $user_name_result = $conn->query($sql);
        if (!$result) {
            $error = "Error: " . $sql . "<br>" . $conn->error;
            $conn->close();
            return array();
        }
        $rows[] = array($rsoName, $userid, ($user_name_result->fetch_row())[0]);
    }
    $conn->close();

    return $rows;
}

// Gets a table of request links for the current superadmin
function get_rsorequests_list() {
    $list = '<table>';
    foreach (find_current_requests() as $request) {
        $rsoName = $request[0];
        $userId = $request[1];
        $userName = $request[2];
        $list = $list."<tr>"; // Row start      
        $list = $list.'<td>'.$userName.' wishes to join'.$rsoName.'</td>';
        $list = $list."<td>".create_approve_button($userId, $rsoName, "approve")."</td>"; // Approve button
        $list = $list."<td>".create_approve_button($userId, $rsoName, "deny")."</td>"; // Delete button
        $list = $list."<tr>"; // Row end
    }
    $list = $list."</table>"; // close list
    return $list;
}

function create_approve_button($userId, $rsoName, $value) {
    return '<form method="POST" action="rso_request_approve.php?rsoName='.urlencode($rsoName)
.'&userid='.urlencode($userId)
.'&value='.urlencode($value)
.'" > 
<input type=SUBMIT value="'.$value.'"> 
</form>';
}
?>