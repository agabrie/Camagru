<?php
	include("header.php");
	// print_r($_GET);
	if(isset($_POST["verify"]))
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
	if(isset($_POST["back"]))
	{
		header("Location: edit.php");
	}
	if(isset($_POST["resend"]))
	{
		$token = getValue("username",$_SESSION["username"], "token");
		$message = verifyemail($token);
		$mail = array	(
					"to"=>getValue("username",$_SESSION["username"], "email"),
					"subject"=>"Camagru account Verification needed",
					"message"=>$message
					);
		sendMail($mail);
		echo	"<div style='text-align: center;'>
					<div id='errordiv'>
						email sent to ".stringify(getValue("username",$_SESSION["username"], "email"))."
					</div>
				</div>";
	}

	function testErrors($post)
	{
		if(checkToken($_SESSION["email"],$post["token"]))
			return 0;
		else
			return 1;
	}

	function checkToken($name, $token)
	{
		global $db;
		$userID = getValue("email",$email, "userId");
		$dbtoken = getValue("email",$email, "token");
		// $token=$token;
		// echo "<div class='main'><br/>tokens=><br/>".$dbtoken."<br/>".$token."<br/>";
		// print_r($_SESSION);
		// echo $dbtoken."</div>";
		if($dbtoken == $token)
		{
			// echo "yaaaaas";
			$statement = "UPDATE USERS SET VERIFIED = 1 WHERE USERID = ".stringify($userID);
			$db->runStatement($db->getDBConn(),$statement);
			$_SESSION["userId"] = $userID;
		}else
			return 0;
		return 1;
	}
?>

<html>
	<body>
		<div class="main">
				<div id="verification" class="centerd">
					<form action="" method="post">
						<label for="token">Token:</label><br/>
						<input type="text" name="token" value="<?php if(isset($_GET["token"])) echo $_GET['token'];?>" required/><br/>
						<input type="submit" class="button" name="resend" value="Resend">
						<input type="submit" class="button" name="verify" value="Verify"/>
						<input type="submit" class="button" name="back" value="Back" formnovalidate/>
					</form>
			</div>
		</div>
	</body>
</html>