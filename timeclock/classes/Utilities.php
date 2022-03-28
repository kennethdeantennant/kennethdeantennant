<?php // This is the User class for Frazier Industrial
class Utilities
{
	// Class variables
	var $connection;
		
	var	$dbHost,
        $dbUser,
        $dbName,
        $dbPass,
		$host;
	
	function Utilities()
	{
		$this->connection = new Connection();
	}
	
	// Class methods
	// Retrieves a list of dates based upon the earliest date in the frzrtimesheet table
	function getDates($date)
	{
        // Connect to database
		$dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Get data
		$query = "select min(pdate) as pdate from frzrtimesheet";
		
		$results = mysql_query($query);
		// Test to make sure query worked
        if(!$results) die("Query didn't work. [getDates] utilities " . mysql_error());
        
        // Test to make sure query worked
		$result = mysql_fetch_array($results);	
        mysql_close($dbLink);
		
        $month = date("m", strtotime($result["pdate"]));
		$day = date("d", strtotime($result["pdate"]));
		$year = date("Y", strtotime($result["pdate"]));
		$dayOfWeek = date("w", strtotime($result["pdate"]));
		$date = date("Y-m-d", mktime(0, 0, 0, $month, $day-$dayOfWeek, $year));
		$index = 0;
		$array;
		while ($date <= date("Y-m-d")){
			$array[$index] = $date;
			$month = date("m", strtotime($date));
			$day = date("d", strtotime($date));
			$year = date("Y", strtotime($date));
			$date = date("Y-m-d", mktime(0, 0, 0, $month, $day+7, $year));
			$index+=1;
		}
		
		return $array;
	}
	
	// Export to Excel
	function getEntries($sdate)
	{
        // Connect to database
		$dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		$month = date("m", strtotime($sdate));
		$day = date("d", strtotime($sdate));
		$year = date("Y", strtotime($sdate));
		$date = date("Y-m-d", mktime(0, 0, 0, $month, $day+7, $year));
		
		// Get data
		$query = "select * from frzrtimesheet where pdate>'$sdate' and pdate<='$date'";
		
		$results = mysql_query($query);
		// Test to make sure query worked
        if(!$results) die("Query didn't work. [getEntries] utilities " . mysql_error());
        
        mysql_close($dbLink);
		
		return $results;
	}
}
?>