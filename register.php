<?php
	include("header.php");
	global $error;
	$errors = array(
			1=>"No First NAME",
			2=>"No Last NAME",
			3=>"USERNAME already exists",
			4=>"No USERNAME",
			5=>"email already in use",
			6=>"No Email",
			7=>"No Password",
			8=>"Password not Strong Enough:<br>Your password must contain Uppercase, Lowercase and digits and must be at least 8 characters long",
			9=>"Passwords dont match",
			10=>"You can't use special characters in fname",
			11=>"You can't use special characters in lname",
			12=>"You can't use special characters in username",
			13=>"You can't use special characters things in email",
			14=>"first name too short",
			15=>"last name too short",
			16=>"username too short"
	);
	// function displayErrors($err){
	// 	return testErrors($err);
	// }
	function testFName($fname){
		global $errors;
			$err = 0;
				if(strlen($fname)<3)
					$err = 14;
				else if(preg_match('/[;"=:*?<>|]/',$fname ))
					$err = 10;
			if($err > 0){
				return "<div id='err1' class='error' hidden>".$errors[$err]."</div>";
			}
			else{
				return;
			}
	}
	function testLName($lname){
		global $errors;
			$err = 0;
				if(strlen($lname)<3)
					$err = 15;
				else if(preg_match('/[;"=:*?<>|]/',$lname ))
					$err = 11;
			if($err > 0){
				return "<div id='errordiv'>".$errors[$err]."</div>";
			}
			else{
				return;
			}
	}
	function testUName($uname){
		global $errors;
			$err = 0;
				if(strlen($uname)<3)
					$err = 16;
				else if(preg_match('/[;"=:*?<>|]/',$uname ))
					$err = 12;
			if($err > 0){
				return "<div id='errordiv'>".$errors[$err]."</div>";
			}
			else{
				return ;
			}
	}
	function testEmail($email){
		global $errors;
		$err = 0;
			if(!checkUnique("EMAIL",$email))
				$err = 5;
		return $err;
	}
	function testPassword($passwrd,$vpasswrd){
		global $errors;
		$err = 0;
			// if(!checkUnique("EMAIL",$email))
				// $err = 5;
			// if($err > 0){
				// return "<div id='errordiv'>".$errors[$err]."</div>";
			// }
			// else{
				// return ;
			// }
				// echo $passwrd,$vpasswrd;
			$err = validate_password($passwrd, $vpasswrd);
			// echo "validated=>".$err."<br />";
			return  $err;
	}
	function testErrors($post)
	{
		global $errors;
		// print_r($post);
			// if(testFName($post["fname"]) == 0){
			// 	if(testLName($post["lname"]) == 0){
			// 		if(testUName($post["username"]) == 0){
				$msg = 0;
		if(($msg=testEmail($post["email"])) == 0){
			echo "email = ".$msg;
			if(($msg =testPassword($post["passwrd"],$post["valid_passwrd"]))==0){
				// echo "passwords = ".$msg;
				$_SESSION["fname"] = $post["fname"];
				$_SESSION["lname"] = $post["lname"];
				$_SESSION["username"] = $post["username"];
				$_SESSION["email"] = $post["email"];
				// $_SESSION["fname"] = $post["fname"];
				// $_SESSION["fname"] = $post["fname"];
				// $_SESSION["fname"] = $post["fname"];

				header("Location: confirm_reg.php");
			}
			else
				echo "<div class='errordiv' id='err_fname'>".$errors[9]."</div>";
		}
		else
			echo "<div class='errordiv' id='err_fname'>".$errors[$msg]."</div>";
					// }
				// }
			// }


		// if(isset($post["valid_passwrd"]) && isset($post["passwrd"]))
		// {
		// 	$validated = validate_password($post["passwrd"], $post["valid_passwrd"]);
		// 	echo "validated=>".$validated."<br />";
		// 	// $errorNum=  $validated;
		// }
		// else
		// 	array_push($errorNum,$errors[7]);

		// // $errorNum=  7;
		// echo 'session after =>';
		// print_r($session);
		// echo "<br />";
		// print_r($errorNum);
		// return $errorNum;
	}
?>

<html>
	<body>
		<div class="main">
			<div id="login" class="centerd">
				
				<form action="" method="post">
					<!-- <inputField name="fname" text="First Name"/>
					<inputField name="lname" text="Last Name"/> -->

					<label for="fname">First Name:</label><br>
					<input type="text" name="fname"  id="fname" required value="<?php if(isset($_POST["fname"]))echo $_POST["fname"]; ?>" /><br>
					<div class="errordiv" id="err_fname" hidden></div>
					
					<label for="lname">Last Name:</label><br>
					<input type="text" name="lname"  id="lname" required value="<?php if(isset($_POST["lname"]))echo $_POST["lname"]; ?>" /><br>
					<div class="errordiv" id="err_lname" hidden></div>
	
					<label for="username">Username:</label><br>
					<input type="text" name="username" id="username" required value="<?php if(isset($_POST["username"]))echo $_POST["username"]; ?>" /><br>
					<div class="errordiv" id="err_username" hidden></div>
					
					<label for="email">Email:</label><br>
					<input type="email" name="email" id="email" required value="<?php if(isset($_POST["email"]))echo $_POST["email"]; ?>" /><br>
					<div class="errordiv" id="err_email" hidden></div>
					
					<label for="passwrd">Password:</label><br>
					<input type="password" name="passwrd" value="" id="passwrd" required><br>
					<div class="errordiv" id="err_passwrd" hidden></div>
	
					<label for="valid_passwrd">Confirm Password:</label><br>
					<input type="password" name="valid_passwrd" value="" id="valid_passwrd" required/><br>
					<div class="errordiv" id="err_valid_passwrd" hidden></div>
	
					<linktext>Already Registered? Login <a href=login.php>here</a>.<br></linktext>
					<input type="submit" class="button"  name="register" value="register" id="reg" disabled/>
					<input type="submit" class="button" name="back" value="back" formnovalidate/>
				</form>
				<?php
					// print_r($_POST);
					// print_r($_SESSION);

					if(isset($_POST["register"])){
						testErrors($_POST);
					}
					else{
						// print_r($_POST);
						if(isset($_POST["back"])){
							// echo "back pressed";
							header("Location: index.php");
						}
					}
				?>
			</div>
		<div>
	</body>
</html>
<script type="text/javascript" src='register.js'></script>
