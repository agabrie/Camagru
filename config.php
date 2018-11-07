<?php
    require("install.php");
    global $db;
    $db = new Db(array("servername"     =>"localhost",
                        "username"		=>"root",
                        "password"		=>"R00t",
                        "dbname"		=>"CAMAGRU"
                      ));
    $db->createTABLE(array(	"name"		=>"USERS",
                            "columns"	=>array("username VARCHAR(20) not NULL PRIMARY KEY",
                                                "fname VARCHAR(20) default 'Mohammed'",
                                                "lname VARCHAR(20) default 'LastNams'",
                                                "email VARCHAR(40) not NULL",
                                                "`password` VARCHAR(255) not NULL",
                                                "verified TINYINT(1) NOT NULL DEFAULT '0'",
                                                "gallery INT(11) NOT NULL default '0'",
                                                "online TINYINT(1) NOT NULL DEFAULT '0'"
                                                )
                        ));
    
    function stringify($string)
    {
        return "'".$string."'";
    }
    //$db->closeConnnections();
    
?>