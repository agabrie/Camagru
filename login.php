<?php
	include("header.php");
	if($_POST["btn"] == "login")
	{
		switch(testErrors($_POST))
		{
			case 1:
				$err = "Username or password is incorrect";
				break;
			case 2:
				$err = "Don't even think about it...";
				break;
			default:
				header("Location: confirm_login.php");
				break;
		}
		echo	"<div style='text-align: center;'>
					<div id='errordiv'>
						$err
					</div>
				</div>";
	}
	else if($_POST["btn"] == "back")
	{
		header("Location: register.php");
	}

	function testErrors($post)
	{
		if(preg_match('/[;"=:*?<>|]/',$post["username"] ))
		{
			return 2;
		}
		if(check_login($post["username"],$post["passwrd"]))
			return 0;
		else
			return 1;
	}

	function check_login($name,$passwrd)
	{
		global $db;
		$statement = "SELECT * FROM USERS WHERE USERNAME = ".stringify($name);
		$records = $db->returnRecord($statement);
		if($records[0]["password"] == hash("whirlpool", hash("whirlpool", $passwrd)))
			$_SESSION["passwrd"]=$records[0]["password"];
		else
			return(0);
		$_SESSION["username"] = $records[0]["username"];
		$_SESSION["fname"] = $records[0]["fname"];
		$_SESSION["lname"] = $records[0]["lname"];
		$_SESSION["email"] = $records[0]["email"];
		$_SESSION["verified"]=$records[0]["verified"];
		return(1);
	}
?>
<html>
	<body>
		<div align="center">
			<div id="login" class="container">
				<form action="login.php" method="post">
					<label for="username">Username:</label><br>
					<input type="text" name="username" value="" /><br>

					<label for="passwrd">Confirm Password:</label><br>
					<input type="password" name="passwrd" value="" /><br>

					<linktext>Forgot Password?<br>Reset password <a href=resetpassword.php>here</a>.<br></linktext>
					<input type="submit" class="submit_button" name="btn" value="login"/>
					<input type="submit" class="submit_button" name="btn" value="back" />
				</form>
			</div>
		</div>
	</body>
</html>