<?php
	// Functions for export to excel.
	function xlsBOF() 
	{
		echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
		return;
	}
	
	function xlsEOF() {
		echo pack("ss", 0x0A, 0x00);
		return;
	}
	
	function xlsWriteNumber($Row, $Col, $Value) 
	{
		echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
		echo pack("d", $Value);
		return;
	}
	
	function xlsWriteLabel($Row, $Col, $Value ) 
	{
		$L = strlen($Value);
		echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
		echo $Value;
		return;
	} 
	
	// Connect to database
	$dbLink = mysql_connect("p3smysql63.secureserver.net", "kstennant", "Snack211");
	if(!$dbLink) die("Could not connect to database. " . mysql_error());

	// Select database
	mysql_select_db("kstennant");
	
	$sdate = $_GET["date"];
	$month = date("m", strtotime($sdate));
	$day = date("d", strtotime($sdate));
	$year = date("Y", strtotime($sdate));
	$date = date("Y-m-d", mktime(0, 0, 0, $month, $day+7, $year));
	
	// Get data
	$query = "select distinct s.*,e.fullname from frzrtimesheet s,frzrpeople e where s.pdate>'$sdate' and s.pdate<='$date' and s.uid_FK = e.id order by e.fullname, s.pdate, s.ptime";
	$results = mysql_query($query);
	
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");;
	header("Content-Disposition: attachment;filename=timesheet.xls ");
	header("Content-Transfer-Encoding: binary ");
	
	xlsBOF();
	
	/*
	Make a top line on your excel sheet at line 1 (starting at 0).
	The first number is the row number and the second number is the column, both are start at '0'
	*/
	xlsWriteLabel(0,0,"Timesheet from ".date("m/d/Y",strtotime($sdate))." to ".date("m/d/Y",strtotime($date)));
	
	// Make column labels. (at line 3)
	xlsWriteLabel(2,0,"Employee");
	xlsWriteLabel(2,1,"Punch");
	xlsWriteLabel(2,2,"Date");
	xlsWriteLabel(2,3,"Time");
	xlsWriteLabel(2,4,"Hours");
	xlsWriteLabel(2,5,"Project");
	xlsWriteLabel(2,6,"Notes");
	
	$xlsRow = 3;
	
	$dailyHours = 0;
	$projectHours = 0;
	$totalHours = 0;
	// Put data records from mysql by while loop.
	while($results && $result=mysql_fetch_array($results))
	{
		if($result['fullname'] != $holdName && $holdName != "")
		{
			xlsWriteNumber($xlsRow,4,number_format($dailyHours,2,".",""));
			xlsWriteLabel($xlsRow,5,'Daily Hours');
			$totalHours += $dailyHours;
			$dailyHours = 0;
			$xlsRow++;
			xlsWriteLabel($xlsRow,4,'=======');
			$xlsRow++;
			
			xlsWriteNumber($xlsRow,4,number_format($totalHours,2,".",""));
			xlsWriteLabel($xlsRow,5,'Total Hours');
			$dailyHours = 0;
			$totalHours = 0;
			$xlsRow++;
			$xlsRow++;
			
			xlsWriteNumber($xlsRow,4,number_format($projectHours,2,".",""));
			xlsWriteLabel($xlsRow,5,'Project Hours');
			$totalProjectHours += $projectHours;
			$projectHours = 0;
			$xlsRow++;
			xlsWriteLabel($xlsRow,4,'=======');
			$xlsRow++;
			
			xlsWriteNumber($xlsRow,4,number_format($projectHours,2,".",""));
			xlsWriteLabel($xlsRow,5,'Total Project Hours');
			$projectHours = 0;
			$totalProjectHours = 0;
			$xlsRow++;
			$xlsRow++;
		}
		
		if($result['pdate'] != $holdDate && $holdDate != "")
		{
			$query2 = "select * from frzrtimesheet where uid_FK=".$holdId." and pdate='".$holdDate."' and type='I'";
			$query3 = "select * from frzrtimesheet where uid_FK=".$holdId." and pdate='".$holdDate."' and type!='I'";
			$results2 = mysql_query($query2);
			$results3 = mysql_query($query3);
			if(mysql_num_rows($results2) != mysql_num_rows($results3)){
				xlsWriteLabel($xlsRow,0,"**NOTICE: Punch(es) missing");
			}
			
			xlsWriteNumber($xlsRow,4,$dailyHours);
			xlsWriteLabel($xlsRow,5,'Daily Hours');
			$totalHours += $dailyHours;
			$dailyHours = 0;
			$xlsRow++;
			xlsWriteNumber($xlsRow,4,$projectHours);
			xlsWriteLabel($xlsRow,5,'Project Hours');
			$totalProjectHours += $projectHours;
			$projectHours = 0;
			$xlsRow++;
			$xlsRow++;
		}
		
		if($result['fullname'] != $holdName) xlsWriteLabel($xlsRow,0,$result['fullname']);
		if($result['type'] == 'I') xlsWriteLabel($xlsRow,1,'IN');
		if($result['type'] == 'L') xlsWriteLabel($xlsRow,1,'LUNCH');
		if($result['type'] == 'O') xlsWriteLabel($xlsRow,1,'OUT');
		if($result['type'] == 'X') xlsWriteLabel($xlsRow,1,'ABSENT');
		if($result['type'] == 'S') xlsWriteLabel($xlsRow,1,'START');
		if($result['type'] == 'E') xlsWriteLabel($xlsRow,1,'END');
		if($result['type'] == 'X') xlsWriteLabel($xlsRow,6,$result['note']);
		if($result['pdate'] != $holdDate) xlsWriteLabel($xlsRow,2,date("D, m/d", strtotime($result['pdate'])));
		xlsWriteLabel($xlsRow,3,date("h:i A", strtotime($result['ptime'])));
		if($result['hours'] > 0) xlsWriteNumber($xlsRow,4,$result['hours']);
		if($result['pid_FK'] > 0)
		{
			$query1 = "select * from frzrproject where id = ".$result['pid_FK'];
			$projects = mysql_query($query1);
			$project = mysql_fetch_array($projects);
			xlsWriteLabel($xlsRow,5,$project['name']);
		}
		
		xlsWriteLabel($xlsRow,6,$result['note']);
		
		$holdDate = $result['pdate'];
		$holdName = $result['fullname'];
		if($result['hours'] > 0 && ($result['type']=='L' || $result['type']=='O')) $dailyHours += $result['hours'];
		if($result['hours'] > 0 && $result['type']=='E') $projectHours += $result['hours'];
		$xlsRow++;
		$holdId = $result["uid_FK"];
	}
	
	if($dailyHours != 0 || $projectHours !=0)
	{
		$query2 = "select * from frzrtimesheet where uid_FK=".$holdId." and pdate='".$holdDate."' and type='I'";
		$query3 = "select * from frzrtimesheet where uid_FK=".$holdId." and pdate='".$holdDate."' and type!='I'";
		$results2 = mysql_query($query2);
		$results3 = mysql_query($query3);
		if(mysql_num_rows($results2) != mysql_num_rows($results3)){
			xlsWriteLabel($xlsRow,0,"**NOTICE: Punch(es) missing");
		}
		xlsWriteNumber($xlsRow,4,number_format($dailyHours,2,".",""));
		xlsWriteLabel($xlsRow,5,'Daily Hours');
		$totalHours += $dailyHours;
		$dailyHours = 0;
		$xlsRow++;
		xlsWriteNumber($xlsRow,4,number_format($projectHours,2,".",""));
		xlsWriteLabel($xlsRow,5,'Project Hours');
		$totalProjectHours += $projectHours;
		$projectHours = 0;
		$xlsRow++;
	}

	if($totalHours != 0 || $totalPorjectHours != 0)
	{
		xlsWriteLabel($xlsRow,4,'=======');
		$xlsRow++;
		xlsWriteNumber($xlsRow,4,number_format($totalHours,2,".",""));
		xlsWriteLabel($xlsRow,5,'Total Hours');
		$xlsRow++;
		xlsWriteLabel($xlsRow,4,'=======');
		$xlsRow++;
		xlsWriteNumber($xlsRow,4,number_format($totalProjectHours,2,".",""));
		xlsWriteLabel($xlsRow,5,'Total Project Hours');
		$xlsRow++;
	}

	xlsEOF();
	exit();
?>