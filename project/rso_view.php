<!-- 
    rso_view.php

    This will be used as the page to view an rso
-->
<?php
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/rso_view.php");
?>
<html>
<body>

<a href="index.php">Home</a>
<br>
<b> <?php echo $rso_name?> </b>
<br>
<p> <?php echo $rso_desc?> </p>
<br>
Students: <?php echo $rso_student_count?> 
<br>

<?php echo $rso_event_list ?>

</body>
</html>