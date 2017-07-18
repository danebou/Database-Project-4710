<?php
/*
    This function will register a new user on the server.
    If the registeration is successful, it will goto a 
    specified page

    Args:
        POST:
            "userId": the user id
            "email": the email address
            "password": the password
        Variables ($):
            "$register_success_page: the page to go to if the registraton is successful

    Returns:
        $error: an error message that occurs during the process. "" if no error
*/

// Include common functions
require_once("common.php");
require_once("database.php");

/*
$servername = "localhost";
$username = "student";
$password = "";
$dbname = "test";*/
$error = "";

/*
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

echo "Connected successfully\n";

$sql = "INSERT INTO test_table 
VALUES ('John', 'Doe', 'john@example.com', 'testiong12')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();*/

function register_user($userId, $password, $email) {
    global $error;
    // make sure formats are correct
    if (test_input($userId) != $userId) {
        $error = "Invalid username";
        return false;
    }
    if (test_input($password) != $password) {
        $error = "Invalid password";
        return false;
    }

    $conn = connect_to_db();
    if ($conn->connect_error) {
        $error = ("Connection failed: " . $conn->connect_error);
        $conn->close();
        return false;
    }

    $sql = "INSERT INTO user (name, uniemail, userType, uid, password)
    VALUES ('".$userId."', '".$email."', 'student', NULL, '".$password."')";

    if (!$conn->query($sql)) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        return false;
    }

    $conn->close();

    // TODO: register a user
    return true;
}

// During a submission ...
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check Password 
    if (empty($_POST["password"])) {
        $error = "Password is required";
    }

    // Check Email 
    if (empty($_POST["email"])) {
        $error = "Email is required";
    }

    // Check UserId 
    if (empty($_POST["userId"])) {
        $error = "User Id is required";
    }

    // On success go to the next page
    if ($error == "") {
        if (register_user($_POST["userId"], $_POST["password"], $_POST["email"]))
            goto_page($register_success_page);
    }
} 
?>