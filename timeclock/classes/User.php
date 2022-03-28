<?php // This is the User class for Frazier Industrial
class User
{
	// Class variables
	var $connection;
		
	var $userId,
		$userName,
		$userPassword,
		$userFullname,
		$userAuthority,
		$userStatus,
		$pdate,
		$ptime,
		$uid_fk,
		$logged,
		$dbHost,
        $dbUser,
        $dbName,
        $dbPass,
        $dbUserTable,
		$host;
	
	function User()
	{
		$this->connection = new Connection();
		$this->dbUserTable = "frzrpeople";
	}
	
	// Class methods
	function setId($id)
	{
		$this->userId = $id;
	}
		
	function getId()
	{
		return $this->userId;
	}

	function setName($userName)
	{
		$this->userName = $userName;
	}
		
	function getName()
	{
		return $this->userName;
	}
	
	function setPassword($userPassword)
	{
		$this->userPassword = $userPassword;
	}
		
	function getPassword()
	{
		return $this->userPassword;
	}
	
	function setFullname($fullname)
	{
		$this->userFullname = $fullname;
	}
		
	function getFullname()
	{
		return $this->userFullname;
	}
	
	function setAuthority($authority)
	{
		$this->userAuthority = $authority;
	}
		
	function getAuthority()
	{
		return $this->userAuthority;
	}
	
	function setStatus($status)
	{
		$this->userStatus = $status;
	}
		
	function getStatus()
	{
		return $this->userStatus;
	}
	
	function setDate($pdate)
	{
		$this->pdate = $pdate;
	}
		
	function getDate()
	{
		return $this->pdate;
	}
	
	function setTime($ptime)
	{
		$this->ptime = $time;
	}
		
	function getTime()
	{
		return $this->ptime;
	}
	
	function setUId_fk($uid_fk)
	{
		$this->uid_fk = $uid_fk;
	}
		
	function getUId_fk()
	{
		return $this->uid_fk;
	}
	
	function setLogged($logged)
	{
		$this->logged = $logged;
	}
		
	function getLogged()
	{
		return $this->logged;
	}
	
    function update($id, $type, $uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Insert record
		$date = date("Y-m-d");
		$hour = date("H")+1;
		$minute = date("i");
		$second = date("s");
		$time = $hour.":".$minute.":".$second;
		
		switch($type)
		{
			case "fullname":
				$query = "update $this->dbUserTable set fullname = '$this->userFullname', pdate = '$date', ptime = '$time', uid_fk = $uid where id = $id";
				break;
			case "username":
				$query = "update $this->dbUserTable set username = '$this->userName', pdate = '$date', ptime = '$time', uid_fk = $uid where id = $id";
				break;
			case "password":
				$query = "update $this->dbUserTable set password = '$this->userPassword', pdate = '$date', ptime = '$time', uid_fk = $uid where id = $id";
				break;
		}
		$results = mysql_query($query);

        // Test to make sure query worked
        if(!$results) die("Query didn't work. $this->dbUserTable " . mysql_error());

        // Close database connection
        mysql_close($dbLink);
		
		return true;
    }
	
    function save($username, $fullname, $password, $basic, $uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Insert record
		$date = date("Y-m-d");
		$hour = date("H")+1;
		$minute = date("i");
		$second = date("s");
		$time = $hour.":".$minute.":".$second;
		$query = "insert into $this->dbUserTable (username, password, fullname, authority, status, pdate, ptime, uid_fk) values('$username', '$password', '$fullname', '$basic', '', '$date', '$time', $uid)";
		$results = mysql_query($query);

        // Test to make sure query worked
        if(!$results) die("Query didn't work. $this->dbUserTable " . mysql_error());

        // Close database connection
        mysql_close($dbLink);
		
		return true;
    }
	
    function remove($id)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Insert record
		$query = "update $this->dbUserTable set status='I' where id=$id";
		$results = mysql_query($query);

        // Test to make sure query worked
        if(!$results) die("Query didn't work. $this->dbUserTable " . mysql_error());

        // Close database connection
        mysql_close($dbLink);
		
		return true;
    }
	
    function verifyPassword()
	{
		$this->logged = false;
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
        $query = "select password from $this->dbUserTable where status='' and username = \"$this->userName\"";
		$result = mysql_query($query);
        
        // Test to make sure query worked
        if(!$result) die("Query didn't work. " . mysql_error());

        // Test to make sure query worked
        if(mysql_num_rows($result)==0) return false;

        // Get the password from the database
        $actualPassword = mysql_result($result, 0);

        // Close database connection
        mysql_close($dbLink);
		
        // Verify that they match
        if(!($actualPassword == $this->userPassword)) return false;

		$this->load();		
		return true;

    } // End verifyPassword()

    function displayUserInfo()
	{
		echo '<b>User ID: </b>' . $this->userId . '<br />';
        echo '<b>User Name: </b>' . $this->userName . '<br />';
        echo '<b>User Password: </b>' . $this->userPassword . '<br />';
        echo '<b>User Full Name: </b>' . $this->userFullname . '<br />';
    } // End displayUserInfo()
	
	function load()
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
        $query = "select * from $this->dbUserTable where username = \"$this->userName\" and password = \"$this->userPassword\"";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work. " . mysql_error());

        // Test to make sure query worked
        if(mysql_num_rows($results)==0) return false;

        // Load the information from the table
		$result = mysql_fetch_array($results);
        $this->setId($result[0]);
        $this->setName($result[1]);
        $this->setPassword($result[2]);
		$this->setFullname($result[3]);
		$this->setAuthority($result[4]);
		$this->setStatus($result[5]);
		$this->setDate($result[6]);
		$this->setTime($result[7]);
		$this->setUId_fk($result[8]);
		$this->setLogged(true);
		
        // Close database connection
        mysql_close($dbLink);
	}
	
	function reload($id)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
        $query = "select * from $this->dbUserTable where id = $id";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work. " . mysql_error());

        // Test to make sure query worked
        if(mysql_num_rows($results)==0) return false;

        // Load the information from the table
		$result = mysql_fetch_array($results);
        $this->setId($result[0]);
        $this->setName($result[1]);
        $this->setPassword($result[2]);
		$this->setFullname($result[3]);
		$this->setAuthority($result[4]);
		$this->setStatus($result[5]);
		$this->setDate($result[6]);
		$this->setTime($result[7]);
		$this->setUId_fk($result[8]);
		$this->setLogged(true);
		
        // Close database connection
        mysql_close($dbLink);
	}
		
	function getEmployees()
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Get data
        $query = "select * from $this->dbUserTable where status='' order by fullname";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work. " . mysql_error());

        // Test to make sure query worked
        if(mysql_num_rows($results)==0) return false;

        // Load the information from the table
		return $results;
	}
}
?>