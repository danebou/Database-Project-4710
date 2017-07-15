<!-- 
    logout.php

    This will logout and redirect to the original page
-->
<?php
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    // (This also performs the logout)
    require_once("php/logout.php");
?>
<html>
<head>
<!-- This automaically redirects to the main page -->
<meta http-equiv="refresh" content="3; URL=index.php">
<meta name="keywords" content="automatic redirection">
</head>
<body>

Successfully logged out. Returning in a few seconds...

</body>
</html>