<?php
/****************** Start session ******************/
    session_start();
    if($_GET["username"])
        $_SESSION["username"] = $_GET["username"];
/***************** Redirect to edit **************/
    header("Location: edit.php");
?>