<?php // This is the User class for System Tech Software
class Newspaper
{
	// Class variables
	var $connection,
	    $table;
		
	var $id,
		$name,
		$rate,
		$daily,
		$udate,
		$userID;
	
	function Newspaper()
	{
		$this->connection = new Connection();
		$this->table = "Newspaper";
	}
	
	// Class methods
	function setId($value)
	{
		$this->id = $value;
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

	function setRate($value)
	{
		$this->rate = $value;
	}
		
	function getRate()
	{
		return $this->rate;
	}

	function setDaily($value)
	{
		$this->daily = $value;
	}
		
	function getDaily()
	{
		return $this->daily;
	}
	function setDate($value)
	{
		$this->udate = $value;
	}
		
	function getDate()
	{
		return $this->udate;
	}
	
	function setUserID($value)
	{
		$this->userID = $value;
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
		$this->setName($result["name"]);
		$this->setRate($result["rate"]);
		$this->setDaily($result["daily"]);
		$this->setDate($result["udate"]);
		$this->setUserID($result["uidFK"]);
	}
	
	function save($name, $rate, $daily, $uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "insert into $this->table values(0, '$name', '$rate', $daily, '".date("Y-m-d")."', $uid)";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work $this->table. " . mysql_error());
		
        // Close connection
        mysql_close($dbLink);

		return true;
	}
	
	function getNewspapers()
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "select * from $this->table order by id";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work $this->table. " . mysql_error());
		
        // Close connection
        mysql_close($dbLink);
		
		return $results;
	}
	
	function getDailyNewspapers()
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "select * from $this->table where daily=1 order by id";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work $this->table. " . mysql_error());
		
        // Close connection
        mysql_close($dbLink);
		
		return $results;
	}

	function getDatilyTotals($date)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
		$query = "select sum(amount) from $this->table";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work $this->table. " . mysql_error());
		
        // Close connection
        mysql_close($dbLink);
		
		return $results;
	}
}
?>