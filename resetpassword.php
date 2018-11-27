<?php
	include("header.php");

	if($_POST["btn"] == "Confirm")
	{
		$token = "X0x".substr(getValue("email",$_POST["email"], "password"),0,7);
		$message = resetpassword($token,getValue("email",$_POST["email"],"email"));
		$mail = array	(
					"to"=>getValue("email",$_POST["email"], "email"),
					"subject"=>"Password Reset for Camagru",
					"message"=>$message
					);
		sendMail($mail);
		$statement = "UPDATE users SET `password` = ".stringify(hash("whirlpool", hash("whirlpool", $token)))." WHERE email = ".stringify(getValue("email",$_POST["email"],"email"));
		$db->runStatement($db->getDBConn(), $statement);
		echo	"<div style='text-align: center;'>
					<div id='errordiv'>
						email sent to ".stringify(getValue("email",$_POST["email"], "email"))."
					</div>
				</div>";
	}
	if($_POST["btn"] == "Back")
	{
		header("Location: login.php");
	}
?>
<html>
	<body>
		<div align="center">
				<div id="login" class="container">
					<form action="" method="post">
						<label for="token">email:</label><br>
						<input type="email" name="email" value="<?php echo $_GET['token'];?>" /><br>
						<input type="submit" class="submit_button" name="btn" value="Confirm"/>
						<input type="submit" class="submit_button" name="btn" value="Back" />
					</form>
			</div>
		</div>
	</body>
</html>