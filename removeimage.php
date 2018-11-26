<?php
include("header.php");
$headers = getallheaders();
if ($headers["Content-type"] == "application/json") {
	$stuff = json_decode(file_get_contents("php://input"), true);
	$statement = "DELETE FROM images WHERE id = ".stringify($stuff);
	// echo $statement;
	$db->runStatement($db->getDBConn(), $statement);
}
?>