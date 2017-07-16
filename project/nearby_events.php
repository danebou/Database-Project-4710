<!-- 
    nearby_events.php

    This will be used to see a list of nearby events
-->
<?php
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/nearby_events.php");
?>
<html>
<body>

<a href="index.php">Home</a>
<br>
<b> Nearby Events </b>
<br>
Now check out these event that doctors don't want you to know about!:
<br>

<!-- Displays nearby events --> 
<?php echo $nearby_events?>

<br>

</body>
</html>