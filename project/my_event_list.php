<!-- 
    my_university_list.php

    This will be used to list all the universities for a suepradmin
-->
<?php
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/my_event_list.php");
?>
<html>
<body>

<a href="index.php">Home</a>
<br>
<b> My Events </b>
<br>
These are your events you created
<br>
<br>
Trainers hate these events you can go to:
<br>

<!-- Displays available universities --> 
<?php echo $event_list?>

<br>

<a href="event_edit.php">Create New</a>

<br>
<?php echo $edit ?>

</body>
</html>