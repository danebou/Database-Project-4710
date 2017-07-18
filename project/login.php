<!-- 
    Login.php

    This will be used as the main page to login
    Once the submit button is hit, if there is an error, a refresh occurs and displays 
    the error at the bottom. If there is no error, it will automatically got to the appropriate next page
-->
<?php
    // If there is a successful login, it will then jump to this page:
    $login_success_page = "index.php"; 
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/login.php");
?>
<html>
<body>

<b> Login </b>

<!-- This displays a successful registration -->
<span><?php echo $registration?></span>

<!-- Login form (Submit to backend in php/login.php"-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Username: <input type="text" name="userId">
Password: <input type="password" name="password">
<input type="submit" name="submit" value="Submit"> 
</form>

<!-- This displays any error when logging in -->
<span><?php echo $error?></span> <br>

<!-- Registration link -->
New User? <a href="register.php">Register</a>


</body>
</html>