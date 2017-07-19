<?php
/*
    university_view.php

    Has functions that retrieves data for a universtiy
*/ 
// Include common functions
require_once("common.php");
require_once("database.php");

session_start();

// default
$uni_name = "";
$uni_desc = "";
$uni_student_count = "";
$uni_pics = "";
$uni_event_list = "";

$loc_desc = "";
$loc_lat = 0.0;
$loc_long = 0.0;


$error = "";

function verify_member() {
    if (empty($_SESSION["userType"])) 
        return false;
    // TODO verify user is a member of 
    return true;
}

function get_rso_events($uid) {
    global $error;

    if (!verify_member()) // Only members can see events
        return array();

        global $error;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return array();
    }

    $sql = "SELECT eid, name
            FROM event E, uni
            WHERE E.uid='".$_SESSION["userId"]."'
            AND S.rsoName = R.rsoName";
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

function set_university($uid) {
    global $error;
    global $uni_name, $uni_desc, $uni_student_count, $uni_pics, $uni_event_list,
    $loc_desc, $loc_long, $loc_lat;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return false;
    }

    $sql = "SELECT numOfStudents, name, description, pictures, lid
            FROM university U
            WHERE U.uid ='".$uid."'";
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
    $row = $result->fetch_row();

    $uni_name = $row[1];
    $uni_desc = $row[2];
    $uni_student_count = $row[0];
    $lid = $row[4];

    $sql = "SELECT description, latitude, longitude
            FROM location L
            WHERE L.lid = '".$lid."'";
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }
    $row = $result->fetch_row();
    $conn->close();

    // TODO: retreive name
    $loc_desc=$row[0];
    $loc_long=floatval($row[2]);
    $loc_lat=floatval($row[1]);
    $picsValue = "test4.jpg";

    $uni_pics = create_pictures_list($picsValue);
    $uni_event_list = create_event_list(get_rso_events($uid));
}

// create a html list of pictures given comma separated pic file nmaes
function create_pictures_list($picsValue) {
    global $uni_pics_dir; 
    $list = "<ul>"; // Start list
    $pics_list = explode(",", $picsValue);
    foreach ($pics_list as $pic) {
        $list = $list."<li>".create_picture($uni_pics_dir.$pic)."</li>";
    }

    $list = $list."</ul>";
    return $list;
}

// create a html picture with a given resource
function create_picture($resourceId) {
    return '<img src="'.$resourceId.'" />';
}

// create a html list of pictures given comma separated pic file nmaes
function create_event_list($events) {
    $list = "<ul>"; // Start list
    foreach ($events as $row) {
        $eid = $row["eid"];
        $eName = $row["name"];
        $list = $list."<li>".create_event($eid, $eName)."</li>";
    }

    $list = $list."</ul>";
    return $list;
}

// create a html picture with a given resource
function create_event($eid, $eName) {
    return '<a href=event_view.php?eid='.$eid.'>'.$eName.'</a>';
}

// Set university values
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($_GET["uid"])) {
       set_university($_GET["uid"]);
    }
}
?>