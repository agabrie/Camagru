<?php
	session_start();
	echo "<script>alert(\"login page\");</script>";
	print_r($_POST);
	if($_POST["btn"] == "login")
	{
		echo "heyo"."<br>".PHP_EOL;
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
		if( isset($_POST["email"]))
		{
			$_SESSION["email"] = $_POST["email"];
			echo $_SESSION["email"]."<br>".PHP_EOL;
		}
		else
		{
			echo "<script>alert(\"no email\");</script>";
			echo "Incorrect email"."<br>".PHP_EOL;
		}

		if( isset($_POST["passwrd"]))
		{
			$_SESSION["passwrd"] = $_POST["passwrd"];
			echo $_SESSION["passwrd"]."<br>".PHP_EOL;
		}
		else
		{
			echo "<script>alert(\"no passwrd\");</script>";
			echo "Incorrect passwrd"."<br>".PHP_EOL;
		}
		header("Location: confirm_login.php");
	}
	else if($_POST["btn"] == "back")
	{
		//echo "<script>alert(\"back\")</script>";
		header("Location: register.php");
	}
		echo "No".PHP_EOL;
	//echo "<color=\"red\">Incorrect email.\"<br>\"".PHP_EOL;
?>
<html>
<head>
		<title>CAMAGRU</title>
		<div id="heading" class="container">
			CAMAGRU
			<a href="register.php"><linktext style="float:right">login/register</linktext></a>
		</div>
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div align="center">
		<!-- <div style="text-align:center">	 -->
			<div id="login" class="container">
				<form action="login.php" method="post">
					<label for="username">Username:</label><br>
					<input type="text" name="username" value="" /><br>

					<label for="email">Email:</label><br>
					<input type="text" name="email" value="" /><br>

					<label for="passwrd">Confirm Password:</label><br>
					<input type="password" name="passwrd" value="" /><br>

					<linktext>Forgot Password?<br>Reset password <a href=login.php>here</a>.<br></linktext>
					<input type="submit" class="submit_button" name="btn" value="login"/>
					<input type="submit" class="submit_button" name="btn" value="back" />
				</form>
			</div>
		</div>
	</body>
	<div id="footing" class="container">
			&copy agabrie
	</div>
</html>