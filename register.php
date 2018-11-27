<?php
	include("header.php");
	if($_POST["btn"] == "register")
	{
		switch(testErrors($_POST))
		{
			case 1:
				$err = "No First NAME";
				break;
			case 2:
				$err = "No Last NAME";
				break;
			case 3:
				$err = "USERNAME already exists";
				break;
			case 4:
				$err = "No USERNAME";
				break;
			case 5:
				$err = "email already in use";
				break;
			case 6:
				$err = "No Email";
				break;
			case 7:
				$err = "No Password";
				break;
			case 8:
				$err =	"Password not Strong Enough:<br>".
						"Your password must contain Uppercase, Lowercase and digits and must be at least 8 characters long";
				break;
			case 9:
				$err = "Passwords dont match";
				break;
			case 1000:
				$err = "Don't be that guy...you can't use ' < > = ' \" ; ' in fname";
				break;
			case 1001:
				$err = "Don't be that guy...you can't use ' < > = ' \" ; ' in lname";
				break;
			case 1002:
				$err = "Don't be that guy...you can't use ' < > = ' \" ; ' in username";
				break;
			case 1003:
				$err = "Don't be that guy...you can't use ' < > = ' \" ; ' things in email";
				break;
			default:
				header("Location: confirm_reg.php");
				break;
		}
		echo	"<div style='text-align: center;'>
					<div id='errordiv'>
						$err
					</div>
				</div>";
	}
	else if($_POST["btn"] == "back")
		header("Location: edit.php");

	function testErrors($post)
	{
		if($post["fname"] != "")
		{
			if(preg_match('/[;"=:*?<>|]/',$post["fname"] ))
				return 1000;
			$_SESSION["fname"] = $post["fname"];
		}
		else
			return 1;

		if($post["lname"] != "")
		{
			if(preg_match('/[;"=:*?<>|]/',$post["lname"] ))
			{
				return 1001;
			}
			$_SESSION["lname"] = $post["lname"];
		}
		else
			return 2;

		if($post["username"] != "")
		{
			if(preg_match('/[;"=:*?<>|]/',$post["username"] ))
			{
				return 1002;
			}
			if(checkUnique("USERNAME",$post["username"]))
				$_SESSION["username"] = $post["username"];
			else
				return 3;
		}
		else
			return 4;

		if($post["email"] != "")
		{
			if(preg_match('/[;"=:*?<>|]/',$post["email"] ))
			{
				return 1003;
			}
			if(checkUnique("EMAIL",$post["email"]))
				$_SESSION["email"] = $post["email"];
			else
				return 5;
		}
		else
			return 6;

		if($post["passwrd"] != "")
		{
			$validated = validate_password($post["passwrd"], $post["valid_passwrd"]);
			return $validated;
		}
		else
			return 7;
	}
?>

<html>
	<body>
		<div style="text-align:center">
			<div id="login" class="container">
				<form action="" method="post">
					<label for="fname">First Name:</label><br>
					<input type="text" name="fname" value="" /><br>
					
					<label for="lname">Last Name:</label><br>
					<input type="text" name="lname" value="" /><br>
	
					<label for="username">Username:</label><br>
					<input type="text" name="username" value="" /><br>
					
					<label for="email">Email:</label><br>
					<input type="email" name="email" value="" /><br>
					
					<label for="passwrd">Password:</label><br>
					<input type="password" name="passwrd" value="" /><br>
	
					<label for="valid_passwrd">Confirm Password:</label><br>
					<input type="password" name="valid_passwrd" value="" /><br>
	
					<linktext>Already Registered? Login <a href=login.php>here</a>.<br></linktext>
					<input type="submit" class="submit_button" name="btn" value="register"/>
					<input type="submit" class="submit_button" name="btn" value="back" />
				</form>
			</div>
		<div>
	</body>
</html>
