<!-- 
    Register.php

    This will be used as the main page to register.
    Once the submit button is hit, if there is an error, a refresh occurs and displays 
    the error at the bottom. If there is no error, it will automatically jump to the
    given success page.
-->
<?php
    // If there is a successful registration, it will then jump to this page:
    $success_page = "my_university_list.php?edit=success"; 
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/university_edit.php");
?>
<html>
<body>

<a href="index.php">Home</a>
<br>
<b> Edit University </b>

<!-- Registration form (Submit to backend in php/register.php"-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
University Name: <input type="text" name="name" value="<?php echo $name_value?>">
<br>
Number of Students: <input type="text" name="studCount" value="<?php echo $studCount_value?>">
<br>
Description: <textarea name="desc" rows="5" cols="40"><?php echo $desc_value?></textarea>
<br>
<input type="hidden" name="uid" value="<?php echo $uid?>">
<input type="submit" name="submit" value="Submit"> 
</form>

<!-- This displays any error when registering -->
<span><?php echo $error?></span>

</body>
</html>