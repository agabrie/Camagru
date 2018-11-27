<?php
include('header.php');
$headers = getallheaders();
if ($headers["Content-type"] == "application/json") {
	$stuff = json_decode(file_get_contents("php://input"), true);
	var_dump($stuff);
	$fields = array("comment", "imageID", "userID");
	$table = array("name" => "comments", "columns" => $fields);
	$values = array(stringify($stuff["comments"]), stringify($stuff["image"]), $stuff["commentor"]);
	$record = array("table"=>$table, "values" =>$values);
	$db->insertRecord($record);
	$userId = getImageValue("id", $stuff["image"], "userID");
	// echo "userId : ".stringify($userId);
	$username = getValue("userId", $userId, "username");
	// echo "\nusername : ".$username;
	 $emailaddress = getValue("userId", $userId, "email");
	//  echo "email : ".$emailaddress;
	//  echo getValue("username", $username, "verified");
	if(getValue("username", $username, "verified") == '2'){
		$message = commented($username);
		// echo $message;
		$mail = array	(
						"to"=>getValue("username",$username, "email"),
						"subject"=>"Somebody commented on your image on Camagru",
						"message"=>$message
						);
		sendMail($mail);
	}
}
?>