<?php
/****************** Start session ******************/
    session_start();
    // print_r($_SESSION);
    if($_GET["username"])
        $_SESSION["username"] = $_GET["username"];
/***************** Redirect to edit **************/
    header("Location: edit.php");
?>