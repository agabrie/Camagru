<?php
class Db
{
	private $servername ;
	private $username  	;
	private $password	;
	private $dbname 	;
	private $sconn		;
	private $dbconn		;
	
	function __construct($database)
	{
		$this->servername = $database["servername"];
		$this->username = $database["username"];
		$this->password = $database["password"];
		$this->dbname = $database["dbname"];
		echo "db object contructed<br>";	
	}
	
	function createDB()
	{
		 try
		 {
			$this->sconn = new PDO("mysql:host=$this->servername;", $this->username, $this->password);
			$this->sconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$this->runStatement($this->sconn,"CREATE DATABASE IF NOT EXISTS ".$this->dbname);
			echo "db created succesfully <br>";
		 }
		 catch(PDOException $e)
		 {
			echo "Connection failed: " . $e->getMessage()."<br>";
		 }
	}

	function createTABLE($table)
	{
		try
		{
			$this->dbconn = new PDO("mysql:host=$this->servername;dbname=$this->dbname;", $this->username, $this->password);
			$this->dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$statement = "CREATE TABLE  IF NOT EXISTS ".$table["name"];
			$statement = $statement."(";
			$count = 0;
			foreach($table["columns"] as $column)
			{
				if ($count != 0)
					$statement = $statement.",".$column;
				else
					$statement = $statement.$column;
				$count++;
			}
			$statement = $statement.")";
			$this->runStatement($this->dbconn, $statement);
			echo "Table created successfully<br>";
		}
		catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage()."<br>";
		}
		
	}
	
	function runStatement($pdo,$statement)
	{
		try
		{
			$run = $pdo->prepare($statement);
			$run->execute();
			echo "Succesfully ran statement<br>";
		}
		catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage()."<br>";
		}
	}
	
	function closeConnections()
	{
		$this->sconn = null;
		$this->dbconn = null;
	}
}

$db = new Db(array("servername"=>"localhost", "username"=>"root","password"=>"R00t","dbname"=>"CAMAGRU"));
$db->createDB();
$db->createTABLE(array(	"name"=>"USERS",
						"columns"=>array(	"username VARCHAR(20) not NULL PRIMARY KEY",
											"fname VARCHAR(20) default 'Mohammed'",
											"lname VARCHAR(20) default 'LastNams'",
											"email VARCHAR(40) not NULL",
											"`password` VARCHAR(100) not NULL",
											"verified TINYINT(1) NOT NULL DEFAULT '0'",
											"gallery INT(11) NOT NULL default '0'"
										)
						));

// $db->closeConnnections();
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