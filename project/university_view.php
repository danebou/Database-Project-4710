<!-- 
    university_view.php

    This will be used as the page to publically view a university
-->
<?php
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/university_view.php");
?>
<html>
<body>

<a href="index.php">Home</a>
<br>
<b> <?php echo $uni_name?> </b>
<br>
<p> <?php echo $uni_desc?> </p>
<br>
Students: <?php echo $uni_student_count?> 
<br>

</body>
</html>