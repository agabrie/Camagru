<?php
	require("install.php");
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
							"userID INT NOT NULL default '0'",
							"`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"
							);
	$db->createTABLE	(
						array	(	"name"=>"IMAGES",
									"columns"=>$imagecolumns
								)
						);
	
	function stringify($string)
	{
		return "'".$string."'";
	}

	function sendMail($mail)
	{
		$to			=	$mail["to"];										//'noreply@localhost.co.za';
		$subject	=	$mail["subject"];									//'Camagru Verify Your Account';
		$message	=	$mail["message"];									//'hello';
		$headers	=	"From: ".$mail["headers"]["from"]."\r\n".			//'From: noreply@localhost.co.za' . "\r\n" .
						"Reply-To: ".$mail["headers"]["Reply-To"]."\r\n".	//'Reply-To: noreply@localhost.co.za' . "\r\n" .
						"X-Mailer: ".$mail["headers"]["X-Mailer"];			//'X-Mailer: PHP/' . phpversion();
	mail($to, $subject, $message/*, $headers*/);
	}

	function createMessage($message)
	{
		$count = 0;

		foreach($message as $paragraph)
		{
			if($count)
				$final = $final."<br>".PHP_EOL;
			$final = $final.$paragraph;
			$count++;
		}
		return($final);
	}
	function linkToken($token)
	{
		return "http://localhost:8080/Camagru/verifyaccount.php?action=get&token=".$token;
	}
	function getValue($name,$value)
	{
		global $db;
		$statement = $statement = "SELECT * FROM USERS WHERE USERNAME = ".stringify($name);
		// echo $statement;
		$records = $db->returnFirstRecord($statement);
		if($records[$value])
		{
			return($records[$value]);
		}
		return("no value returned");
	}
	//$db->closeConnnections();
?>