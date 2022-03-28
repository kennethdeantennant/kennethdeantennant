<?php // This is the User class for System Tech Software
class Daily
{
	// Class variables
	var $connection,
	    $table;
		
	var $id,
		$udate,
		$adressID,
		$newspaperID,
	    $userID;
	
	function Daily()
	{
		$this->connection = new Connection();
		$this->table = "DailyPaperRoute";
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

	function setNewspaperID($id)
	{
		$this->newspaperID = $id;
	}
		
	function getNewspaperID()
	{
		return $this->newspaperID;
	}	
	
	function setUserID($id)
	{
		$this->userID = $id;
	}
		
	function getUserID()
	{
		return $this->id;
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
		$this->setDate($result["ddate"]);
		$this->setAddressID($result["aidFK"]);
		$this->setNewspaperID($result["nidFK"]);
		$this->setUserID($result["uidFK"]);
	}
	
	function save($date, $aid, $nid, $uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "insert into $this->table values(0, '$date', $aid, $nid, $uid)";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work $this->table. " . mysql_error());
		
        // Close connection
        mysql_close($dbLink);

		return true;
	}

	function delete($id)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "delete from $this->table where id=$id";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work $this->table. " . mysql_error());
		
        // Close connection
        mysql_close($dbLink);

		return true;
	}
	
	function deleteByDay($date, $nid, $uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "delete from $this->table where ddate='$date' and nidFK=$nid and uidFK=$uid";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work $this->table. " . mysql_error());
		
        // Close connection
        mysql_close($dbLink);

		return true;
	}
	
	function find($date, $aid, $nid, $uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "select * from $this->table where ddate='$date' and aidFK=$aid and nidFK=$nid and uidFK=$uid";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work $this->table. " . mysql_error());
		
		if(mysql_num_rows($results)==0) return null;
		
        // Close connection
        //mysql_close($dbLink);
		
		$result = mysql_fetch_array($results);

		return $result;
	}
	
	function getAmountTotal($date)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "select * from $this->table where ddate='$date'";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work $this->table. " . mysql_error());
		
		if(mysql_num_rows($results)==0) return null;
		
        // Close connection
		$total = 0;
		$temp = 0;
		while($results && $result = mysql_fetch_array($results))
		{
			$newspaper = new Newspaper();
			$newspaper->load($result["nidFK"]);
			$address = new Address();
			$address->load($result["aidFK"]);
			if($address->getStatus() == true) $total += $newspaper->getRate();
		}

		return $total;
	}

	function getCountTotal($date)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "select count(*) as Counts from $this->table where ddate='$date'";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work $this->table. " . mysql_error());
		
		if(mysql_num_rows($results)==0) return null;
		$result = mysql_fetch_array($results);
		
        // Close connection
        mysql_close($dbLink);

		return $result["Counts"];
	}

}
?>