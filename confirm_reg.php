<?php
	session_start();
	// includes Db instance, stringify() function and sendMail() function
	include_once("config.php");
	/*************************** Insert new record into Database **************************/
	// create token for verification
	$token = hash("whirlpool", $_SESSION["username"].$_SESSION["email"]);
	error_log($token);
	// columns needed to insert values into database
	$columns	= array	(
						"username",
						"fname",
						"lname",
						"email",
						"password",
						"verified",
						"galleryId",
						"token"
						);
	// information of tables
	$table 		= array	(
						"name"		=>"USERS",
						"columns"   =>$columns
						);
	// values to inserted into table
	$values		= array	(
						stringify($_SESSION["username"]),
						stringify($_SESSION["fname"]),
						stringify($_SESSION["lname"]),
						stringify($_SESSION["email"]),
						stringify($_SESSION["passwrd"]),
						'0',
		 				'0',
						stringify($token)
						);
	// call from database to insert record
	$db->insertRecord	(
						array	(
								"table"     =>$table,
								"values"	=>$values
								)
						);

	/************************* Send email to user's email address **********************/
	// headers required for sending mail
	$headers = array	(
						"From"=>"noreply@localhost.co.za",
						"Reply-To"=>"noreply@localhost.co.za",
						"X-Mailer"=>"PHP/".phpversion()
						);
	$message = verifyemail($token);
	// call to send mail function from config.php
	$mail = array	(
					"to"=>		getValue("username",$_SESSION["username"], "email"),
					"subject"=>	"Camagru account Verification needed",
					"message"=>	$message
					);
	sendMail($mail);
	/**************************** Redirect to home page ******************************/
	header("Location: edit.php");
?>