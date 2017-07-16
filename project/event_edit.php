<!-- 
    event_edit.php

    This will be used as the page to edit an event
-->
<?php
    // If there is a successful registration, it will then jump to this page:
    $success_page = "my_event_list.php?edit=success"; 
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/event_edit.php");
?>
<html>
<body>

<a href="index.php">Home</a>
<br>
<b> Edit Event </b>

<!-- Registration form (Submit to backend in php/register.php"-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Event Name: <input type="text" name="name" value="<?php echo $name_value?>"><br>
Date: <input type="text" name="date" value="<?php echo $date_value?>"><br>
Start time: <input type="text" name="start_time" value="<?php echo $start_time_value?>"><br>
End time: <input type="text" name="end_time" value="<?php echo $end_time_value?>"><br>
Category: <input type="text" name="event_category" value="<?php echo $event_category_value?>"><br>
Description: <textarea name="desc" rows="5" cols="40"><?php echo $desc_value?></textarea><br>
Topic: <textarea name="topic" rows="5" cols="40"><?php echo $topic_value?></textarea><br>
Contact Email: <input type="text" name="contact_email" value="<?php echo $contact_email_value?>"><br>
Contact Phone: <input type="text" name="contact_phone" value="<?php echo $contact_phone_value?>"><br>
Published: <?php echo $published_value?>
<input type="hidden" name="eid" value="<?php echo $eid?>">
<input type="submit" name="submit" value="Submit"> 
</form>

<!-- This displays any error when registering -->
<span><?php echo $error?></span>

</body>
</html>