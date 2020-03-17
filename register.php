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
			10=>"You can't use ' < > = ' \" ; ' in fname",
			11=>"You can't use ' < > = ' \" ; ' in lname",
			12=>"You can't use ' < > = ' \" ; ' in username",
			13=>"You can't use ' < > = ' \" ; ' things in email",
			14=>"first name too short",
			15=>"last name too short",
			16=>"username too short"
	);
	function displayErrors($err){
		return testErrors($err);
		// switch(testErrors($err))
		// {
			// case 1:$err = "No First NAME";break;
			// case 2:$err = "No Last NAME";break;
			// case 3:$err = "USERNAME already exists";break;
			// case 4:$err = "No USERNAME";break;
			// case 5:$err = "email already in use";break;
			// case 6:$err = "No Email";break;
			// case 7:$err = "No Password";break;
			// case 8:$err =	"Password not Strong Enough:<br>Your password must contain Uppercase, Lowercase and digits and must be at least 8 characters long";break;
			// case 9:$err = "Passwords dont match";break;
			// case 10:$err = "Don't be that guy...you can't use ' < > = ' \" ; ' in fname";break;
			// case 11:$err = "Don't be that guy...you can't use ' < > = ' \" ; ' in lname";break;
			// case 12:$err = "Don't be that guy...you can't use ' < > = ' \" ; ' in username";break;
			// case 13:$err = "Don't be that guy...you can't use ' < > = ' \" ; ' things in email";break;
			// default:
				// header("Location: confirm_reg.php");
		// 		break;
		// }
		// return	"<div id='errordiv' hidden>$err</div>";
		// return $err;
		// $error = $err;
		// echo $err;

	}

	function testErrors($post)
	{
		global $errors;
		$session = array();
		echo "sess";
		// print_r($session);
		$errorNum = array();
		if(isset($post["fname"]))
		{
			if(strlen($post["fname"])<3||preg_match('/[;"=:*?<>|]/',$post["fname"] ))
				array_push($errorNum,$errors[10]);
			else
				$session["fname"] = $post["fname"];

		}
		else
				array_push($errorNum,$errors[1]);
				// return 1;

		if(isset($post["lname"]))
		{
			if(strlen($post["lname"])<3||preg_match('/[;"=:*?<>|]/',$post["lname"] ))
			{
				array_push($errorNum,$errors[11]);
				// $errorNum= 1001;
			}else
			$session["lname"] = $post["lname"];
		}
		else
				array_push($errorNum,$errors[2]);
				// $errorNum= 2;

		if(isset($post["username"]))
		{
			if(strlen($post["username"])<3||preg_match('/[;"=:*?<>|]/',$post["username"] ))
			{
				array_push($errorNum,$errors[12]);

				// $errorNum=  1002;
			}
			if(checkUnique("USERNAME",$post["username"]))
				$session["username"] = $post["username"];
			else
			array_push($errorNum,$errors[13]);
			// $errorNum=  3;
		}
		else
				array_push($errorNum,$errors[4]);
				// $errorNum=  4;

		if(isset($post["email"]))
		{
			if(preg_match('/[;"=:*?<>|]/',$post["email"] ))
			{
				array_push($errorNum,$errors[13]);
				// $errorNum=  1003;
			}
			if(checkUnique("EMAIL",$post["email"]))
				$session["email"] = $post["email"];
			else
			array_push($errorNum,$errors[5]);

			// $errorNum=  5;
		}
		else
		array_push($errorNum,$errors[6]);

		// $errorNum=  6;

		if(isset($post["valid_passwrd"]) && isset($post["passwrd"]))
		{
			$validated = validate_password($post["passwrd"], $post["valid_passwrd"]);
			echo "validated=>".$validated."<br />";
			// $errorNum=  $validated;
		}
		else
			array_push($errorNum,$errors[7]);

		// $errorNum=  7;
		echo 'session after =>';
		print_r($session);
		echo "<br />";
		print_r($errorNum);
		return $errorNum;
	}
?>

<html>
	<body>
		<div class="main">
			<div id="login" class="centerd">
				<!-- <div><> -->
				<div class="errordiv" id="errordiv" hidden><?php echo $error?></div>
				
				<form action="" method="post">
					<inputField name="FirstName" error="First Name Invalid" text="First Name" id="inf"/>
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
					<input type="submit" class="button"  name="register" value="register" id="reg"/>
					<input type="submit" class="button" name="btn" value="back" />
				</form>
				<?php
					// print_r($_POST);
					// print_r($_SESSION);

					if(isset($_POST["register"])){
						displayErrors($_POST);
					}
					else{
						if(isset($_POST["back"]))
							header("Location: edit.php");
					}
				?>
			</div>
		<div>
	</body>
</html>
<script type="text/javascript">
	function customTag(tagName,fn){
  		document.createElement(tagName);
  		//find all the tags occurrences (instances) in the document
  		var tagInstances = document.getElementsByTagName(tagName);
        //for each occurrence run the associated function
        for ( var i = 0; i < tagInstances.length; i++) {
            fn(tagInstances[i]);
        }
	}
 
	function inputField(element){
        if (element.attributes.text && element.attributes.name && element.attributes.error){
            var text = element.attributes.text.value;
			var name = element.attributes.name.value;
			var error = element.attributes.error.value;
			// let errlbl = document.createElement("label");
			// errlbl.style.color = "red";
			// console.log(errlbl)
			// element.appendChild(errlbl);
			element.innerHTML = "<div class='inputField' id='inputField'>"+
			"<label class='error'>"+error+"</label><br>"+
			"<label for="+name+">"+text+":</label><br>"+
			"<input type='text' name="+name+" value='' /><br>"+
			"</div>";
        }
	}
	customTag("inputField",inputField);

	let inf = document.getElementById('inf');
	console.log(inf);
</script>
<!-- <script type="text/javascript">
	var btn = document.getElementById('reg');
	var err = document.getElementById('errordiv');
	alert(data);
	if(err.value !== "No errors")
		err.removeAttribute('hidden');
	console.log(err,reg);
	// btn.addEventListener('click', function(){
    //     err.removeAttribute('hidden');
    // });
	function showError(err){
		console.log(err)
	}
</script> -->