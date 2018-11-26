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
	$userId = stringify(getImageValue("id", $stuff["image"], "userID"));
	echo "userId : ".$userId;
	$username = getValue("userId", stringify($userId), "username");
	echo "\nusername : ".$username;
	// $emailaddress = getValue("userId", stringify($userId), "email");
	if(getValue("username", $username, "verified") == '2'){
	$message = commented($username);
	$mail = array	(
					"to"=>getValue("username",$username, "email"),
					"subject"=>"Somebody commented on your image on Camagru",
					"message"=>$message
					);
	sendMail($mail);
	}
}
?>