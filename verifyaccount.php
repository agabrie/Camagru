<?php
	// session_start();
	include("header.php");
	if($_POST["btn"]=="verify")
	{
		switch(testErrors($_POST))
		{
			case 1:
				echo "Incorrect Token<br>";
				break;
			default:
				header("Location: index.php");
				break;
		}
	}
	if($_POST["btn"] == "back")
	{
		header("Location: index.php");
	}
	function testErrors($post)
	{
		if(checkToken($_SESSION["username"],$post["token"]))
			return 0;
		else
			return 1;
	}
	function checkToken($name, $token)
	{
		global $db;
		
		if(getValue($name, "token") == $token)
		{
			$statement = "UPDATE USERS SET VERIFIED = 1 WHERE USERNAME = ".stringify($name);
			$db->runStatement($db->getDBConn(),$statement);
		}else
			return 0;
		return 1;
	}
?>

<html>
	<body>
		<div align="center">
			<!-- <div style="text-align:center">	 -->
				<div id="login" class="container">
					<form action="" method="post">
						<label for="token">Token:</label><br>
						<input type="text" name="token" value="<?php echo $_GET['token'];?>" /><br>
						<input type="">
						<!-- <linktext>Resend verification link?<br>Send token <a href=login.php>here</a>.<br></linktext> -->
						<input type="submit" class="submit_button" name="btn" value="verify"/>
						<input type="submit" class="submit_button" name="btn" value="back" />
					</form>
			</div>
		</div>
	</body>
</html>