<?php
	session_start();
	include("config.php");
	include("header.php");
	if($_POST["btn"] == "login")
	{
		if(isset($_POST["username"]))
		{
			$_SESSION["username"] = $_POST["username"];
		}
		else
		{
			echo "Incorrect name"."<br>".PHP_EOL;
		}
		if( isset($_POST["passwrd"]))
		{
			$_SESSION["passwrd"] = $_POST["passwrd"];
		}
		else
		{
			echo "Incorrect passwrd"."<br>".PHP_EOL;
		}
		header("Location: confirm_login.php");
	}
	else if($_POST["btn"] == "back")
	{
		header("Location: register.php");
	}

	function testErrors($post)
	{
		if(check_username($post["username"]) && check_password($post["passwrd"]))
			return 1;
		else
			return 0;
	}
	function check_username($name)
	{
		$statement = "SELECT * FROM USERS WHERE USERNAME = ".stringify($name);
		return 1;
	}
	function check_password($passwrd)
	{
		return 1;
	}
?>
<html>
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
</html>