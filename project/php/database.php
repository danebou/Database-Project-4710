<?php
/*
    database.php
    
    used to interface with the database
*/
$db_host = "localhost";
$db_name = "collegeevent";
$db_user = "root";
$db_password = "";

function connect_to_db() {
    global $db_host, $db_name, $db_user, $db_password;
    return mysqli_connect($db_host, $db_user, $db_password, $db_name);
}

?>