<?php // This is the User class for System Tech Software
class UserInfo
{
	// Class variables
	var $connection,
	    $table;
		
	var $id,
		$fname,
		$mname,
		$lname,
	    $phone,
		$altPhone,
		$udate,
		$addressID,
		$logonID;
	
	function UserInfo()
	{
		$this->connection = new Connection();
		$this->table = "UserInfo";
	}
	
	// Class methods
	function setId($id)
	{
		$this->id = $id;
	}
		
	function getId()
	{
		return $this->id;
	}

	function setFirstName($first)
	{
		$this->fname = $first;
	}
		
	function getFirstName()
	{
		return $this->fname;
	}

	function setMiddleName($middle)
	{
		$this->mname = $middle;
	}
		
	function getMiddleName()
	{
		return $this->mname;
	}

	function setLastName($last)
	{
		$this->lname = $last;
	}
		
	function getLastName()
	{
		return $this->lname;
	}	
	
	function setPhone($phone)
	{
		$this->phone = $phone;
	}
		
	function getPhone()
	{
		return $this->phone;
	}
	
	function setAltPhone($phone)
	{
		$this->altPhone = $phone;
	}
		
	function getAltPhone()
	{
		return $this->altPhone;
	}
		
	function setDate($date)
	{
		$this->udate = $date;
	}
		
	function getDate()
	{
		return $this->udate;
	}
		
	function setAddressID($id)
	{
		$this->addressID = $id;
	}
		
	function getAddressID()
	{
		return $this->addressID;
	}
		
	function setLogonID($id)
	{
		$this->logonID = $id;
	}
		
	function getLogonID()
	{
		return $this->logonID;
	}
	
	function getName()
	{
		return trim($this->fname)." ".trim($this->lname);
	}
		
	function load($uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
        $query = "select * from $this->table where Id = ".$uid;
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Load didn't work for $this->table. " . mysql_error());

        // Test to make sure query worked
        if(mysql_num_rows($results)==0) return false;

        // Load the information from the table
		$result = mysql_fetch_array($results);
		$this->setId($result["id"]);
		$this->setFirstName($result["firstName"]);
		$this->setMiddleName($result["middleName"]);
		$this->setLastName($result["lastName"]);
		$this->setPhone($result["phoneNumber"]);
		$this->setAltPhone($result["altPhoneNumber"]);
		$this->setDate($result["udate"]);
		$this->setAddressID($result["aidFK"]);
		$this->setLogonID($result["lidFK"]);
	}
}
?>