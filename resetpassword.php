<?php
	include("header.php");
	if($_POST["btn"]=="Confirm")
	{
		echo "<div style='text-align: center;'><div id='errordiv'> an email was sent to ".stringify(getValue("email",$_POST["email"],"email"))."</div></div>";
	}

	if($_POST["btn"] == "Send")
	{
		$token = "X0x".substr(getValue("email",$_POST["email"], "password"),0,7);
		$message = resetpassword($token);
		$mail = array	(
					"to"=>getValue("email",$_SESSION["email"], "email"),
					"subject"=>"Password Reset for Camagru",
					"message"=>$message
					);
		sendMail($mail);
		$statement = "UPDATE users SET `password` = ".stringify(hash("whirlpool", hash("whirlpool", $token)))." WHERE email = ".stringify(getValue("email",$_POST["email"],"email"));
		echo	"<div style='text-align: center;'><div id='errordiv'>email sent to ".stringify(getValue("email",$_SESSION["email"], "email"))."</div></div>";
		
	}
	
?>
<html>
	<body>
		<div align="center">
			<!-- <div style="text-align:center">	 -->
				<div id="login" class="container">
					<form action="" method="post">
						<label for="token">email:</label><br>
						<input type="email" name="email" value="<?php echo $_GET['token'];?>" /><br>
						<input type="submit" name="btn" class="submit_button" value="Resend">
						<!-- <linktext>Resend verification link?<br>Send token <a href=login.php>here</a>.<br></linktext> -->
						<input type="submit" class="submit_button" name="btn" value="Confirm"/>
						<input type="submit" class="submit_button" name="btn" value="Back" />
					</form>
			</div>
		</div>
	</body>
</html>