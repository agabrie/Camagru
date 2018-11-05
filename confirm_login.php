<?php
    session_start();
    include_once("config.php");

    if($_SESSION["username"] != NULL)
        echo $_SESSION["username"]." has loginned!".PHP_EOL;
        $db->insertRecord(array("table"     =>array("name"=>"USERS",
                                "columns"   =>array("username","fname","lname","email","password","verified", "gallery")
                                                    ),
                                "values"    =>array(stringify($_SESSION["username"]),stringify($_SESSION["fname"]),stringify($_SESSION["lname"]),stringify($_SESSION["email"]),stringify($_SESSION["passwrd"]), '1', '1')
        ));
    // header("Location: index.php");
?>