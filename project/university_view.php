<!-- 
    university_view.php

    This will be used as the page to publically view a university
-->
<?php
    $uni_pics_dir = "img/"; // The directory where the pics are stored for the university
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

<?php echo $uni_pics ?>
<br>
<?php echo $uni_event_list?>

<!-- This displays any error when registering -->
<span><?php echo $error?></span>

</body>
</html>