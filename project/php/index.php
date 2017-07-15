<?php
/*
    Index.php

    Has functions that provide access to 
*/ 
// Include common functions
require_once("common.php");

session_start();

// Redirect if the user is not logged in, otherwise give access to links
if (empty($_SESSION["userType"])) 
    goto_page($not_loggedin_page);

/*
    Gets a table of available pages to goto
*/
function get_accessable_page_links() {
    // TODO: ad more links
    $links = "<ul>"; // start list
    if ($_SESSION["userType"] == "admin") {
        $links = $links.'<li><a href="my_rso_list.php">My RSOs</a> </li>';
    }
    if ($_SESSION["userType"] == "superadmin") {
        $links = $links.'<li><a href="my_university_list.php">My Universitys</a> </li>';
    }
    $links = $links.'<li><a href="logout.php">Logout</a> </li>';
    $links = $links."</ul>"; // close list
    return $links;
}

?>