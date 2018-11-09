<?php
    session_start();
    print_r($_SESSION);
    header("Location: index.php");
?>