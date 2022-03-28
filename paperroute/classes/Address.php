<?php // This is the User class for System Tech Software
class Address
{
	// Class variables
	var $connection,
	    $table;
		
	var $id,
		$number,
		$street,
		$aparment,
		$city,
	    $state,
		$zip,
		$latitude,
		$longitude,
		$udate,
		$use,
		$status,
		$userID,
		$fullAddress;
	
	function Address()
	{
		$this->connection = new Connection();
		$this->table = "Address";
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

	function setStreetNumber($number)
	{
		$this->number = $number;
	}
		
	function getStreetNumber()
	{
		return $this->number;
	}

	function setStreet($street)
	{
		$this->street = $street;
	}
		
	function getStreet()
	{
		return $this->street;
	}

	function setApartment($apt)
	{
		$this->apartment = $apt;
	}
		
	function getApartment()
	{
		return $this->apartment;
	}

	function setCity($city)
	{
		$this->city = $city;
	}
		
	function getCity()
	{
		return $this->city;
	}	
	
	function setState($state)
	{
		$this->state = $state;
	}
		
	function getState()
	{
		return $this->state;
	}
	
	function setZip($zip)
	{
		$this->zip = $zip;
	}
		
	function getZip()
	{
		return $this->zip;
	}
	
	function setLatitude($l)
	{
		$this->latitude = $l;
	}
		
	function getLatitude()
	{
		return $this->latitude;
	}
	
	function setLongitude($l)
	{
		$this->Longitude = $l;
	}
		
	function getLongitude()
	{
		return $this->Longitude;
	}
	
	function setDate($date)
	{
		$this->udate = $date;
	}
		
	function getDate()
	{
		return $this->udate;
	}
	
	function setUserID($id)
	{
		$this->userID = $id;
	}
		
	function getUserID()
	{
		return $this->id;
	}
	
	function setUse($use)
	{
		$this->use = $use;
	}
		
	function getUse()
	{
		return $this->use;
	}
	
	function setStatus($status)
	{
		$this->status = $status;
	}
		
	function getStatus()
	{
		return $this->status;
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
		$this->setStreetNumber($result["number"]);
		$this->setStreet($result["street"]);
		$this->setCity($result["city"]);
		$this->setState($result["state"]);
		$this->setZip($result["zip"]);
		$this->setLatitude($result["lat"]);
		$this->setLongitude($result["lng"]);
		$this->setDate($result["udate"]);
		$this->setUse($result["use"]);
		$this->setStatus($result["status"]);
		$this->setUserID($result["uidFK"]);
	}
	
	function save($number, $street, $apartment, $city, $state, $zip, $uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "insert into $this->table values(0, '$number', '$street', '$apartment', '$city', '$state', 0,0,'$zip', '".date("Y-m-d")."', 'pr', 1, $uid)";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Save query didn't work $this->table. " . mysql_error());
		
        // Close connection
        mysql_close($dbLink);

		return true;
	}
	
	function updateGEO($id, $lat, $lng)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "update $this->table set lat=$lat, lng=$lng where id=$id";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Update GEO query didn't work $this->table. " . mysql_error());
		
        // Close connection
        mysql_close($dbLink);

		return true;
	}
	
	function retire($id)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "update $this->table set status='0' where id=$id";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Retire query didn't work $this->table. " . mysql_error());
		
        // Close connection
        mysql_close($dbLink);

		return true;
	}
	
	function activate($id)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "update $this->table set status='1' where id=$id";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Activate query didn't work $this->table. " . mysql_error());
		
        // Close connection
        mysql_close($dbLink);

		return true;
	}
	
	function getAddresses($uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "select * from $this->table where uidFK=$uid order by street, number, apartment";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Addresses query didn't work $this->table. " . mysql_error());
		
        // Close connection
        mysql_close($dbLink);
		
		return $results;
	}
	
	function getAll($uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "select * from $this->table where `use`='pr' and status='1' and uidFK=$uid order by id";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("All query didn't work $this->table. " . mysql_error());
		
        // Close connection
        mysql_close($dbLink);
		
		return $results;
	}
	
	function getAllNotGeoCode()
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "select * from $this->table where lat=0 and lng=0";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("All GEO query didn't work $this->table. " . mysql_error());
		
        // Close connection
        mysql_close($dbLink);
		
		return $results;
	}
}
?>