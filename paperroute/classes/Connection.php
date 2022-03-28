<?php // This is the user class for System Tech Software
class Connection
{
	// Class variables
	var	$dbHost,
        $dbUser,
        $dbName,
        $dbPass;
	
	function Connection()
	{
		//$this->dbHost = "localhost";
		//$this->dbUser = "root";
		//$this->dbName = "mysql";
		//$this->dbPass = "";
		$this->dbHost = "localhost";
		$this->dbUser = "kentenna_kt";
		$this->dbName = "kentenna_db";
		$this->dbPass = "Esnack212!";
	}
	
	function getHost()
	{
		return $this->dbHost;
	}
	
	function getUser()
	{
		return $this->dbUser;
	}
	
	function getName()
	{
		return $this->dbName;
	}
	
	function getPass()
	{
		return $this->dbPass;
	}
	
	function getDb()
	{
		$connect = mysql_connect($this->dbHost,$this->dbUser,$this->dbPass);
        if(!$connect) die("Could not connect to database. " . mysql_error());
		return mysql_select_db($this->dbName);
	}
}
?>