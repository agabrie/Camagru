<?php
include('header.php');
// session_start();
// include("config.php");
$headers = getallheaders();
if ($headers["Content-type"] == "application/json") {
	$stuff = json_decode(file_get_contents("php://input"), true);
	var_dump($stuff);
	$fields = array("comment", "imageID", "userID");
	$table = array("name" => "comments", "columns" => $fields);
	$values = array(stringify($stuff["comments"]), stringify($stuff["image"]), $stuff["commentor"]);
	$record = array("table"=>$table, "values" =>$values);
	$db->insertRecord($record);
}
?>