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
    "imageName",
    "userID"
);

$table = array(
    "name"      => "images",
    "columns"   => $fields
);
echo $stuff["picname"];
$values = array(
                stringify($stuff["pikcha"]),
                stringify($stuff["picname"]),
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
// header("Location: index.php");
?>