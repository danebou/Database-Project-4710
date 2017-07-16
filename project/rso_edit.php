<!-- 
    rso_edit.php

    This will be used as the page to edit an rso
-->
<?php
    // If there is a successful registration, it will then jump to this page:
    $success_page = "my_rso_list.php?edit=success"; 
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/rso_edit.php");
?>
<html>
<body>

<a href="index.php">Home</a>
<br>
<b> Edit RSO </b>

<!-- Registration form (Submit to backend in php/register.php"-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
RSO Name: <input type="text" name="newName" value="<?php echo $name_value?>">
<br>
Number of Students: <?php echo $studCount_value?> <!-- Cannot be edited -->
<br>
Description: <textarea name="desc" rows="5" cols="40"><?php echo $desc_value?></textarea>
<br>
<input type="hidden" name="rsoName" value="<?php echo $rsoName?>">
<input type="submit" name="submit" value="Submit"> 
</form>

<!-- This displays any error when registering -->
<span><?php echo $error?></span>

</body>
</html>