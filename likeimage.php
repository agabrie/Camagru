<?php
include('header.php');
$headers = getallheaders();
if ($headers["Content-type"] == "application/json") {
	$stuff = json_decode(file_get_contents("php://input"), true);
	var_dump($stuff);
	if($stuff["liked"])
	{
		$fields = array("userID", "imageID");
		$table = array("name" => "likes", "columns" => $fields);
		$values = array(stringify($stuff["liker"]), stringify($stuff["image"]));
		$record = array("table"=>$table, "values" =>$values);
		print_r($record);
		$db->insertRecord($record);
	}else
	{
		$db->deletelikeRecord($stuff["liker"], $stuff["image"]);
	}
}
?>