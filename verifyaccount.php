<?php
	include("header.php");
	if($_POST["btn"]=="Verify")
	{
		switch(testErrors($_POST))
		{
			case 1:
				echo "Incorrect Token<br>";
				break;
			default:
				header("Location: edit.php");
				break;
		}
	}
	if($_POST["btn"] == "Back")
	{
		header("Location: edit.php");
	}
	if($_POST["btn"] == "Resend")
	{
		$token = getValue("username",$_SESSION["username"], "token");
		$message = verifyemail($token);
		$mail = array	(
					"to"=>getValue("username",$_SESSION["username"], "email"),
					"subject"=>"Camagru account Verification needed",
					"message"=>$message
					);
		sendMail($mail);
		echo	"<div style='text-align: center;'><div id='errordiv'>email sent to ".stringify(getValue("username",$_SESSION["username"], "email"))."</div></div>";
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
		
		if(getValue("username",$name, "token") == $token)
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
						<input type="submit" name="btn" class="submit_button" value="Resend">
						<!-- <linktext>Resend verification link?<br>Send token <a href=login.php>here</a>.<br></linktext> -->
						<input type="submit" class="submit_button" name="btn" value="Verify"/>
						<input type="submit" class="submit_button" name="btn" value="Back" />
					</form>
			</div>
		</div>
	</body>
</html>