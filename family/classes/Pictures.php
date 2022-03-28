<?php // This is the User class for System Tech Software
class Pictures extends Connection{
	// Class variables
	var $table = "Pictures";
		
	var $id;
	var $category;
	var $subcategory;
	var $title;
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

	function setCategory($value)
	{
		$this->category = $value;
	}
		
	function getCategory()
	{
		return $this->category;
	}
	
	function setSubcategory($value)
	{
		$this->subcategory = $value;
	}
		
	function getSubcategory()
	{
		return $this->subcategory;
	}

	function setTitle($value)
	{
		$this->title = $value;
	}
		
	function getTitle()
	{
		return $this->title;
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
		$this->setCategory($this->fetch("1"));
		$this->setSubcategory($this->fetch("2"));
		$this->setTitle($this->fetch("3"));
		$this->setName($this->fetch("4"));
	}
    
}
?>