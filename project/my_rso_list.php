<!-- 
    my_rso_list.php

    This will be used to list all the rsos for an admin
-->
<?php
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/my_rso_list.php");
?>
<html>
<body>

<a href="index.php">Home</a>
<br>
<b> My RSOs </b>
<br>
These are your rsos you are admin of
<br>
<br>
Now check out these radical RSOS you are apart of:
<br>

<!-- Displays available Rsos --> 
<?php echo $rso_list?>

<br>

<a href="rso_edit.php">Create New</a>

<br>
<?php echo $edit?>

</body>
</html>