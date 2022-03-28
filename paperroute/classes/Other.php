<?php // This is the User class for System Tech Software
class Other
{
	// Class variables
	var $connection,
	    $table;
		
	var $id,
		$number,
		$rate,
		$udate,
		$userID;
	
	function Other()
	{
		$this->connection = new Connection();
		$this->table = "Other";
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

	function setNumber($number)
	{
		$this->number = $number;
	}
		
	function getNumber()
	{
		return $this->number;
	}
	
	function setRate($rate)
	{
		$this->rate = $rate;
	}
		
	function getRate()
	{
		return $this->rate;
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
		$this->user = $id;
	}
		
	function getUserID()
	{
		return $this->userID;
	}
		
	function save($number, $nid, $date, $uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "insert into $this->table values(0, $number, $nid, '$date', $uid)";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Save query didn't work $this->table. " . mysql_error());
		
        // Close connection
        mysql_close($dbLink);

		return true;
	}
	
	function delete($id, $uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "delete from $this->table where id=$id and uidFK=$uid";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Delete query didn't work $this->table. " . mysql_error());
		
        // Close connection
        mysql_close($dbLink);

		return true;
	}
	
	function find($date, $nid, $uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "select * from $this->table where udate='$date' and nidFK=$nid and uidFK=$uid";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work $this->table. " . mysql_error());
		
		if(mysql_num_rows($results)==0) return null;
		
		$result = mysql_fetch_array($results);

		// Close connection
        mysql_close($dbLink);

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
		$query = "select * from $this->table where udate='$date'";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work $this->table. " . mysql_error());
		
		if(mysql_num_rows($results)==0) return null;
		
		$total = 0;
		$temp = 0;
		while($results && $result = mysql_fetch_array($results))
		{
			$newspaper = new Newspaper();
			$newspaper->load($result["nidFK"]);
			$total += $newspaper->getRate() * $result["number"];
		}

		// Close connection
		mysql_close($dbLink);

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
		$query = "select * from $this->table where udate='$date'";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work $this->table. " . mysql_error());
		
		if(mysql_num_rows($results)==0) return null;
		$result = mysql_fetch_array($results);
		
        // Close connection
        mysql_close($dbLink);
		return $result["number"];
	}

}
?>