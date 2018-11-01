<?php
    session_start();
    //echo "something";
    //print_r($_SESSION);
    if($_SESSION["username"] != NULL)
        echo $_SESSION["username"]." has loginned!".PHP_EOL;
?>