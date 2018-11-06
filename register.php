<?php
	session_start();
	require("config.php");
	echo "<script>alert(\"register page\");</script>";
	// print_r($_POST);
	if($_POST["btn"] == "register")
	{
		if(isset($_POST["fname"]))
		{
			$_SESSION["fname"] = $_POST["fname"];
		}
		else
		{
			echo "<script>alert(\"no fname\");</script>";
		}

		if(isset($_POST["lname"]))
		{
			$_SESSION["lname"] = $_POST["lname"];
		}
		else
		{
			echo "<script>alert(\"no lname\");</script>";
		}

		if(isset($_POST["username"]))
		{
			$taken = username_taken($_POST["username"]);
			if($taken < 1)
				$_SESSION["username"] = $_POST["username"];
			else
				echo "<script>alert(\"username already taken.\");</script>";
		}
		else
		{
			echo "<script>alert(\"no name\");</script>";
		}

		if(isset($_POST["email"]))
		{
			$_SESSION["email"] = $_POST["email"];
		}
		else
		{
			echo "<script>alert(\"no email\");</script>";
		}
		if(validate_password($_POST["passwrd"], $_POST["valid_passwrd"]))
			header("Location: confirm_login.php");
	}
	else if($_POST["btn"] == "back")
	{
		header("Location: index.php");
	}

	function username_taken($username)
	{
		$taken = "SELECT COUNT(*) FROM USERS WHERE `USERNAME` = ".stringify($username);
		echo(get_class($db));
		//$db->returnRecord($taken);
		// echo $taken.PHP_EOL;
		//print_r($db->getDBConn());
		//$names = $db->runStatement($db->getDBConn(),$taken);
		// $namethingy = $names->fetch_all();
		// echo(count($namesthingy));
		// echo "Dah";
		   //  echo "<script>alert(\"".$names."\");</script>";
			// echo $taken;
		return 0;
	}
	function validate_password($pwrd, $confpwrd)
	{
		$hashed1 = hash("whirlpool",hash("whirlpool",$pwrd));
		$hashed2 = hash("whirlpool",hash("whirlpool",$confpwrd));
		if($hashed1 === $hashed2)
		{
			if(strlen($pwrd) >= 8 && preg_match('/[A-Z]/', $pwrd) && preg_match('/[a-z]/', $pwrd) && preg_match('/[0-9]/', $pwrd))
			{
				$_SESSION["passwrd"] = $hashed1;
				return(1);
				// $_SESSION["valid_passwrd"] = $hashed2;
			}
			else
			{
				echo "<script>alert(\"password is not strong enough: Must contain 8 characters, Uppercase characters, lowercase charcters and numerical characters.\");</script>";
				return 0;
			}
		}
		// if(isset($pwrd))
		// {
		// 	$_SESSION["passwrd"] = $_POST["passwrd"];
		// 	echo $_SESSION["passwrd"]."<br>".PHP_EOL;
		// }
		// else
		// {
		// 	echo "<script>alert(\"no passwrd\");</script>";
		// 	echo "Incorrect passwrd"."<br>".PHP_EOL;
		// }

		// if(isset($_POST["valid_passwrd"]))
		// {
		// 	$_SESSION["valid_passwrd"] = $_POST["valid_passwrd"];
		// 	echo $_SESSION["valid_passwrd"]."<br>".PHP_EOL;
		// }
		// else
		// {
		// 	echo "<script>alert(\"no valid_passwrd\");</script>";
		// 	echo "Incorrect valid_passwrd"."<br>".PHP_EOL;
		// }
	}
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
		<div>
	</body>
	<div id="footing" class="container">
			&copy agabrie
	</div>
</html>