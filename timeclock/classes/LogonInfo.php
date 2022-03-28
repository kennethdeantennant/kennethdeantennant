<?php // This is the User class for System Tech Software
class LogonInfo
{
	// Class variables
	var $connection,
	    $table;
		
	var $id,
		$username,
		$password,
		$status,
		$userID,
		$logonID;
	
	function LogonInfo()
	{
		$this->connection = new Connection();
		$this->table = "LogonInfo";
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

	function setUsername($username)
	{
		$this->username = $username;
	}
		
	function getUsername()
	{
		return $this->username;
	}
	
	function setPassword($password)
	{
		$this->password = $password;
	}
		
	function getPassword()
	{
		return $this->password;
	}
	
	function setStatus($status)
	{
		$this->status = $status;
	}
		
	function getStatus()
	{
		return $this->status;
	}
	
	function setUser($user)
	{
		$this->user = $user;
	}
		
	function getUser()
	{
		return $this->user;
	}
		
	function setAddress($address)
	{
		$this->address = $address;
	}
		
	function getAddress()
	{
		return $this->address;
	}
		
	function setUserID($id)
	{
		$this->id = $id;
	}
		
	function getUserID()
	{
		return $this->id;
	}

    function verifyPassword($name, $password)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
        $query = "select * from $this->table where status='1' and username = '$name' and password = '".MD5($password)."'";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work $this->table. " . mysql_error());

        // Test to make sure query worked
        if(mysql_num_rows($results)==0) return false;

        // Get the password from the database
		$result = mysql_fetch_array($results);
        $actualPassword = $result["password"];

        // Close database connection
        mysql_close($dbLink);
		
        // Verify that they match
        if($actualPassword != MD5($password)) return false;

		// Load object
		$this->setId($result["id"]);
		$this->setUserId($result["uidFK"]);
		
		return true;

    } // End verifyPassword()
}
?>