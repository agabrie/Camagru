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
		$this->sconn = new PDO("mysql:host=$this->servername;", $this->username, $this->password);
		$this->sconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->createDB();
		$this->dbconn = new PDO("mysql:host=$this->servername;dbname=$this->dbname;", $this->username, $this->password);
		$this->dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// echo "db object contructed<br>";	
	}
	
	function createDB()
	{
		 try
		 {	
			$this->runStatement($this->sconn,"CREATE DATABASE IF NOT EXISTS ".$this->dbname);
			// echo "db created succesfully <br>";	
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
			// echo "Table created successfully<br>";
		}
		catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage()."<br>";
		}
		
	}
	function getDBConn()
	{
		return ($this->dbconn);
	}

	function runStatement($pdo,$statement)
	{
		try
		{
			// echo $statement.PHP_EOL;
			$run = $pdo->prepare($statement);
			$return = $run->execute();
			//print_r($return);
			//  echo "Succesfully ran statement<br>";
			return($return);
		}
		catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage()."<br>";
		}
	}
	
	function closeConnections()
	{
		$this->sconn	= null;
		$this->dbconn	= null;
	}

	function returnRecord($statement)
	{
		echo "somrthing";
		$something = $this->runStatement($this->dbconn, $statement);
		return($something);
	}
	function insertRecord($record)
	{
		$count 		= 0;
		$statement 	= "INSERT INTO ".$record["table"]["name"];
		$statement 	= $statement."(";
		foreach($record["table"]["columns"] as $column)
		{
			if($count != 0)
				$statement = $statement.",".$column;
			else
				$statement = $statement.$column;
			$count++;
		}
		$count 		= 0;
		$statement = $statement.") VALUES (";
		foreach($record['values'] as $values)
		{
			if($count != 0)
				$statement = $statement.",".$values;
			else
				$statement = $statement.$values;
			$count++;
		}
		$statement 	= $statement.");";
		echo $statement.PHP_EOL;
		$this->runStatement($this->dbconn, $statement);
	}
}
?>