<?php // This is the User class for Frazier Industrial
class Timesheet
{
	// Class variables
	var $connection;
		
	var $id,
		$pdate,
		$ptime,
		$hours,
		$type,
		$userId,
		$projectId,
		$note,
		$dbHost,
        $dbUser,
        $dbName,
        $dbPass,
        $dbUserTable,
		$dbAuthLevel,
		$dbStatus,
		$logged,
		$host;
	
	function Timesheet()
	{
		$this->connection = new Connection();
		$this->dbUserTable = "timesheet";
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

	function setProject($project)
	{
		$this->project = $project;
	}
		
	
	function getProject()
	{
		return $this->project;
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
		$this->ptime = $ptime;
	}
		
	function getTime()
	{
		return $this->ptime;
	}
	
	function setHours($hours)
	{
		$this->hours = $hours;
	}
		
	function getHours()
	{
		return $this->hours;
	}
	
	function setType($type)
	{
		$this->type = $type;
	}
		
	function getType()
	{
		return $this->type;
	}
	
	function setUserId($userId)
	{
		$this->userId = $userId;
	}
		
	function getUserId()
	{
		return $this->userId;
	}
	
	function setProjectId($projectId)
	{
		$this->projectId = $projectId;
	}
		
	function getProjectId()
	{
		return $this->projectId;
	}
	
	function setNote($note)
	{
		$this->note = $note;
	}
		
	function getNote()
	{
		return $this->note;
	}
	
	function load($tid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        $query = "select * from $this->dbUserTable where id=$tid";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work. [load] $this->dbUserTable " . mysql_error());

        // Test to make sure query worked
        if(mysql_num_rows($results)==0) return false;

        // Load the information from the table
		$result = mysql_fetch_array($results);
        $this->setId($result[0]);
		$this->setDate($result[1]);
		$this->setTime($result[2]);
		$this->setHours($result[3]);
		$this->setType($result[4]);
		$this->setUserId($result[5]);
		$this->setProjectId($result[6]);
		$this->setNote($result[7]);
		
		mysql_close($dbLink);
		
		// Load the information from the table
		return true;
	}	
	
	function save($project, $type, $uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Insert record
		if($type=='S' || $type=='E' || $type=='L' || $type=='O'){
			if($type=='E')
			{
				$query = "select Max(ptime) as ptime from $this->dbUserTable where uid_FK=$uid and pdate='".date("Y-m-d")."' and type='S'";
				$results = mysql_query($query);
				$result = mysql_fetch_array($results);
				$date = date("Y-m-d");
				$hour = date("H");
				$minute = date("i");
				$second = date("s");
				$time = $hour.":".$minute.":".$second;
				$hours[0] = date("H.i",strtotime($result["ptime"]));
				$hours[1] = date("H.i",strtotime($time));
				$hours[0] = ((int)$hours[0])*60 + ($hours[0]-((int)$hours[0]))*100;
				$hours[1] = ((int)$hours[1])*60 + ($hours[1]-((int)$hours[1]))*100;
				if($hours[0] > $hours[1]) $hours[1] += 24*60;
				$totalhours = sprintf("%.2f",($hours[1] - $hours[0]) / 60);
				$query = "insert into $this->dbUserTable (pdate, ptime, hours, type, uid_FK, pid_FK) values('$date', '$time', $totalhours, '$type', $uid, $project)";
			}elseif($type=='L' || $type=='O'){
				$query = "select Max(ptime) as ptime from $this->dbUserTable where uid_FK=$uid and pdate='".date("Y-m-d")."' and type='I'";
				$results = mysql_query($query);
				$result = mysql_fetch_array($results);
				$date = date("Y-m-d");
				$hour = date("H");
				$minute = date("i");
				$second = date("s");
				$time = $hour.":".$minute.":".$second;
				$hours[0] = date("H.i",strtotime($result["ptime"]));
				$hours[1] = date("H.i",strtotime($time));
				$hours[0] = ((int)$hours[0])*60 + ($hours[0]-((int)$hours[0]))*100;
				$hours[1] = ((int)$hours[1])*60 + ($hours[1]-((int)$hours[1]))*100;
				if($hours[0] > $hours[1]) $hours[1] += 24*60;
				$totalhours = sprintf("%.2f",($hours[1] - $hours[0]) / 60);
				$query = "insert into $this->dbUserTable (pdate, ptime, hours, type, uid_FK) values('$date', '$time', $totalhours, '$type', $uid)";
			}else{
				$date = date("Y-m-d");
				$hour = date("H");
				$minute = date("i");
				$second = date("s");
				$time = $hour.":".$minute.":".$second;
				$query = "insert into $this->dbUserTable (pdate, ptime, type, uid_FK, pid_FK) values('$date', '$time', '$type', $uid, $project)";
			}
		}else{
			$date = date("Y-m-d");
			$hour = date("H");
			$minute = date("i");
			$second = date("s");
			$time = $hour.":".$minute.":".$second;
			$query = "insert into $this->dbUserTable (pdate, ptime, hours, type, uid_FK) values('$date', '$time', 0, '$type', $uid)";
		}
        
		$results = mysql_query($query);

        // Test to make sure query worked
        if(!$results) die("Query didn't work. [save] " . mysql_error());

        // Close database connection
        mysql_close($dbLink);
		
		return true;
	}	
	
	function saveTime($date, $hour, $minute, $type, $uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Insert record
		if($type=='S' || $type=='E' || $type=='L' || $type=='O'){
			if($type=='E')
			{
				$query = "select Max(ptime) as ptime from $this->dbUserTable where uid_FK=$uid and pdate='$date' and type='S'";
				$results = mysql_query($query);
				if($results && $result = mysql_fetch_array($results))
				{
					$note="Missed Punch";
					$time = $hour.":".$minute.":00";
					$hours[0] = date("H.i",strtotime($result["ptime"]));
					$hours[1] = date("H.i",strtotime($time));
					$hours[0] = ((int)$hours[0])*60 + ($hours[0]-((int)$hours[0]))*100;
					$hours[1] = ((int)$hours[1])*60 + ($hours[1]-((int)$hours[1]))*100;
					if($hours[0] > $hours[1]) $hours[1] += 24*60;
					$totalhours = sprintf("%.2f",($hours[1] - $hours[0]) / 60);
					$query = "insert into $this->dbUserTable (pdate, ptime, hours, type, uid_FK, note) values('$date', '$time', $totalhours, '$type', $uid, '$note')";
				}
			}elseif($type=='L' || $type=='O'){
				$query = "select Max(ptime) as ptime from $this->dbUserTable where uid_FK=$uid and pdate='$date' and type='I'";
				$results = mysql_query($query);
				if($results && $result = mysql_fetch_array($results))
				{
					$note="Missed Punch";
					$time = $hour.":".$minute.":00";
					$hours[0] = date("H.i",strtotime($result["ptime"]));
					$hours[1] = date("H.i",strtotime($time));
					$hours[0] = ((int)$hours[0])*60 + ($hours[0]-((int)$hours[0]))*100;
					$hours[1] = ((int)$hours[1])*60 + ($hours[1]-((int)$hours[1]))*100;
					if($hours[0] > $hours[1]) $hours[1] += 24*60;
					$totalhours = sprintf("%.2f",($hours[1] - $hours[0]) / 60);
					$query = "insert into $this->dbUserTable (pdate, ptime, hours, type, uid_FK, note) values('$date', '$time', $totalhours, '$type', $uid, '$note')";
				}
			}else{
				$note="Missed Punch";
				$time = $hour.":".$minute.":00";
				$query = "insert into $this->dbUserTable (pdate, ptime, type, uid_FK, note) values('$date', '$time', '$type', $uid, '$note')";
			}
		}else{
			$time = $hour.":".$minute.":00";
			$note = "Missed Punch";
			$query = "insert into $this->dbUserTable (pdate, ptime, hours, type, uid_FK, note) values('$date', '$time', 0, '$type', $uid, '$note')";
		}
        
		$results = mysql_query($query);

        // Test to make sure query worked
        if(!$results) die("Query didn't work. [save] $this->dbUserTable " . mysql_error());

        // Close database connection
        mysql_close($dbLink);
		
		return true;
	}	
	
	function saveTimeReason($date, $hour, $minute, $type, $uid, $reason)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Insert record
		if($type=='L' || $type=='O'){
			$query = "select Max(ptime) as ptime from $this->dbUserTable where uid_FK=$uid and pdate='$date' and type='I'";
			$results = mysql_query($query);
			if($results && $result = mysql_fetch_array($results))
			{
				$time = $hour.":".$minute.":00";
				$hours[0] = date("H.i",strtotime($result["ptime"]));
				$hours[1] = date("H.i",strtotime($time));
				$hours[0] = ((int)$hours[0])*60 + ($hours[0]-((int)$hours[0]))*100;
				$hours[1] = ((int)$hours[1])*60 + ($hours[1]-((int)$hours[1]))*100;
				if($hours[0] > $hours[1]) $hours[1] += 24*60;
				$totalhours = sprintf("%.2f",($hours[1] - $hours[0]) / 60);
				$query = "insert into $this->dbUserTable (pdate, ptime, hours, type, uid_FK, note) values('$date', '$time', $totalhours, '$type', $uid, '$reason')";
			}
		}else{
			$time = $hour.":".$minute.":00";
			$query = "insert into $this->dbUserTable (pdate, ptime, hours, type, uid_FK, note) values('$date', '$time', 0, '$type', $uid, '$reason')";
		}
        
		$results = mysql_query($query);

        // Test to make sure query worked
        if(!$results) die("Query didn't work. [save] $this->dbUserTable " . mysql_error());

        // Close database connection
        mysql_close($dbLink);
		
		return true;
	}
	
