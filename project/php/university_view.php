<?php
/*
    university_view.php

    Has functions that retrieves data for a universtiy
*/ 
// Include common functions
require_once("common.php");

// default
$uni_name = "";
$uni_desc = "";
$uni_student_count = "";
$uni_pics = "";

function set_university($uid) {
    $picsValue = "test1.png,test2.png,test3.png";
    global $uni_name, $uni_desc, $uni_student_count, $uni_pics;
    $uni_name = "University ".$uid;
    $uni_desc = "This is a todo-er. But this university likes to party!";
    $uni_student_count = "42 (Wow! That's a lot of students!";
    $uni_pics = create_pictures_list($picsValue);
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

// Set university values
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($_GET["uid"])) {
       set_university($_GET["uid"]);
    }
}
?>