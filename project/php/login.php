<?php
// Include common functions
require_once("common.php");
require_once("database.php");

session_start();

$error = "";
$registration = "";

function login($userId, $password) {
    global $error;

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return false;
    }

    $sql = "SELECT userType, userid, password, uniemail FROM user as U WHERE U.name = '".$userId."'";
    $result = $conn->query($sql);
    if (!$result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }

    if ($result->num_rows > 0)
        $row = $result->fetch_assoc();

    // Check pwword
    if ($result->num_rows == 0 || $row["password"] != $password)
    {
        $error = "Username or password are incorrect!";
        $conn->close();
        return false;
    }

    $_SESSION["userType"] = $row["userType"];
    $_SESSION["userName"] = $userId;
    $_SESSION["userId"] = $row["userid"];
    $email = $row["uniemail"];


    $userDomain = substr($email, strrpos($email, '@') + 1);
    $sql = "SELECT uid
            FROM university U
            WHERE U.domain='".$userDomain."'";
    $user_uid_result = $conn->query($sql);
    if (!$user_uid_result) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return "";
    }
    if ($user_uid_result->num_rows == 0)
        $user_uid = "basd";
    else
        $user_uid = $user_uid_result->fetch_row()[0];

    $_SESSION["userUni"] = $user_uid;

    $conn->close();

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