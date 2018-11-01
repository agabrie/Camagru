<?php
	session_start();
	echo "<script>alert(\"register page\");</script>";
	print_r($_POST);
	if($_POST["btn"] == "register")
	{
		echo "heyo"."<br>".PHP_EOL;
		if(isset($_POST["fname"]))
		{
			$_SESSION["fname"] = $_POST["fname"];
			echo $_SESSION["fname"]."<br>".PHP_EOL;
		}
		else
		{
			echo "<script>alert(\"no fname\");</script>";
			echo "Incorrect fname"."<br>".PHP_EOL;
		}

		if(isset($_POST["lname"]))
		{
			$_SESSION["lname"] = $_POST["lname"];
			echo $_SESSION["username"]."<br>".PHP_EOL;
		}
		else
		{
			echo "<script>alert(\"no lname\");</script>";
			echo "Incorrect lname"."<br>".PHP_EOL;
		}

		if(isset($_POST["username"]))
		{
			$_SESSION["username"] = $_POST["username"];
			echo $_SESSION["username"]."<br>".PHP_EOL;
		}
		else
		{
			echo "<script>alert(\"no name\");</script>";
			echo "Incorrect name"."<br>".PHP_EOL;
		}

		if(isset($_POST["email"]))
		{
			$_SESSION["email"] = $_POST["email"];
			echo $_SESSION["email"]."<br>".PHP_EOL;
		}
		else
		{
			echo "<script>alert(\"no email\");</script>";
			echo "Incorrect email"."<br>".PHP_EOL;
		}

		if(isset($_POST["passwrd"]))
		{
			$_SESSION["passwrd"] = $_POST["passwrd"];
			echo $_SESSION["passwrd"]."<br>".PHP_EOL;
		}
		else
		{
			echo "<script>alert(\"no passwrd\");</script>";
			echo "Incorrect passwrd"."<br>".PHP_EOL;
		}

		if(isset($_POST["valid_passwrd"]))
		{
			$_SESSION["valid_passwrd"] = $_POST["valid_passwrd"];
			echo $_SESSION["valid_passwrd"]."<br>".PHP_EOL;
		}
		else
		{
			echo "<script>alert(\"no valid_passwrd\");</script>";
			echo "Incorrect valid_passwrd"."<br>".PHP_EOL;
		}
		header("Location: confirm_login.php");
	}
	else if($_POST["btn"] == "back")
	{
		//echo "<script>alert(\"back\")</script>";
		header("Location: index.php");
	}
	//echo "<color=\"red\">Incorrect email.\"<br>\"".PHP_EOL;
?>

<html>
	<head>
		<title>CAMAGRU</title>
		<div id="heading" class="container">
			CAMAGRU
		</div>
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		
		<div id="login" class="container">
			<form action="" method="post">
				<label for="fname">First Name:</label><br>
				<input type="text" name="fname" value="" /><br>
				
				<label for="lname">Last Name:</label><br>
				<input type="text" name="lname" value="" /><br>

				<label for="username">Username:</label><br>
				<input type="text" name="username" value="" /><br>
				
				<label for="email">Email:</label><br>
				<input type="text" name="email" value="" /><br>
				
				<label for="passwrd">Confirm Password:</label><br>
				<input type="password" name="passwrd" value="" /><br>

				<label for="valid_passwrd">Password:</label><br>
				<input type="password" name="valid_passwrd" value="" /><br>

				<linktext>Already Registered? Login <a href=login.php>here</a>.<br></linktext>
				<input type="submit" class="submit_button" name="btn" value="register"/>
				<input type="submit" class="submit_button" name="btn" value="back" />
			</form>
		</div>
	</body>
	<div id="footing" class="container">
			&copy agabrie
	</div>
</html>