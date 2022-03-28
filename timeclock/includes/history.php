<?php
	include("../../frzrtime/includes/classes/Timesheet.php");
	$timesheet = new Timesheet();
	
	include("../../frzrtime/includes/classes/Project.php");
	$project = new Project();
?>
<script language="javascript">
	function NewSearch()
	{
		var date;
		
		date = document.getElementById("date").value;
		document.frmDaily.action='index.php?page=history&date='+date;
		document.frmDaily.submit();
	}
</script>
<form name="frmDaily" method="post" action="../../frzrtime/includes/index.php?page=timesheet&amp;action=save">
<table width="100%" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td colspan="2" bgcolor="#FFFFFF" background="../../frzrtime/includes/images/filler.JPG">
			<img src="../../frzrtime/includes/images/logo.jpg" />
		</td>
		<td background="../../frzrtime/includes/images/filler.JPG">
			<strong><?php echo(date("l, F jS, Y")); ?></strong>
		</td>
	</tr>
	<tr>
	<td colspan="4">
		<table width="100%" align="center" cellpadding="3" cellspacing="0" bgcolor="white">
			<tr>
				<td align="center" class="row">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td width="33%" nowrap="nowrap" valign="top">&nbsp;
								
							</td>
							<td width="34%" align="center" nowrap="nowrap">&nbsp;
								
							</td>
							<td width="33%" align="right" valign="top" nowrap="nowrap">
								<a href="javascript: window.close();">Close Window</a>
							</td>
						</tr>
					</table>
					<br />
					<?php 
						$uid = $user->getId();
						$sdate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-date("w"), date("Y")));
						if(isset($_GET["date"])) $sdate = $_GET["date"];
					?>
					<select name="date" id="date" onchange="javascript: document.getElementById('btnSearch').disabled='';">
					<?php
						$dates = $timesheet->getDates($sdate);
						foreach($dates as $date)
						{
					?>
						<option value="<?php echo($date); ?>" <?php if($date<=$sdate) echo("selected='selected'"); ?>>View the Week of <?php echo(date("m/d/Y",strtotime($date))); ?></option>
					<?php
						}
					?>
					</select>
					<input name="btnSearch" id="btnSearch" type="button" onclick="javascript: NewSearch();" value="Execute Search" disabled="disabled" />
					<p /><p />
				</td>
			</tr>
			<tr>
				<td>
					<br /><br />
					<table width="90%" cellspacing="0" cellpadding="5" bordercolor="#663300" align="center">
					<tr class="secondaryHeader">
						<td width="75">Date</td>
						<td width="75">Punch</td>
                  		<td width="75" align="right">Time</td>
                  		<td width="75" align="right">Hours</td>
                  		<td>Project</td>
                  		<td colspan="2">Notes</td>
                	</tr>
					<?php
						if($timesheet->entriesExist($sdate,$uid)){
							$timeEntries = $timesheet->getWeeklyEntries($uid, $sdate);
							$holdDate="";
							$weeklyHours;
							while ($timeEntries && $timeEntry = mysql_fetch_array($timeEntries))
							{
								if($holdDate != $timeEntry["pdate"] && isset($holdDate))
								{
									$totalHours = $timesheet->getDailyHours($holdDate,$uid);
									if($totalHours > 0)
									{
					?>
					<tr bgcolor="#E5E5E5">
						<td colspan="4" align="right">
							<strong>Total Hours:&nbsp;&nbsp;<?php echo($totalHours); ?></strong>
						</td>
						<td colspan="4">
							<?php if($timesheet->isMissedPunch($user->getId(), $holdDate)) echo("<a href='index.php?page=punchmissed&day=$holdDate' class='misspunch' target='_blank'>&nbsp;MISSING PUNCH&nbsp;</a>"); ?>
						</td>					</tr>
					<?php
										$weeklyHours+=$totalHours;
									}
								}
					?>
					<tr>
						<td nowrap="nowrap">
							<?php
								if($holdDate != $timeEntry["pdate"] || !isset($holdDate)) echo(date("D, M jS, Y",strtotime($timeEntry["pdate"]))); 
								$holdDate = $timeEntry["pdate"];
							?>
						</td>
						<td width="75" nowrap="nowrap">
							<?php
								if($timeEntry["type"] == "I") echo("<strong>IN</strong>");
								if($timeEntry["type"] == "L") echo("<strong>LUNCH</strong>");
								if($timeEntry["type"] == "O") echo("<strong>OUT</strong>");
								if($timeEntry["type"] == "X") echo("<strong>ABSENT</strong>");
								if($timeEntry["type"] == "S") echo("<strong>START</strong>");
								if($timeEntry["type"] == "E") echo("<strong>END</strong>");
							?>					</td>
						<td width="75" align="right" nowrap="nowrap"><?php echo(date("h:i a",strtotime($timeEntry["ptime"]))); ?></td>
						<td width="75" align="right">
							<?php 
								if($timeEntry["hours"] == 0){
									echo("&nbsp;");
								}else{
									echo($timeEntry["hours"]);
								}
							?>					</td>
						<td nowrap="nowrap">
							<?php if($timeEntry["pid_FK"] != null && $timeEntry["pid_FK"]>0 && $project->load($timeEntry["pid_FK"])) echo($project->getName()); ?>
						</td>
						<td nowrap="nowrap"><em><?php echo($timeEntry["note"]) ?></em></td>
						<td align="right"><?php if(($timeEntry["type"] == "S" || $timeEntry["type"] == "E" || $timeEntry["type"] == "X") && $timeEntry["project"] == null) echo("<a href='index.php?page=assignment&tid=".$timeEntry["id"]."&goto=history&day=".$_GET["day"]."' title='assign the time to project(s)'>[assign]</a>"); ?></td>
					</tr>
					 <?php
							}
							$totalHours = $timesheet->getDailyHours($holdDate,$uid);
							if($totalHours > 0)
							{
					?>
					<tr bgcolor="#E5E5E5">
						<td colspan="4" align="right">
							<strong>Total Hours:&nbsp;&nbsp;<?php echo($totalHours); ?></strong>
						</td>
						<td colspan="4">
							<?php if($timesheet->isMissedPunch($user->getId(), $holdDate)) echo("<a href='index.php?page=punchmissed&day=$holdDate' class='misspunch' target='_blank'>&nbsp;MISSING PUNCH&nbsp;</a>"); ?>
						</td>					</tr>
					<?php
								$weeklyHours+=$totalHours;
							}
					}else{
						echo("<tr><td colspan='4' nowrap='nowrap'><br /><blockquote><em>No entries exist for the week selected...</em></blockquote></td></tr>");
					}
					if($weeklyHours >= 0){
					?>
					<tr bgcolor="#2E2E2E">
						<td colspan="4" align="right">
							<span style="color:white;"><strong>Weekly Hours:&nbsp;&nbsp;<?php echo(number_format($weeklyHours,2,".","")); ?></strong></span>
						</td>
						<td colspan="3">&nbsp;</td>
					</tr>
					<?php
					}
				?>
              </table>
			  <br /><br />
			</td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
</form>