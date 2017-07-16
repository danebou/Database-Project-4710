<!-- 
    all_universities.php

    This will be used to list all the universities publically
-->
<?php
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/all_universities.php");
?>
<html>
<body>

<a href="index.php">Home</a>
<br>
<b> Universities </b>
<br>
These all universiteies
<br>
<br>
Now check out these universities that will help you lose weight fast, you can go to:
<br>

<!-- Displays available universities --> 
<?php echo $university_list?>

</body>
</html>