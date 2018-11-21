<?php
include('header.php');
// session_start();
// include("config.php");
$headers = getallheaders();
if ($headers["Content-type"] == "application/json") {
	$stuff = json_decode(file_get_contents("php://input"), true);
	var_dump($stuff);
	if(isset($stuff["likerID"]))
	{
		$fields = array("userID", "imageID");
		$table = array("name" => "likes", "columns" => $fields);
		$values = array(stringify($stuff["likerID"]), stringify($stuff["imageID"]));
		$record = array("table"=>$table, "values" =>$values);
		$db->insertRecord($record);
	}else
	{
		// $values = array(stringify($stuff["unlikerID"]), stringify($stuff["imageID"]));
		// $record = array("table"=>$table, "values" =>$values);

		$db->deletelikeRecord($stuff["unlikerID"], $stuff["imageID"]);
	}
}
?>