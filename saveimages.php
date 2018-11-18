<?php
include('header.php');
session_start();
// include("config.php");
$headers = getallheaders();
if ($headers["Content-type"] == "application/json") {
    $stuff = json_decode(file_get_contents("php://input"), true);
    // var_dump($stuff);
$fields = array(
    "image",
    "userID"
);

$table = array(
    "name"      => "images",
    "columns"   => $fields
);

$values = array(
                stringify($stuff["pikcha"]),
                getValue($_SESSION["username"], "userId")
                // "1"
);
$record = array (
                "table"     => $table,
                "values"    => $values
                );
// print_r($stuff);
// echo $_SESSION["username"]."<br>".getValue($_SESSION["username"], "userId");
$db->insertRecord($record);
}
?>