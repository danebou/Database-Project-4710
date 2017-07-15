<!-- 
    Index.php

    This will be used as the main page  and will display available links
-->
<?php
    // Page to goto if the user is not logged in
    $not_loggedin_page = "login.php";
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/index.php");
?>
<html>
<body>

<b> Main </b>
<br>
This is the main page. You are a <?php echo $_SESSION["userType"]?>
<br>
<br>
Now checkout out these sick links you can go to:
<br>

<!-- Displays available links --> 
<?php echo get_accessable_page_links()?>

<br>
</body>
</html>