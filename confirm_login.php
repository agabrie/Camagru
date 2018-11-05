<?php
    session_start();
    include_once("index.php");

    if($_SESSION["username"] != NULL)
        echo $_SESSION["username"]." has loginned!".PHP_EOL;
    $db->insertRecord(array(    "table"     =>array("name"=>"USERS",
                                "columns"   =>array("username","fname","lname","email","password","verified", "gallery")
                                                ),
                                "values"    =>array("\"".$_SESSION["username"]."\"","\"".$_SESSION["fname"]."\"","\"".$_SESSION["lname"]."\"","\"".$_SESSION["email"]."\"","\"".$_SESSION["passwrd"]."\"", '1', '1')
                            ));
    // header("Location: index.php");
?>