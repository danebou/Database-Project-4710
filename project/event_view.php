<!-- 
    event_view.php

    This will be used to view an event
-->
<?php
    // This takes all of the register functionality and moves it into this file.
    // READ the comment for this file!
    require_once("php/event_view.php");
?>
<html>
<head>
<!-- styling for the rating button !-->
<style>
    @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

    fieldset, label { margin: 0; padding: 0; }
    body{ margin: 20px; }
    h1 { font-size: 1.5em; margin: 10px; }

    /****** Style Star Rating Widget *****/

    .rating { 
    border: none;
    float: left;
    }

    .rating > input { display: none; } 
    .rating > label:before { 
    margin: 5px;
    font-size: 1.25em;
    font-family: FontAwesome;
    display: inline-block;
    content: "\f005";
    }

    .rating > .half:before { 
    content: "\f089";
    position: absolute;
    }

    .rating > label { 
    color: #ddd; 
    float: right; 
    }

    /***** CSS Magic to Highlight Stars on Hover *****/

    .rating > input:checked ~ label, /* show gold star when clicked */
    .rating:not(:checked) > label:hover, /* hover current star */
    .rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

    .rating > input:checked + label:hover, /* hover current star when changing rating */
    .rating > input:checked ~ label:hover,
    .rating > label:hover ~ input:checked ~ label, /* lighten current selection */
    .rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 
</style>
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'>
</script>
</head>
<body>
<!-- submits radio star button -->
<script type='text/javascript'>

 $(document).ready(function() { 
   $('input[name=rating]').change(function(){
        $('form').submit();
   });
  });

</script>

<a href="index.php">Home</a>
<br>

<b> <?php echo $name?> </b>
<br>
Date: <?php echo $date?>
<br>
Time: <?php echo $start_time?> - <?php echo $end_time?>
<br>
Category: <?php echo $category?>
<br>
<p> Description: <?php echo $desc?> </p>
<br>
<p> Topic: <?php echo $topic?> </p>
<br>

Contact Email: <?php echo $contact_email?>
<br>
Contact Phone: <?php echo $contact_phone?>
<br>
Published: <?php echo $published?>
<br>

<!-- Maps -->
Location:
<div>
     <iframe width="500" height="400" frameborder="0" src="https://www.bing.com/maps/embed?h=400&w=500&cp=20.418073553978985~-80.4865173441178&lvl=6&typ=d&sty=r&src=SHELL&FORM=MBEDV8" scrolling="no">
     </iframe>
</div>
<br>

Rating: 
<form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <fieldset class="rating">
        <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
        <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
        <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
        <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
        <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
        <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
        <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
        <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
        <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
        <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
    </fieldset>
</form>

<br>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Add Comment: <textarea name="desc" rows="5" cols="40"></textarea><br>
<input type="hidden" name="eid" value="<?php echo $eid?>">
<input type="submit" name="submit" value="Comment"> 
</form>

<p>Comments:<br><?php echo $comments_list ?></p>

</body>
</html>