<?php
	session_start();
	include("config.php");
	include("header.php");
	echo "<br><br><br><br><div class='notification'>notification!!</div>";
    echo '<script type="text/javascript">
	$(function() {
		$("div.notification").hide().fadeIn().delay(3000).fadeOut("slow");
	}); 
              </script>';
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
				$err = "Password not Strong Enough";
				break;
			case 9:
				$err = "Passwords dont match";
				break;
			default:
				header("Location: confirm_reg.php");
				break;
		}
		
		// echo	"<div style='text-align: center;'><div id='errordiv'>$err</div></div>";
				// "<script type='text/javascript'>
				// $(
				// 	function()
				// 	{
				// 		$('div.container').hide().fadeIn().delay(3000).fadeOut('slow');
				// 	}
				// );
				// </script>";
				// echo '<br><br><br><br><br><div class="notification">Notice: Foobar</div>';
				// echo '<script language="JavaScript" type="text/">
					// timedMsg("errordiv") 
					//   </script>';
	}
	else if($_POST["btn"] == "back")
	{
		header("Location: index.php");
	}

	function testErrors($post)
	{
		// print_r($post);
		if($post["fname"] != "")
		{
			$_SESSION["fname"] = $post["fname"];
		}
		else
			return 1;

		if($post["lname"] != "")
		{
			$_SESSION["lname"] = $post["lname"];
		}
		else
			return 2;

		if($post["username"] != "")
		{
			if(checkUnique("USERNAME",$post["username"]))
				$_SESSION["username"] = $post["username"];
			else
				return 3;
		}
		else
			return 4;

		if($post["email"] != "")
		{
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

	function checkUnique($condition,$value)
	{
		global $db;

		$statement = "SELECT * FROM USERS WHERE ".$condition." = ".stringify($value).";";
		$records = $db->returnRecord($statement);
		// echo "<script language='javascript'>alert(".print_r($records).")</script>";
		return (!count($records));
	}
	
	function validate_password($pwrd, $confpwrd)
	{
		$hashed1 = hash("whirlpool",hash("whirlpool",$pwrd));
		$hashed2 = hash("whirlpool",hash("whirlpool",$confpwrd));
		if($hashed1 === $hashed2)
		{
			if(strlen($pwrd) >= 8 && preg_match('/[A-Z]/', $pwrd) && preg_match('/[a-z]/', $pwrd) && preg_match('/[0-9]/', $pwrd))
			{
				$_SESSION["passwrd"] = $hashed1;
				return(0);
			}
			else
			{
				return 8;
			}
		}
		else
		{
			return 9;
		}
	}
?>

<html>
	<body>
		<div style="text-align:center">
			<div id="login" class="container">
				<form action="" method="post">
					<label for="fname">First Name:</label><br>
					<input type="text" name="fname" value="<?php /*echo $_SESSION['fname'];*/?>" /><br>
					
					<label for="lname">Last Name:</label><br>
					<input type="text" name="lname" value="<?php /*echo $_SESSION['lname'];*/?>" /><br>
	
					<label for="username">Username:</label><br>
					<input type="text" name="username" value="<?php /*echo $_SESSION['username'];*/?>" /><br>
					
					<label for="email">Email:</label><br>
					<input type="text" name="email" value="<?php /*echo $_SESSION['email'];*/?>" /><br>
					
					<label for="passwrd">Password:</label><br>
					<input type="password" name="passwrd" value="" /><br>
	
					<label for="valid_passwrd">Confirm Password:</label><br>
					<input type="password" name="valid_passwrd" value="" /><br>
	
					<linktext>Already Registered? Login <a href=login.php>here</a>.<br></linktext>
					<input type="submit" class="submit_button" name="btn" value="register"/>
					<input type="submit" class="submit_button" name="btn" value="back" />
					<!-- <div class="notification">Notice: Foobar</div> -->
					<!-- <script type="text/javascript">
						$(
							function()
							{
								$('div.notification').hide().fadeIn().delay(3000).fadeOut('slow');
							}
						);
					</script> -->
				</form>
			</div>
		<div>
		
	</body>
	<script type="text/javascript">
 
	function timedMsg(id)
	{
		$(function(){
		document.getElementById(id).hide().fadeIn().delay(3000).fadeOut('slow');};)
	}
 
	</script>
</html>
