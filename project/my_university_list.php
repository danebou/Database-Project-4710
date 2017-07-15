<!-- 
    my_university_list.php

    This will be used to list all the universities for a suepradmin
-->
<?php
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/my_university_list.php");
?>
<html>
<body>

<a href="index.php">Home</a>
<br>
<b> My Universities </b>
<br>
These are your universities you created
<br>
<br>
Now checkout out these dope universities you can go to:
<br>

<!-- Displays available universities --> 
<?php echo get_university_list()?>

<br>

<a href="university_edit.php">Create New</a>

</body>
</html>