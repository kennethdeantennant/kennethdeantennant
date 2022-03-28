<?php
class BiographyFamily extends Connection{
	// Class variables
	var $table = "BiographyFamily";
		
	var $id;
	var $name;
	
	// Class methods
	function setId($id)
	{
		$this->id = $id;
	}
		
	function getId()
	{
		return $this->id;
	}

	function setName($value)
	{
		$this->name = $value;
	}
		
	function getName()
	{
		return $this->name;
	}
			
	function load($id)
	{
        //Connect
        $this->connect();

        //Create and execute query
        $query = "select * from $this->table where Id = ".$id;
		$results = $this->select($query);
        
        //Disconnect
        $this->disconnect();

		$this->setId($this->fetch("0"));
		$this->setName($this->fetch("1"));
	}
			
	function getFamilies()
	{
        //Connect
        $this->connect();

        //Create and execute query
        $query = "SELECT * FROM $this->table ORDER BY Id";
		$results = $this->select($query);
        
        //Disconnect
        $this->disconnect();

		return $this->fetchResults();
	}
	
}
?>