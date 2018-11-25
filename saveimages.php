<?php
include('header.php');
session_start();
$headers = getallheaders();
if ($headers["Content-type"] == "application/json") {
    $stuff = json_decode(file_get_contents("php://input"), true);
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
                    stringify($stuff["pic"]),
                    stringify($stuff["picname"]),
                    getValue("username",$_SESSION["username"], "userId")
    );
    $record = array (
                    "table"     => $table,
                    "values"    => $values
                    );
    $db->insertRecord($record);
}
?>