<?php
    $servername = "localhost";
    $username  = "root";
    $password = "R00t";
    $dbname = "CAMAGRU";
         try {
            $conn = new PDO("mysql:host=$servername;", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $statement = $conn->prepare("CREATE DATABASE ".$dbname);
            $statement->execute();
            
            try{
                $conn = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $statement = $conn->prepare("CREATE TABLE USERS(username VARCHAR(20) not NULL PRIMARY KEY, fname VARCHAR(20) default 'Mohammed',lname VARCHAR(20) default 'LastNams',email VARCHAR(40) not NULL,`password` VARCHAR(100) not NULL), verified TINYINT(1) NOT NULL DEFAULT '0'");
                $statement->execute();
            }
            catch(PDOException $e)
            {
                echo "Connection failed: " . $e->getMessage()."<br>";
            }
            echo "Connected and created database successfully<br>";
          }
        catch(PDOException $e)
        {
          echo "Connection failed: " . $e->getMessage()."<br>";
        }
        $conn = null;
?>
<!-- <html>
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
</html> -->