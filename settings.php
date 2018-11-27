<?php
	include("header.php");
	if($_POST["btn"] == "No")
	{
		$statement = "UPDATE users SET VERIFIED = 2 WHERE username = ".stringify($_SESSION["username"]);
		$db->runStatement($db->getDBConn(),$statement);
	}
	if($_POST["btn"] == "Yes")
	{
		$statement = "UPDATE users SET VERIFIED = 1 WHERE username = ".stringify($_SESSION["username"]);
		$db->runStatement($db->getDBConn(),$statement);
	}
	if($_POST["btn"] == "Change Username")
	{
		// echo $_SESSION["username"];
		if(preg_match('/[;"=:*?<>|]/',$_POST["username"] ) || $_POST["username"] == ""){
			echo	"<div style='text-align: center;'>
						<div id='errordiv'>
							No or Invalid Username format
						</div>
					</div>";
		}else{
			if(checkUnique("username", $_POST["username"])){
				$statement = "UPDATE users SET username = ".stringify($_POST["username"])." WHERE username = ".stringify($_SESSION["username"]);
				$_SESSION["username"] = $_POST["username"];
				$db->runStatement($db->getDBConn(),$statement);
			}
			else
			{
				echo	"<div style='text-align: center;'>
							<div id='errordiv'>
								Username already taken
							</div>
						</div>";
			}
		}
	}
	
	if($_POST["btn"] == "Change Email Address")
	{
		if(preg_match('/[;"=:*?<>|]/',$_POST["email"] ) || $_POST["email"] == ""){
			echo	"<div style='text-align: center;'>
						<div id='errordiv'>
							No or Invalid email format
						</div>
					</div>";
		}else{
			if(checkUnique("email", $_POST["email"])){
				$statement = "UPDATE users SET email = ".stringify($_POST["email"])." WHERE username = ".stringify($_SESSION["username"]).";";
				$db->runStatement($db->getDBConn(),$statement);
			}
			else
			{
				echo	"<div style='text-align: center;'>
							<div id='errordiv'>
								email address already taken
							</div>
						</div>";
			}
		}
	}

	if($_POST["btn"] == "Change Password")
	{
		if(preg_match('/[;"=:*?<>|]/',$_POST["newpass"]))
		{
			echo	"<div style='text-align: center;'>
						<div id='errordiv'>
							No or Invalid password
						</div>
					</div>";
		}
		else
		{
			if(!validate_password($_POST["newpass"], $_POST["verpass"]))
			{
				if(getValue("username", $_SESSION["username"], "password") === hash("whirlpool", hash("whirlpool", $_POST["currpass"])))
				{
					$statement = "UPDATE users SET `password` = ".stringify(hash("whirlpool", hash("whirlpool", $_POST["newpass"])))." WHERE username = ".stringify($_SESSION["username"]);
					$db->runStatement($db->getDBConn(),$statement);
				}else
				{
					echo	"<div style='text-align: center;'>
								<div id='errordiv'>
									Password Entered Incorrect
								</div>
							</div>";
				}
			}
			else
			{
				echo	"<div style='text-align: center;'>
							<div id='errordiv'>
								Passwords don't match
							</div>
						</div>";
			}
		}
	}
?>
<html>
	<body>
		<div align="center">
			<form action="" method="post">
			<div id="login" class="container" style="padding : 2%">
				<label for="username">Username:</label><br>
				<input type="text" name="username" value="" style="margin:3%"/><br>
				<input type="submit" name="btn" class="submit_button" value="Change Username">
			</div>
			
			<div id="login" class="container"style="padding : 2%">
				<label for="email">Email:</label><br>
				<input type="email" name="email" value="" style="margin:3%"/><br>
				<input type="submit" name="btn" class="submit_button" value="Change Email Address">
			</div>
			<br>
			<div id="login" class="container"style="padding : 2%">
				<label for="currpass">Old Password:</label><br>
				<input type="password" name="currpass" value="" style="margin:3%"/><br>
				<label for="newpass">New Password:</label><br>
				<input type="password" name="newpass" value="" style="margin:3%"/><br>
				<label for="verpass">Verify New Password:</label><br>
				<input type="password" name="verpass" value="" style="margin:3%"/><br>
				<input type="submit" name="btn" class="submit_button" value="Change Password">
			</div>
			<br>
			<div id="login" class="container"style="padding : 2%">
				<label for="btn">Send Mail Notifications:</label><br>
				<input type="submit" name="btn" class="submit_button" value="<?php echo ((getValue("username", $_SESSION["username"], "verified") == 2) ?"Yes":"No") ?>">
			</div>
		</form>
		</div>
	</body>
</html>