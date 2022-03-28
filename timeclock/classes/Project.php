<?php // This is the User class for Frazier Industrial
class Project
{
	// Class variables
	var $connection;
		
	var $id,
		$name,
		$pdate,
		$ptime,
		$uid_fk,
		$status,
		$dbHost,
        $dbUser,
        $dbName,
        $dbPass,
        $dbUserTable,
		$host;
	
	function Project()
	{
		$this->connection = new Connection();
		$this->dbUserTable = "frzrproject";
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

	function setName($name)
	{
		$this->name = $name;
	}
		
	function getName()
	{
		return $this->name;
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
	
	function setStatus($status)
	{
		$this->status = $status;
	}
		
	function getStatus()
	{
		return $this->status;
	}
	
	function load($pid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
        $query = "select * from $this->dbUserTable where id=$pid";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work. [load] " . mysql_error());

        // Test to make sure query worked
        if(mysql_num_rows($results)==0) return false;

        // Load the information from the table
		$result = mysql_fetch_array($results);
        $this->setId($result[0]);
        $this->setName($result[1]);
		$this->setDate($result[2]);
		$this->setTime($result[3]);
		$this->setUId_fk($result[4]);
		$this->setStatus($result[5]);
		
        // Close database connection
        mysql_close($dbLink);
		
		return true;
	}
		
    function save($name, $uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Insert record
		$date = date("Y-m-d");
		$time = date("H:i:s");
		$query = "insert into $this->dbUserTable (name, pdate, ptime, uid_fk) values('$name', '$date', '$time', $uid)";
		$results = mysql_query($query);

        // Test to make sure query worked
        if(!$results) die("Query didn't work. [save] $this->dbUserTable " . mysql_error());

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
        if(!$results) die("Query didn't work. [remove] $this->dbUserTable " . mysql_error());

        // Close database connection
        mysql_close($dbLink);
		
		return true;
    }
		
	function getAssignedProjects($tid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Get data
		$aProject="";
		$myCounter=0;
		$projects = mysql_query("select * from frzrprotime where fk_tid=$tid");
		$rows = mysql_num_rows($projects);
		while($projects && $projectList = mysql_fetch_array($projects))
		{
			$myCounter+=1;
			$singleProject = $projectList["fk_pid"];
			if($myCounter!=$rows){
				$aProject=$aProject.$singleProject.",";
			}else{
				$aProject=$aProject.$singleProject;
			}
		}
		
		if($aProject != "")
		{
			$query = "select * from $this->dbUserTable where status='' and name<>'' and id in ($aProject) order by name";
			$results = mysql_query($query);
			
			// Test to make sure query worked
			if(!$results) die("Query didn't work. [getAssignedProjects] " . mysql_error());

			// Test to make sure query worked
			if(mysql_num_rows($results)==0) return false;
		}

        // Load the information from the table
		return $results;
	}
		
	function getUnassignedProjects($tid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Get data
		$aProject="";
		$myCounter=0;
		$projects = mysql_query("select * from frzrprotime where fk_tid=$tid");
		$rows = mysql_num_rows($projects);
		while($projects && $projectList = mysql_fetch_array($projects))
		{
			$myCounter+=1;
			$singleProject = $projectList["fk_pid"];
			if($myCounter!=$rows){
				$aProject=$aProject.$singleProject.",";
			}else{
				$aProject=$aProject.$singleProject;
			}
		}
		
		if($aProject == "")
		{
			$query = "select * from $this->dbUserTable where status='' and name<>'' order by name";
		}else{
			$query = "select * from $this->dbUserTable where status='' and name<>'' and id not in ($aProject) order by name";
		}
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work. [getUnassignedProjects] " . mysql_error());

        // Test to make sure query worked
        if(mysql_num_rows($results)==0) return false;

        // Load the information from the table
		return $results;
	}
	
	function getProjects()
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Get data
        $query = "select * from $this->dbUserTable where status='' and name<>'' order by name";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work. [getProjects] " . mysql_error());

        // Test to make sure query worked
        if(mysql_num_rows($results)==0) return false;

        // Load the information from the table
		return $results;
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
			case "name":
				$query = "update $this->dbUserTable set name = '$this->name', pdate = '$date', ptime = '$time', uid_fk = $uid where id = $id";
				break;
		}
		$results = mysql_query($query);

        // Test to make sure query worked
        if(!$results) die("Query didn't work. [update] $this->dbUserTable " . mysql_error());

        // Close database connection
        mysql_close($dbLink);
		
		return true;
    }
	
    function saveAssignment($pid, $tid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Insert record
		$query = "insert into frzrprotime (fk_pid, fk_tid) values('$pid', '$tid')";
		$results = mysql_query($query);

        // Test to make sure query worked
        if(!$results) die("Query didn't work. [saveAssignment] $this->dbUserTable " . mysql_error());

        // Close database connection
        mysql_close($dbLink);
		
		return true;
    }
	
    function removeAssignment($pid, $tid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Insert record
		$query = "delete from frzrprotime where fk_pid=$pid and fk_tid=$tid";
		$results = mysql_query($query);

        // Test to make sure query worked
        if(!$results) die("Query didn't work. [removeAssignment] $this->dbUserTable " . mysql_error());

        // Close database connection
        mysql_close($dbLink);
		
		return true;
    }
	
	function getAssignedProject($tid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Get data
		$query = "select distinct p.id,p.name  from $this->dbUserTable p, frzrtimesheet t where p.status='' and p.name<>'' and p.id=t.pid_FK and t.id=$tid order by name";
		$results = mysql_query($query);
		
		// Test to make sure query worked
		if(!$results) die("Query didn't work. [getAssignedProjects] " . mysql_error());

		// Test to make sure query worked
		if(mysql_num_rows($results)==0) return false;

        // Load the information from the table
		return $results;
	}
		
	function getUnassignedProject($tid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Get data
		$query = "select distinct p.id,p.name from $this->dbUserTable p, frzrtimesheet t where p.status='' and p.name<>'' and p.id<>t.pid_FK and t.id=$tid order by name";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work. [getUnassignedProjects] " . mysql_error());

        // Test to make sure query worked
        if(mysql_num_rows($results)==0) return false;

        // Load the information from the table
		return $results;
	}
}
?>