	function saveEntry($sdate, $edate, $note, $uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		$hour = date("H")+1;
		$minute = date("i");
		$second = date("s");
		$time = $hour.":".$minute.":".$second;
		// Insert record
		$month = date("m", strtotime($edate));
		$day = date("d", strtotime($edate));
		$year = date("Y", strtotime($edate));
		$edate = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));
		$month = date("m", strtotime($sdate));
		$day = date("d", strtotime($sdate));
		$year = date("Y", strtotime($sdate));
		$sdate = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));
		while ($sdate <= $edate)
		{
			$query = "insert into $this->dbUserTable (pdate, ptime, type, uid_FK, note) values('$sdate', '$time', 'X', $uid, '$note')";
			$results = mysql_query($query);
			
	        // Test to make sure query worked
    	    if(!$results) die("Query didn't work. [saveEntry] $this->dbUserTable " . mysql_error());
			
			$month = date("m", strtotime($sdate));
			$day = date("d", strtotime($sdate));
			$year = date("Y", strtotime($sdate));
			$sdate = date("Y-m-d", mktime(0, 0, 0, $month, $day+1, $year));
		}

        // Close database connection
        mysql_close($dbLink);
		
		return true;
	}	
	
	function entriesExist($sdate, $uid)
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
        $query = "select * from $this->dbUserTable where uid_FK=$uid and pdate>='$sdate' and pdate<='$date'";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work. [entriesExist] $this->dbUserTable " . mysql_error());

        // Test to make sure query worked
        if(mysql_num_rows($results)==0) return false;

        mysql_close($dbLink);
		
		// Load the information from the table
		return true;
	}
	
	function getDayEntries($uid, $date)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

        // Get data
        $query = "select * from $this->dbUserTable where uid_FK=$uid and pdate='$date' order by pdate,ptime";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work. [getDayEntries] " . mysql_error());

        // Test to make sure query worked
        if(mysql_num_rows($results)==0) return false;

        mysql_close($dbLink);

        // Load the information from the table
		return $results;
	}
	
	function getDailyEntries($uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		$date = date("Y-m-d");
        // Get data
        $query = "select * from $this->dbUserTable where uid_FK=$uid and pdate='$date' order by pdate,ptime";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work. [getDailyEntries] " . mysql_error());

        // Test to make sure query worked
        if(mysql_num_rows($results)==0) return false;

        mysql_close($dbLink);

        // Load the information from the table
		return $results;
	}
	
	function getWeeklyEntries($uid, $sdate)
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
        $query = "select * from $this->dbUserTable where uid_FK=$uid and pdate>'$sdate' and pdate<='$date' order by pdate,ptime";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work. [getWeeklyEntries] $this->dbUserTable " . mysql_error());

        // Test to make sure query worked
        if(mysql_num_rows($results)==0) return false;

        mysql_close($dbLink);

        // Load the information from the table
		return $results;
	}

	function getDailyHours($sdate,$uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Get data
        $query = "select sum(hours) as hours from $this->dbUserTable where uid_FK=$uid and pdate='$sdate'";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work. [getDailyHours] $this->dbUserTable " . mysql_error());

        // Test to make sure query worked
        if(mysql_num_rows($results)==0) return false;

		$result = mysql_fetch_array($results);	
		
		mysql_close($dbLink);

        // Load the information from the table
		return $result["hours"];
	}

	function delete($pid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Insert record
        $query = "delete from $this->dbUserTable where id=$pid";
		$results = mysql_query($query);

        // Test to make sure query worked
        if(!$results) die("Query didn't work. [delete] $this->dbUserTable" . mysql_error());

        // Close database connection
        mysql_close($dbLink);
		
		return true;
	}	
	
	function punchCheck($today, $type, $uid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Get data
		$query1 = "select * from $this->dbUserTable where uid_FK=$uid and pdate='$today' and type='I'";
		$query2 = "select * from $this->dbUserTable where uid_FK=$uid and pdate='$today' and type='L'";
		$query3 = "select * from $this->dbUserTable where uid_FK=$uid and pdate='$today' and type='O'";
		$query4 = "select * from $this->dbUserTable where uid_FK=$uid and pdate='$today' and type='X'";
		$query5 = "select * from $this->dbUserTable where uid_FK=$uid and pdate='$today' and type='S'";
		$query6 = "select * from $this->dbUserTable where uid_FK=$uid and pdate='$today' and type='E'";
		
		$results1 = mysql_query($query1);
		$results2 = mysql_query($query2);
		$results3 = mysql_query($query3);
		$results4 = mysql_query($query4);
		$results5 = mysql_query($query5);
		$results6 = mysql_query($query6);
        // Test to make sure query worked
        if(!$results1) die("Query didn't work. [punchCheck] $this->dbUserTable " . mysql_error());
        if(!$results2) die("Query didn't work. [punchCheck] $this->dbUserTable " . mysql_error());
        if(!$results3) die("Query didn't work. [punchCheck] $this->dbUserTable " . mysql_error());
        if(!$results4) die("Query didn't work. [punchCheck] $this->dbUserTable " . mysql_error());
		if(!$results5) die("Query didn't work. [punchCheck] $this->dbUserTable " . mysql_error());
		if(!$results6) die("Query didn't work. [punchCheck] $this->dbUserTable " . mysql_error());

        // Test to make sure query worked
        //if(mysql_num_rows($results)==0) return false;
		switch($type)
		{
			case "I":
        		if(mysql_num_rows($results1) != mysql_num_rows($results2) + mysql_num_rows($results3) + mysql_num_rows($results4)) return true;
				return false;
			case "L":
        		if((mysql_num_rows($results1) <= mysql_num_rows($results2) + mysql_num_rows($results3)) || mysql_num_rows($results2) > 0) return true;
				return false;
			case "O":
        		if(mysql_num_rows($results1) <= mysql_num_rows($results2) + mysql_num_rows($results3) + mysql_num_rows($results4)) return true;
				return false;
			case "X":
        		if(mysql_num_rows($results4) > 0) return true;
				return false;
			case "S":
        		if((mysql_num_rows($results6) != mysql_num_rows($results6)) || (mysql_num_rows($results1) <= mysql_num_rows($results2) + mysql_num_rows($results3) + mysql_num_rows($results4))) return true;
				return false;
			case "E":
        		if(mysql_num_rows($results5) <= mysql_num_rows($results6)) return true;
				return false;
			default:
				return false;
		}
		
        mysql_close($dbLink);
	}
	
	function getDates($date)
	{
        // Connect to database
		$dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Get data
		$query = "select min(pdate) as pdate from $this->dbUserTable";
		
		$results = mysql_query($query);
		// Test to make sure query worked
        if(!$results) die("Query didn't work. [getDates] $this->dbUserTable " . mysql_error());
        
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
	
	function isMissedPunch($uid, $day)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Get data
		$query1 = "select * from $this->dbUserTable where uid_FK=$uid and pdate='$day' and type='I'";
		$query2 = "select * from $this->dbUserTable where uid_FK=$uid and pdate='$day' and type='L'";
		$query3 = "select * from $this->dbUserTable where uid_FK=$uid and pdate='$day' and type='O'";
		$query4 = "select * from $this->dbUserTable where uid_FK=$uid and pdate='$day' and type='S'";
		$query5 = "select * from $this->dbUserTable where uid_FK=$uid and pdate='$day' and type='E'";
		
		$results1 = mysql_query($query1);
		$results2 = mysql_query($query2);
		$results3 = mysql_query($query3);
		$results4 = mysql_query($query4);
		$results5 = mysql_query($query5);
        // Test to make sure query worked
        if(!$results1) die("Query didn't work. [isMissedPunch] $this->dbUserTable " . mysql_error());
        if(!$results2) die("Query didn't work. [isMissedPunch] $this->dbUserTable " . mysql_error());
        if(!$results3) die("Query didn't work. [isMissedPunch] $this->dbUserTable " . mysql_error());
        if(!$results4) die("Query didn't work. [isMissedPunch] $this->dbUserTable " . mysql_error());
        if(!$results5) die("Query didn't work. [isMissedPunch] $this->dbUserTable " . mysql_error());

        // Test to make sure query worked
        //if(mysql_num_rows($results)==0) return false;
		if(mysql_num_rows($results1) + mysql_num_rows($results4) != mysql_num_rows($results2) +mysql_num_rows($results3) + mysql_num_rows($results5)) return true;
		
        mysql_close($dbLink);
		return false;
	}
	
    function saveAssignment($pid, $tid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Insert record
		$query = "update $this->dbUserTable set pid_fk=$pid where id=$tid";
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
		$query = "update $this->dbUserTable set pid_fk='' where id=$tid and pid_FK=$pid";
		$results = mysql_query($query);

        // Test to make sure query worked
        if(!$results) die("Query didn't work. [removeAssignment] $this->dbUserTable " . mysql_error());

        // Close database connection
        mysql_close($dbLink);
		
		return true;
    }
	
	function isAssigned($tid)
	{
        // Connect to database
        $dbLink = mysql_connect($this->connection->getHost(), $this->connection->getUser(), $this->connection->getPass());
        if(!$dbLink) die("Could not connect to database. " . mysql_error());

        // Select database
        mysql_select_db($this->connection->getName());

		// Get data
		$query = "select * from $this->dbUserTable where id=$tid and pid_FK<>0";
		$results = mysql_query($query);
        
        // Test to make sure query worked
        if(!$results) die("Query didn't work. [isAssigned] $this->dbUserTable " . mysql_error());

        // Test to make sure query worked
        if(mysql_num_rows($results)==0) return false;

        // Load the information from the table
		return true;
	}
}
?>