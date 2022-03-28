<?php
	function wordcount($str) 
	{
		return str_word_count($str);
	}
	
	function cellColor($recorded)
	{
		$color="white";
		if ($recorded=="yes")
		{
			$color = "orange";
		}
		return $color;
	}
	
	function BasicCalendar($month,$year)
	{
		$begDate=date("Y-m-d");
		// Build Top of Calendar
		printf("<table width='210' cellspacing='0' cellpadding='2' bgcolor='white' border='1'>
			<tr>
			<td align='center' bgColor='gainsboro' valign='top'>		
			<span class='calendarHeader'>%s&nbsp;%s</span></td></tr><tr><td>
			<table width='210' cellspacing='0' cellpadding='0'><tr><td>
			<table width='210' cellspacing='0' cellpadding='0'>
				<tr bgcolor='navy'>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>S</span>
					</td>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>M</span>
					</td>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>T</span>
					</td>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>W</span>
					</td>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>T</span>
					</td>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>F</span>
					</td>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>S</span>
					</td>
				</tr>
				<tr height='20'>",date("M", mktime(0,0,0,$month,1,$year)),$year);
		// Build Blank Spaces
		$day=date("w", mktime(0,0,0,$month,1,$year));
		if($day>0)
		{
			print("<td colspan='$day'></td>");
			$day+=1;
		}
		else
		{
			$day=1;
		}
		// Build Days
		$journal = new Journal();
		$calcDay=0;
		$createdDate=date("Y-m-d", mktime(0,0,0,$month,1,$year));
		for ($day=$day; $day<=date("t", mktime(0,0,0,$month,1,$year))+date("w", mktime(0,0,0,$month,1,$year)); $day++)
		{
			$calcDay++;
			$createdDate=date("Y-m-d", mktime(0,0,0,substr($createdDate,5,2),$calcDay,substr($createdDate,0,4)));
			if($createdDate<date("Y-m-d"))
			{
				printf("<td bgColor='%s' class='data' align='right'>$calcDay</td>",call_user_func('cellColor',"yes"));
			}elseif($createdDate==date("Y-m-d")){
				printf("<td bgColor='%s' class='data' align='right' style='color: green;'>$calcDay</td>",call_user_func('cellColor',"no"));
			}elseif($createdDate>date("Y-m-d")){
			    printf("<td bgColor='%s' class='data' align='right'>$calcDay</td>",call_user_func('cellColor',"no"));
			}
			if ($day%7==0 && $day!=0)
			{
				print("</tr><tr height='20'>");
			}
		}
		$day=8-date("w", mktime(0,0,0,substr($createdDate,5,2),substr($createdDate,7,2),substr($createdDate,0,4)));
		print("<td colspan='$day'></td>");
		print("</tr></table></td></tr></table></td></tr></table>");
	}

    function BuildCalendar($month,$year,$uid)
	{
		$begDate=date("Y-m-d");
		// Build Top of Calendar
		printf("<table width='210' cellspacing='0' cellpadding='2' bgcolor='white' border='1'>
			<tr>
			<td align='center' bgColor='gainsboro' valign='top'>		
			<span class='calendarHeader'><a href='index.php?page=calendar&date=%s' class='mainLink'>%s&nbsp;%s</a></span></td></tr><tr><td>
			<table width='210' cellspacing='0' cellpadding='0' height='150px'><tr><td valign='top'>
			<table width='210' cellspacing='0' cellpadding='0'>
				<tr bgcolor='navy'>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>S</span>
					</td>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>M</span>
					</td>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>T</span>
					</td>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>W</span>
					</td>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>T</span>
					</td>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>F</span>
					</td>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>S</span>
					</td>
				</tr>
				<tr height='20'>",date("Y-m-d", mktime(0,0,0,$month,1,$year)),date("M", mktime(0,0,0,$month,1,$year)),$year);
		// Build Blank Spaces
		$day=date("w", mktime(0,0,0,$month,1,$year));
		if($day>0)
		{
			print("<td colspan='$day'></td>");
			$day+=1;
		}
		else
		{
			$day=1;
		}
		// Build Days
		$journal = new Journal();
		$calcDay=0;
		$createdDate=date("Y-m-d", mktime(0,0,0,$month,1,$year));
		for ($day=$day; $day<=date("t", mktime(0,0,0,$month,1,$year))+date("w", mktime(0,0,0,$month,1,$year)); $day++)
		{
			$calcDay++;
			$createdDate=date("Y-m-d", mktime(0,0,0,substr($createdDate,5,2),$calcDay,substr($createdDate,0,4)));
			$page='index.php';
			if(isset($_GET['print']) && $_GET['print']=='Y')
			{
				$page='print.php';
			}
			if($journal->isEntry($createdDate, $uid))
			{
				printf("<td bgColor='%s' align='right'><font face='Comic Sans MS'><a href='$page?page=calendar&day=$createdDate&view=' class='calendarLink'>$calcDay</a></font></td>",call_user_func('cellColor',"yes"));
			}
			else
			{
				if($createdDate<=date("Y-m-d"))
				{
					if($uid == -1){
						printf("<td bgColor='%s' class='calendarLink' align='right'>$calcDay</td>",call_user_func('cellColor',"yes"));
					}else{
						printf("<td bgColor='%s' class='data' align='right'><a href='$page?page=calendar&day=$createdDate&view=' class='calendarLink'>$calcDay</a></td>",call_user_func('cellColor',"no"));
					}
				}else{
					if($uid == -1){
						printf("<td bgColor='%s' class='calendarLink' align='right'>$calcDay</td>",call_user_func('cellColor',"no"));
					}else{
						printf("<td bgColor='%s' class='data' align='right'>$calcDay</td>",call_user_func('cellColor',"no"));
					}
				}
			}
			if ($day%7==0 && $day!=0)
			{
				print("</tr><tr height='20'>");
			}
		}
		$day=8-date("w", mktime(0,0,0,substr($createdDate,5,2),substr($createdDate,7,2),substr($createdDate,0,4)));
		print("<td colspan='$day'></td>");
		print("</tr></table></td></tr></table></td></tr></table>");
	}
	
	function BuildCalendarUpdate($month,$year,$uid)
	{
		$begDate=date("Y-m-d");
		// Build Top of Calendar
		printf("<table width='190' cellspacing='0' cellpadding='2' bgcolor='white' border='1'>
			<tr>
			<td align='center' bgColor='gainsboro' valign='top'>		
			<span class='calendarHeader'>%s&nbsp;%s</span></td></tr><tr><td>
			<table width='190' cellspacing='0' cellpadding='0'><tr><td>
			<table width='190' cellspacing='0' cellpadding='0'>
				<tr bgcolor='navy'>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>S</span>
					</td>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>M</span>
					</td>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>T</span>
					</td>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>W</span>
					</td>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>T</span>
					</td>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>F</span>
					</td>
					<td align='right'>
						<span style='font-family: Comic Sans MS; font-size: 9pt; color: white;'>S</span>
					</td>
				</tr>
				<tr height='20'>",date("F", mktime(0,0,0,$month,1,$year)),$year);
		// Build Blank Spaces
		$day=date("w", mktime(0,0,0,$month,1,$year));
		if($day>0)
		{
			print("<td colspan='$day'></td>");
			$day+=1;
		}
		else
		{
			$day=1;
		}
		// Build Days
		$journal = new Journal();
		$calcDay=0;
		$createdDate=date("Y-m-d", mktime(0,0,0,$month,1,$year));
		for ($day=$day; $day<=date("t", mktime(0,0,0,$month,1,$year))+date("w", mktime(0,0,0,$month,1,$year)); $day++)
		{
			$calcDay++;
			$createdDate=date("Y-m-d", mktime(0,0,0,substr($createdDate,5,2),$calcDay,substr($createdDate,0,4)));
			$page='index.php';
			if(isset($_GET['print']) && $_GET['print']=='Y')
			{
				$page='print.php';
			}
			if($journal->isEntry($createdDate, $uid))
			{
				printf("<td bgColor='%s' align='right'><font face='Comic Sans MS'><a href='$page?page=calendar&day=$createdDate&view=' class='calendarLink'>$calcDay</a></font></td>",call_user_func('cellColor',"yes"));
			}
			else
			{	
				if($createdDate<=date("Y-m-d"))
				{
					printf("<td bgColor='%s' class='data' align='right'><a href='$page?page=calendar&day=$createdDate&view=' class='calendarLink'>$calcDay</a></td>",call_user_func('cellColor',"no"));
				}else{
					printf("<td bgColor='%s' class='calendarLink' align='right'>$calcDay</td>",call_user_func('cellColor',"no"));
				}
			}
			if ($day%7==0 && $day!=0)
			{
				print("</tr><tr height='20'>");
			}
		}
		$day=8-date("w", mktime(0,0,0,substr($createdDate,5,2),substr($createdDate,7,2),substr($createdDate,0,4)));
		print("<td colspan='$day'></td>");
		print("</tr></table></td></tr></table></td></tr></table>");
	}
?>