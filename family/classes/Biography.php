<?php
class Biography extends Connection{
	// Class variables
	var $table = "Biography";
    
    private var $connection;
		
	private var $id;
	private var $name;
	private var $text;
    private var $family_id;
	private var $author;
	private var $picture;
	private var $link;
	
	// Class methods
	function setId($id){
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
	
	function setText($value)
	{
		$this->text = $value;
	}
		
	function getText()
	{
		return $this->text;
	}

	function setFamilyID($value)
	{
		$this->family_id = $value;
	}
		
	function getFamilyID()
	{
		return $this->family_id;
	}

	function setAuthor($value)
	{
		$this->author = $value;
	}
		
	function getAuthor()
	{
		return $this->author;
	}
		
	function setPicture($value)
	{
		$this->picture = $value;
	}
		
	function getPicture()
	{
		return $this->picture;
	}
		
	function setLink($value)
	{
		$this->link = $value;
	}
		
	function getLink()
	{
		return $this->link;
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
		$this->setText($this->fetch("2"));
		$this->setFamilyID($this->fetch("3"));
		$this->setAuthor($this->fetch("4"));
		$this->setPicture($this->fetch("5"));
		$this->setLink($this->fetch("6"));
	}
	
	function getIndividualID($family){
        //Connect
        $this->connect();

        //Create and execute query
		if($family==0){
			$query = "SELECT Id,name FROM $this->table ORDER BY famId,name";
		}else{
			$query = "SELECT Id,name FROM $this->table WHERE famId=$family ORDER BY name";
		}
		$results = $this->select($query);
        
        //Disconnect
        $this->disconnect();

		return $this->fecth("0");
	}
	
	function getAllBiographies($family, $individual){
        //Connect
        $this->connect();

        //Create and execute query
		$query = "SELECT * FROM $this->table WHERE famId>$family and Id<>$individual ORDER BY famId,name";
		$results = $this->select($query);
        
        //Disconnect
        $this->disconnect();

        return $this->fetchResults();
	}
	
	function getBiographies($family, $individual){
        //Connect
        $this->connect();

        //Create and execute query
		$query = "SELECT * FROM Biography WHERE famId=$family and Id<>$individual ORDER BY famId,name";
		$results = $this->select($query);
        
        //Disconnect
        $this->disconnect();

        return $this->fetchResults();
	}
	
}
?>