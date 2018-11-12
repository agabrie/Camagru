<?php
/****************** Start session ******************/
    session_start();
    // print_r($_SESSION);
    
/***************** Redirect to index **************/
    header("Location: index.php");
?>