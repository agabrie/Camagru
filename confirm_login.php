<?php
/****************** Start session ******************/
    session_start();
    // print_r($_SESSION);
    
/***************** Redirect to edit **************/
    header("Location: edit.php");
?>