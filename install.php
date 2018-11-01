<?php
    $servername = "localhost";
    $username = $_POST["username"];
    $password = $_POST["password"];
    if(isset($_POST["btn"]))
    {
         try {
            $conn = new PDO("mysql:host=$servername;", $username, $password);
        //  set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE CAMAGRU";
            $conn->exec($sql);
            echo "Connected and created database successfully";
            // header("Location: server_databases.php");
          }
        catch(PDOException $e)
        {
          echo "Connection failed: " . $e->getMessage();
        }
        $conn = null;
    }
?>
<html>
    <head>
        <title>
            PHP myAdmin Login
        </title>
    </head>
    <body>
        <form action="" method="post">
        <label for="username">USERNAME:</label><br>
            <input type="text" name="username" value="root"><br>
            <label for="password">PASSWORD:</label><br>
            <input type="password" name="password" value=""><br>
            <input type="submit" name="btn" value="login">
        </form>
    </body>
</html>