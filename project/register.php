<!-- 
    Register.php

    This will be used as the main page to register.
    Once the submit button is hit, if there is an error, a refresh occurs and displays 
    the error at the bottom. If there is no error, it will automatically jump to the
    given success page.
-->
<?php
    // If there is a successful registration, it will then jump to this page:
    $register_success_page = "login.php?registration=success"; 
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/register.php");
?>
<html>
<body>

<b> Register </b>

<!-- Registration form (Submit to backend in php/register.php"-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Username: <input type="text" name="userId">
E-mail: <input type="text" name="email">
Password: <input type="text" name="password">
<input type="submit" name="submit" value="Submit"> 
</form>

<!-- This displays any error when registering -->
<span><?php echo $error?></span>

</body>
</html>