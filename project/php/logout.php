<?php
/*
    Logout.php

    Logs the current user out 
*/
    session_start();

    // remove all session variables
    session_unset(); 

    // destroy the session 
    session_destroy(); 
?>