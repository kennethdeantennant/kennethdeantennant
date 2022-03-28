<?php
	function cellColor($day,$month,$year)
	{
		if($month==date("m") && $year==date("Y"))
			{
			if ($day < date("d"))
				{
					$color = "gray";
				}
			if ($day==date("d"))
				{
					$color = "yellow";
				}
			if ($day>date("d"))
				{
					$color = "silver";
				}
			}
		else
			{
				$color = "silver";
			}
		return $color;
	}
	
	function buildCalendar($month,$year)
	{
		printf("<table cellspacing='3' cellpadding='3'>
	<tr>
		<td align='center' bgColor='#606c90' valign='top'>		
		<b><font size='3' face='teletype' color='white'>%s&nbsp;%s</font></b></td></tr><tr><td>
		<table border='2' bordercolor='#606c90' cellspacing='0' cellpadding='0'><tr><td>
		<table border='1' bordercolor='white' cellspacing='0' cellpadding='5'>
					<tr bgColor='maroon'>
						<td>
							<font face='courier' color='white'>Su</font>
						</td>
						<td>
							<font face='courier' color='white'>Mo</font>
						</td>
						<td>
							<font face='courier' color='white'>Tu</font>
						</td>
						<td>
							<font face='courier' color='white'>We</font>
						</td>
						<td>
							<font face='courier' color='white'>Th</font>
						</td>
						<td>
							<font face='courier' color='white'>Fr</font>
						</td>
						<td>
							<font face='courier' color='white'>Sa</font>
						</td>
					</tr>
					<tr>", date('F',mktime(0,0,0,$month,1,$year)), date('Y',mktime(0,0,0,$month,1,$year)));
				
		for ($day=1; $day<=date("t", mktime(0,0,0,$month,1,$year)) + date("w", mktime(0,0,0,$month,1,$year)); $day++)
			{
				if ($day <= date("w", mktime(0,0,0,$month,1,$year)))
					{
						echo "<td></td>";
					}
				else
					{
						$calcDay = $day - date("w", mktime(0,0,0,$month,1,$year));
						if ($calcDay<10)
							{
								printf("<td bgColor='%s'><font face='courier'>%s</font></td>",call_user_func('cellColor',"$calcDay","$month","$year"),$calcDay);
							}
						else
							{
								printf("<td bgColor='%s'><font face='courier'>%s</font></td>",call_user_func('cellColor',"$calcDay","$month","$year"),$calcDay);
							}
					}
				if ($day%7==0)
					{
						print("</tr><tr>");
					}
			}
			echo "</tr></table></td></tr></table></td></tr></table>";
	}
?>