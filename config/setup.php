<?php
	require("config/database.php");
	session_start();
	// global $db;
	$db = new Db(
				array	(
						"servername"     =>"localhost",
						"username"		=>"root",
						"password"		=>"R00t",
						"dbname"		=>"CAMAGRU"
						)
				);
	$columns = array	(
						"userId INT not NULL AUTO_INCREMENT PRIMARY KEY",
						"username VARCHAR(20) not NULL",
						"fname VARCHAR(20) default 'Mohammed'",
						"lname VARCHAR(20) default 'LastNams'",
						"email VARCHAR(40) not NULL",
						"`password` VARCHAR(255) not NULL",
						"verified TINYINT(1) NOT NULL DEFAULT '0'",
						"galleryId INT(11) NOT NULL default '0'",
						"token VARCHAR(255) not NULL"
						);
	
	$db->createTABLE	(
						array	(	"name"		=>"USERS",
									"columns"	=>$columns
								)
						);
	
	$imagecolumns = array	(
							"id INT NOT NULL AUTO_INCREMENT PRIMARY KEY",
							"image LONGBLOB not NULL",
							"imageName VARCHAR(100) not NULL",
							"userID INT NOT NULL default '0'",
							"`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"
							);
	$db->createTABLE	(
						array	(	"name"=>"IMAGES",
									"columns"=>$imagecolumns
								)
						);
	$commentcolumns = array	(
							"commentID INT NOT NULL AUTO_INCREMENT PRIMARY KEY",
							"comment varchar(255) not NULL",
							"imageID INT not NULL",
							"userID INT NOT NULL default '0'",
							"`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"
							);
	$db->createTABLE	(
						array	(	"name"=>"COMMENTS",
									"columns"=>$commentcolumns
								)
						);
	$likescolumns = array	(
							"likeID INT NOT NULL AUTO_INCREMENT PRIMARY KEY",
							"imageID INT not NULL",
							"userID INT NOT NULL default '0'"
							);
	$db->createTABLE	(
						array	(	"name"=>"LIKES",
									"columns"=>$likescolumns
								)
						);
	
	function stringify($string)
	{
		return "'".$string."'";
	}

	function sendMail($mail)
	{
		$to			=	$mail["to"];
		$subject	=	$mail["subject"];
		$message	=	$mail["message"];
		$headers	=	"From: ".$mail["headers"]["from"]."\r\n".
						"Reply-To: ".$mail["headers"]["Reply-To"]."\r\n".
						"X-Mailer: ".$mail["headers"]["X-Mailer"];
		mail($to, $subject, $message);
	}

	function createMessage($message)
	{
		$count = 0;

		foreach($message as $paragraph)
		{
			if($count)
				$final = $final.PHP_EOL;
			$final = $final.$paragraph;
			$count++;
		}
		return($final);
	}
	function linkToken($page,$token)
	{
		return "http://localhost:8080/Camagru/".$page."?action=get&token=".$token[0];
	}
	function getValue($field,$name,$value)
	{
		global $db;
		$statement = $statement = "SELECT * FROM USERS WHERE ".strtoupper($field)." = ".stringify($name);
		// echo $statement;
		$records = $db->returnFirstRecord($statement);
		// print_r($records["verified"]);
		if(isset($records[$value]))
			return($records[$value]);
		return("no value returned");
	}
	function getImageValue($field,$name,$value)
	{
		global $db;
		$statement = $statement = "SELECT * FROM IMAGES WHERE ".strtoupper($field)." = ".stringify($name);
		$records = $db->returnFirstRecord($statement);
		if($records[$value])
			return($records[$value]);
		return("no value returned");
	}
	function getCommentsValue($field,$name,$value)
	{
		global $db;
		$statement = $statement = "SELECT * FROM COMMENTS WHERE ".strtoupper($field)." = ".stringify($name);
		$records = $db->returnFirstRecord($statement);
		if($records[$value])
			return($records[$value]);
		return("no value returned");
	}
	function getLikesValue($fields,$name,$value)
	{
		global $db;
		$statement = $statement = "SELECT * FROM LIKES WHERE ".strtoupper($fields[0])." = ".stringify($name[0]);
		if(count($fields) > 1)
		{
			$i = 1;
			while($i < count($fields))
			{
				$statement .= " AND ".strtoupper($fields[$i])." = ".stringify($name[$i]);
				$i++;
			}
		}
		$records = $db->returnFirstRecord($statement);
		if($records[$value])
				return($records[$value]);
		return("no value returned");
	}

	function getNumLikes($imageID)
	{
		global $db;
		$statement = "SELECT * FROM LIKES WHERE imageID = ".stringify($imageID);
		$records = $db->returnRecord($statement);
		return(count($records));
	}
	
	function verifyemail($token)
	{
		$message = createMessage(array	("Thank You for registering with Camagru",
										// "To activate your account please click on the link below.",
										// linkToken('verifyaccount.php',$token),
										// "or insert this into the token field : ",
										"Please paste this token in the text field on the verification page linked below: ",
										$token,
										linkToken('verifyaccount.php',$token),
										"", 
										"Thank You for using Camagru"
										)
								);
		return $message;
	}

	function resetpassword($token, $email)
	{
		$message = createMessage(array	("Your password for ".stringify(getValue("email", $email, "username"))." has been set to : ",
										$token,
										"Thank You for using Camagru"
										)
								);
		return $message;
	}
	function commented($commentor)
	{
		$message = createMessage(array	($commentor." just commented on your image",
										"Thank You for using Camagru"
										)
								);
		return $message;
	}
	function checkUnique($condition,$value)
	{
		global $db;

		$statement = "SELECT * FROM USERS WHERE ".$condition." = ".stringify($value).";";
		$records = $db->returnRecord($statement);
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
				return 8;
		}
		else
			return 9;
	}

?>