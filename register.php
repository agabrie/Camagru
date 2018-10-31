<?php
	session_start();
	//print_r($_POST);
	if($_POST["btn"] == "TRUE")
	{
		//echo "heyo"."<br>".PHP_EOL;
		if(isset($_POST["name"]))
		{
			$_SESSION["name"] = $_POST["name"];
			//echo $_SESSION["name"]."<br>".PHP_EOL;
		}
		else 
			echo "Incorrect name"."<br>".PHP_EOL;
		if( isset($_POST["email"]))
		{
			$_SESSION["email"] = $_POST["email"];
			//echo $_SESSION["email"]."<br>".PHP_EOL;
		}
		else 
			echo "<color=\"red\">Incorrect email.\"<br>\"".PHP_EOL;
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
				<label for="fname">Full Name:</label><br>
				<input type="text" name="fname" value="" /><br>
				
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