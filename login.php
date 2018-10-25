<?php
	session_start();
	if($_POST["signup"] == "signup")
	{
		echo "heyo"."<br>".PHP_EOL;
		if(isset($_POST["name"]))
		{
			$_SESSION["name"] = $_POST["name"];
			echo $_SESSION["name"]."<br>".PHP_EOL;
		}
		else 
			echo "Incorrect name"."<br>".PHP_EOL;
		if( isset($_POST["email"]))
		{
			$_SESSION["email"] = $_POST["email"];
			echo $_SESSION["email"]."<br>".PHP_EOL;
		}
		else 
			echo "<color=\"red\">Incorrect email.\"<br>\"".PHP_EOL;
		if(isset($_POST["signup"]))
		{
			$_SESSION["submit"] = $_POST["signup"];
			echo $_SESSION["submit"]."<br>".PHP_EOL;
		}
	}
	else
		echo "No".PHP_EOL;


		echo "<color=\"red\">Incorrect email.\"<br>\"".PHP_EOL;
?>