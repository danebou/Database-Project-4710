<?php
/*
    event_requests.php

    Has functions that provide approving/removing non-RSO events
*/ 
// Include common functions
require_once("common.php");
require_once("database.php");

session_start();

$status = "";
$searchName = "";
$error = "";

//Function to hide the big admin link cards
function hide_admin_links() {
	
	if ($_SESSION["userType"] == "admin") {
		$style = 'style="display:visible"';
	}
	else {
		$style = 'style="display:none"';
	}
	return $style;
}

//Function to hide the big super admin link cards
function hide_superadmin_links() {
	
	if ($_SESSION["userType"] == "superadmin") {
		$style = 'style="display:visible"';
	}
	else {
		$style = 'style="display:none"';
	}
	return $style;
}

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
    $links = $links.'<li class="nav-item active"><a class="nav-link" href="search_join_rso.php"><i class="fa fa-fw fa-search"></i> Search/Join RSO</a> </li>';
    if ($_SESSION["userType"] == "admin") {
        $links = $links.'<li class="nav-item"><a class="nav-link" href="rso_requests.php"><i class="fa fa-fw fa-user-plus"></i> RSO Join Requests</a> </li>';
    }
    if ($_SESSION["userType"] == "superadmin") {
        $links = $links.'<li class="nav-item"><a class="nav-link" href="my_university_list.php"><i class="fa fa-fw fa-sitemap"></i> My Universities</a> </li>';
        $links = $links.'<li class="nav-item"><a class="nav-link" href="event_requests.php"><i class="fa fa-fw fa-plus-square"></i> Non-RSO Event Requests</a> </li>';
    }
    $links = $links.'</ul>'; // close list
    return $links;
}

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
    global $error;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return array();
    }

    $sql = "SELECT rsoName
            FROM rso R
            WHERE rsoName LIKE '%".$searchName."%'";
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return array();
    }
    $rows = array();
    while ($row = $result->fetch_row()) {
        $rows[] = $row[0];
    }
    $conn->close();

    return $rows;
}

// Gets a table of searched for RSO
function get_rso_list($searchName) {
    if ($searchName == "")
        return "";

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
    global $error;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return;
    }

    $sql = sprintf("SELECT count(*) 
    FROM stud_requests as R
    WHERE R.rsoName = '%s' AND R.userid='%s'",
    $rsoName, $_SESSION["userId"]);

    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return;
    }

    if (($result->fetch_row())[0] > 0) {
        $conn->close();
        $status = "Already requested";
        return;
    }

    $sql = sprintf("SELECT count(*) 
    FROM stud_joins as J
    WHERE J.rsoName = '%s' AND J.userid='%s'",
    $rsoName, $_SESSION["userId"]);

    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return;
    }

    if (($result->fetch_row())[0] > 0) {
        $conn->close();
        $status = "Already requested";
        return;
    }

    $sql = "INSERT INTO stud_requests (rsoName, userid)
    VALUES ( '".$rsoName."', '".$_SESSION["userId"]."')";
    $status = $sql;
    if (!$conn->query($sql)) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return;
    }

    $conn->close();

    // TODO create join request
    $status = "Requested to join ".$rsoName;
}

?>