<?php
	session_start();
	include("config.php");
	include("header.php");
	if($_POST["btn"] == "login")
	{
		// print_r($_POST);
		switch(testErrors($_POST))
		{
			case 1:
				echo "Username or password is incorrect";
				break;
			default:
				header("Location: confirm_login.php");
				break;
		}
	}
	else if($_POST["btn"] == "back")
	{
		header("Location: register.php");
	}

	function testErrors($post)
	{
		if(check_login($post["username"],$post["passwrd"]))
			return 0;
		else
			return 1;
	}
	function check_login($name,$passwrd)
	{
		global $db;
		$statement = "SELECT * FROM USERS WHERE USERNAME = ".stringify($name);//." AND PASSWORD = ".stringify(hash("whirlpool", hash("whirlpool", $passwrd)));
		echo $statement."<br>";
		$records = $db->returnRecord($statement);
		// echo "<script language='javascript'>alert(".print_r($records).")</script><br>";
		if($records[0]["password"] == hash("whirlpool", hash("whirlpool", $passwrd)))
			$_SESSION["passwrd"]=$records[0]["password"];
		else
			return(0);
		$_SESSION["username"] = $records[0]["username"];
		$_SESSION["fname"] = $records[0]["fname"];
		$_SESSION["lname"] = $records[0]["lname"];
		$_SESSION["email"] = $records[0]["email"];
		// $_SESSION["verified"] = $records[0]["verified"];
		// echo "password from DB : ".$records[0]["password"]."<br>";
		// echo "input : ".hash("whirlpool", hash("whirlpool", $passwrd))."<br>";
		$_SESSION["verified"]=$records[0]["verified"];
		// print_r($_SESSION);
		return(1);
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