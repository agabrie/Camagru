<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    try {
        $conn = new PDO("mysql:host=$servername;", $username, $password);
    // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE CAMAGRU";
        $conn->exec($sql);
        echo "Connected and created database successfully"; 
        }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
?>