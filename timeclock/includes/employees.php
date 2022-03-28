<?php
	include("../../frzrtime/includes/classes/Utilities.php");
	$utilities = new Utilities();
	
	include("../../frzrtime/includes/classes/Timesheet.php");
	$timesheet = new Timesheet();
	$employees = $user->getEmployees();
	
	include("../../frzrtime/includes/classes/Project.php");
	$projectObj = new Project();
	
	if(!isset($_GET["id"]) && isset($_GET["date"])) $utilities->excelExport($_GET["date"]);
?>
<script language="javascript">
	function NewSearch()
	{
		var id, date;
		
		id = document.getElementById("user").value;
		date = document.getElementById("date").value;
		document.frmDaily.action='index.php?page=employees&id='+id+'&date='+date;
		document.frmDaily.submit();
	}
	
	function Report()
	{
		var date;
		
		date = document.getElementById("date").value;
		window.open('includes/spreadsheet.php?date='+date,'Frazier Timesheet','width=0,height=0')
	}
</script>
<form name="frmDaily" method="post" action="../../frzrtime/includes/index.php?page=timesheet&amp;action=save">
<input type="hidden" value="submit" name="act" id="act">
<input type="hidden" value="" name="time_cd" id="time_cd">
<input type="hidden" value="" name="beg_time" id="beg_time" />
<input type="hidden" value="" name="end_time" id="end_time" />
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
	<td colspan="5">
		<table width="100%" align="center" cellpadding="3" cellspacing="0" bgcolor="white">
			<tr>
				<td class="row">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td width="33%" nowrap="nowrap" valign="top">
								<a href="../../frzrtime/includes/index.php?page=employee" target="_blank">Add Employee</a>
							</td>
							<td width="34%" align="center" nowrap="nowrap">&nbsp;
								
							</td>
							<td width="33%" align="right" valign="top" nowrap="nowrap">
								<a href="javascript: window.close();">Close Window</a>
							</td>
						</tr>
					</table>
					<br />
					<table width="100%" align="center">
						<tr>
							<td align="center">
								<?php 
									$sdate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-date("w"), date("Y")));
									if(isset($_GET["date"])) $sdate = $_GET["date"];
								?>
								<select name="date" id="date" onchange="javascript: document.getElementById('btnSearch').disabled='';">
								<?php
								
									$dates = $utilities->getDates($sdate);
									foreach($dates as $date)
									{
								?>
									<option value="<?php echo($date); ?>" <?php if($date<=$sdate) echo("selected='selected'"); ?>>View the Week of <?php echo(date("m/d/Y",strtotime($date))); ?></option>
								<?php
									}
								?>
								</select>
								<select name="user" id="user" onchange="javascript: document.getElementById('btnSearch').disabled='';">
								<?php
									$uid = $user->getId();
									if(isset($_GET["id"])) $uid = $_GET["id"];
									
									while($employees && $employee = mysql_fetch_array($employees))
									{
								?>
									<option value="<?php echo($employee["id"]); ?>" <?php if($employee["id"]==$uid) echo("selected='selected'"); ?>>for <?php echo($employee["fullname"]); ?></option>
								<?php
									}
								?>
								</select>
								<input name="btnSearch" id="btnSearch" type="button" onclick="javascript: NewSearch();" value="Execute Weekly Search" disabled="disabled" />
								<input name="btnReport" id="btnReport" type="button" onclick="javascript: Report();" value="View Weekly Report" />
								<p /><p />
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center">
						<tr>
							<td>
								<br />
								<?php 
									if(isset($_GET["page"]) && isset($_GET["action"]) && $_GET["action"] == "save")
									{
										if($timesheet->saveEntry($_POST["txtDateStart"],$_POST["txtDateEnd"],$_POST["note"],$user->getId()))
											{
												echo("<span class='notification'>Record saved . . .</span>");
											}
									}
								?>
								<br />
								<table width="90%" cellspacing="0" cellpadding="5" bordercolor="#663300" align="center">
								<tr class="secondaryHeader">
								  <td width="75">Date</td>
								  <td width="75">Punch</td>
								  <td width="75" align="right">Time</td>
								  <td width="75" align="right">Hours</td>
								  <td>Project</td>
								  <td>Notes</td>
								  <td align="right"><a href="../../frzrtime/includes/index.php?page=newentry&amp;day=<?php echo($sdate); ?>" title="add a missing entry for the week" class="main" target="_blank">Add</a></td>
								</tr>
								<?php
									if($timesheet->entriesExist($sdate,$uid))
									{
										$timeEntries = $timesheet->getWeeklyEntries($uid, $sdate);
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
									</td>
								</tr>
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
										<?php
											if($timeEntry["pid_FK"] != null && $timeEntry["pid_FK"]>0 && $projectObj->load($timeEntry["pid_FK"])) echo($projectObj->getName());
										?>
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
									</td>
								</tr>
								<?php
											$weeklyHours+=$totalHours;
										}
									}else{
										echo("<tr><td colspan='5' nowrap='nowrap'><br /><blockquote><em>No entries exist for the week selected...</em></blockquote></td></tr>");
									}
									if($weeklyHours >= 0){
								?>
								<tr bgcolor="#2E2E2E">
									<td colspan="4" align="right">
										<span style="color:white;"><strong>Weekly Hours:&nbsp;&nbsp;<?php echo(number_format($weeklyHours,2,".","")); ?></strong></span>
									</td>
									<td colspan="4">&nbsp;</td>
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
	</td>
  </tr>
</table>
</form>