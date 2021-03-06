<?php

class Db
{
	private $servername ;
	private $username  	;
	private $password	;
	private $dbname 	;
	private $sconn		;
	private $dbconn		;
	private static $gcount;
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
	}
	
	function createDB()
	{
		 try
		 {	
			$this->runStatement($this->sconn,"CREATE DATABASE IF NOT EXISTS ".$this->dbname);
			Self::$gcount = 0;
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
			$statement = "CREATE TABLE IF NOT EXISTS ".$table["name"];
			$statement .= "(";
			$count = 0;
			foreach($table["columns"] as $column)
			{
				if ($count != 0)
					$statement .= ",".$column;
				else
					$statement .= $column;
				$count++;
			}
			$statement .= ")";
			$this->runStatement($this->dbconn, $statement);
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
			$run = $pdo->prepare($statement);
			$return = $run->execute();
			if($return)
				return($run);
			else
				return (0);
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
	function gallerycount()
	{
		return(Self::$gcount++);
	}
	function returnRecord($statement)
	{
		$something = $this->runStatement($this->dbconn, $statement);
		return($something->fetchAll());
	}

	function returnFirstRecord($statement)
	{
		$records = $this->returnRecord($statement);
		return($records[0]);
	}
	
	function insertRecord($record)
	{
		$count 		= 0;
		$statement 	= "INSERT INTO ".$record["table"]["name"];
		$statement 	.= "(";
		foreach($record["table"]["columns"] as $column)
		{
			if($count != 0)
				$statement .= ",".$column;
			else
				$statement .= $column;
			$count++;
		}
		$count 		= 0;
		$statement .= ") VALUES (";
		foreach($record['values'] as $values)
		{
			if($count != 0)
				$statement .= ",".$values;
			else
				$statement .= $values;
			$count++;
		}
		$statement 	.= ");";
		$this->runStatement($this->dbconn, $statement);
	}
	function deletelikeRecord($unlikerID, $imageID)
	{
		$statement = "DELETE FROM likes WHERE userID = $unlikerID AND imageID = $imageID";
		$this->runStatement($this->dbconn,$statement);
	}
}
?>