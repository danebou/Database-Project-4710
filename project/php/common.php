<?php

$db_name = "collegeevent";
$default_page = "index.php";

/*
    common.php

    Used for common functions
*/

// Function makes input nice :)
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Go back to the default page
function goto_default_page() {
    global $default_page;
    goto_page($default_page);
}

function goto_page($page) {
    header("Location: ".$page);
    die();  
}

function refresh() {
    header("Refresh:0");
}
?>