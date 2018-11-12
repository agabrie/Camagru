<?php
	session_start();
	// includes Db instance, stringify() function and sendMail() function
	include_once("config.php");
	/*************************** Insert new record into Database **************************/
	// create token for verification
	$token = hash("whirlpool", $_SESSION["username"].$_SESSION["email"]);
	// echo $token;
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
						'0',											/*$db->gallerycount()*/
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
						"From"=>"",
						"Reply-To"=>"",
						"X-Mailer"=>""
						);
	$message = createMessage(array("Thank You for regstering with Camagru", "To activate your account please click on the link below.",linkToken($token),"or insert this into the token field:", $token, "Thank You for using Camagru"));
	echo $message;
	// call to send mail function from config.php
	// sendMail(
	// 			array	(
	// 					"to"=>"",
	// 					"subject"=>"",
	// 					"message"=>"",
	// 					"headers"=>$headers
	// 				)
	// 		);
	/**************************** Redirect to home page ******************************/
	// header("Location: index.php");
?>