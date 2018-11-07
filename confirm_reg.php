<?php
	session_start();
	include_once("config.php");

	if($_SESSION["username"] != NULL)
		echo $_SESSION["username"]." has loginned!<br>";
	// echo get_class($db)."<br>";
	// print_r($db->getDBConn());
	$db->insertRecord(array("table"     =>array("name"=>"USERS",
							"columns"   =>array("username","fname","lname","email","password","verified", "gallery", "online")
												),
							"values"	=>array(stringify($_SESSION["username"]),stringify($_SESSION["fname"]),stringify($_SESSION["lname"]),stringify($_SESSION["email"]),stringify($_SESSION["passwrd"]), '0', /*$db->gallerycount()*/ '0' ,'1')
		));
	mail($_SESSION["email"]);
	header("Location: index.php");
?>