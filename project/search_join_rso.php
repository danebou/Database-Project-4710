<!-- 
    search_join.php

    This will be used to search for and join an rso
-->
<?php
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/search_join_rso.php");
?>
<html>
<body>

<a href="index.php">Home</a>
<br>
<b> Search and Request to join an RSO </b>
<br>
These are RSO's that can be searched for
<br>

<!-- Search form (Submit to backend in php/search_join_rso.php"-->
<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
RSO name: <input type="text" name="name">
<input type="submit" name="submit" value="Submit"> 
</form>

<br>

<br>
Now check out these spicy RSOs to join:
<br>

<!-- Displays available universities --> 
<?php echo $rso_list?>

<br>

<?php echo $status?>

</body>
</html>