<!-- 
    rso_requests.php

    This will be used to list all the rso requests for an admin
-->
<?php
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/rso_requests.php");
?>
<html>
<body>

<a href="index.php">Home</a>
<br>
<b> Non-RSO Event Requests </b>
<br>
These are non-RSO events requiring approval
<br>
<br>
Now check out these groovy rso join requests you can approve/remove:
<br>

<!-- Displays available universities --> 
<?php echo $rso_requests?>

<br>

</body>
</html>