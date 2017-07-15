<?php
// Include common functions
require_once("common.php");

session_start();

$error = "";
$registration = "";

function login($userId, $password) {
    $_SESSION["userType"] = $userId;
    $_SESSION["userId"] = $userId;
    return true;
}

// During a submission ...
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check Password 
    if (empty($_POST["password"])) {
        $error = "Password is required";
    } else {
        $userid = test_input($_POST["password"]);
    }

    // Check UserId 
    if (empty($_POST["userId"])) {
        $error = "User Id is required";
    } else {
        $userid = test_input($_POST["userId"]);
    }

    // On success go to the next page
    if ($error == "") {
        if (login($_POST["userId"], $_POST["password"])) {
            goto_page($login_success_page);
        }
    }
} 
// During a redirect to this page
else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($_GET["registration"]) && $_GET["registration"] == "success")
        $registration = "Successfully registered!";
}
?>