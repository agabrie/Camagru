<?php
include_once("install.php");
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
                                                "`password` VARCHAR(100) not NULL",
                                                "verified TINYINT(1) NOT NULL DEFAULT '0'",
                                                "gallery INT(11) NOT NULL default '0'"
                                                )
                        ));
?>
<html>
	<head>
		<title>CAMAGRU</title>
		<div id="heading" class="container">
			CAMAGRU
			
			<!-- link to login/register pages -->
			<a href="register.php"><linktext style="float:right">login/register</linktext></a>
		</div>
		
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<!-- <div style="text-align: center"> -->
		<!-- <div align="center"> -->
			<div class="container" id="home">
				Welcome to<br>
				CAMAGRU<br>
				
				<br>
				<div class="container" id="main">
					Main
					<div class="container" id="side">
						Side
					</div>
				</div>
				
			</div>
		<!-- </div> -->
	</body>
	<div id="footing" class="container">
			&copy agabrie
	</div>
</html>