<?php
	include("../../frzrtime/includes/classes/Timesheet.php");
	$timesheet = new Timesheet();
	
	include("../../frzrtime/includes/classes/Project.php");
	$projectObj = new Project();
	
	$today = $_GET["day"];
	if(isset($_POST["txtDate"])) $today=date("Y-m-d",strtotime($_POST["txtDate"]));
	
	if(isset($_GET["action"]) && $_GET["action"]=="save"){
		$pdate = date("Y-m-d",strtotime($_POST["txtDate"]));
		if(isset($_POST["hdnReason"]) && $_POST["hdnReason"]!="")
		{
			$timesheet->saveTimeReason($pdate,$_POST["lstHour"],$_POST["lstMinute"],$_POST["lstType"],$user->getId(),$_POST["hdnReason"]);
		}else{
			$timesheet->saveTime($pdate,$_POST["lstHour"],$_POST["lstMinute"],$_POST["lstType"],$user->getId());
		}
	}
	
	// Delete a time entry
	if(isset($_GET["action"]) && $_GET["action"] == "delete"){
			$timesheet->delete($_GET["id"]);
	}
?>
<form name="frmDaily" method="post" action="../../frzrtime/includes/index.php?page=newentry&amp;day=<?php echo($today); ?>&amp;action=save&amp;goto=newentry">
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
				<td class="row">
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
					<table align="center" cellspacing="0" width="500">
						<tr>
							<td>
								Date
							</td>
							<td>
								Hour
							</td>
							<td>
								Minute
							</td>
							<td>
								Type
							</td>
						</tr>
						<tr>
							<td>
								<A NAME="anchor1" ID="anchor1"> </A>
		<input type="Text" name="txtDate" size="8" maxsize="15" value="<?php echo(date("m/d/Y",strtotime($today))); ?>">&nbsp;<A href="#anchor1" onClick="cal.select(document.frmDaily.txtDate,'anchor1','MM/dd/yyyy'); return false;" name="anchor1x" id="anchor1x"><img src="../../frzrtime/includes/images/cal.gif" alt="calendar" border="0" title="Click on the calendar to enter a date." align="absmiddle"></a><div id="calDiv1"></div>
							</td>
							<td nowrap="nowrap">
								<select name="lstHour">
									<option value=1>1 AM</option>
									<option value=2>2 AM</option>
									<option value=3>3 AM</option>
									<option value=4>4 AM</option>
									<option value=5>5 AM</option>
									<option value=6>6 AM</option>
									<option value=7>7 AM</option>
									<option value=8>8 AM</option>
									<option value=9>9 AM</option>
									<option value=10>10 AM</option>
									<option value=11>11 AM</option>
									<option value=12>12 AM</option>
									<option value=13>1 PM</option>
									<option value=14>2 PM</option>
									<option value=15>3 PM</option>
									<option value=16>4 PM</option>
									<option value=17>5 PM</option>
									<option value=18>6 PM</option>
									<option value=19>7 PM</option>
									<option value=20>8 PM</option>
									<option value=21>9 PM</option>
									<option value=22>10 PM</option>
									<option value=23>11 PM</option>
									<option value=24>12 PM</option>
								</select>
							</td>
							<td>
								<select name="lstMinute">
								<?php
									for ( $counter = 0; $counter < 60; $counter += 1) {
										if($counter<10)
										{
											echo("<option value='$counter'>0$counter</option>");
										}else{
											echo("<option value='$counter'>$counter</option>");
										}
									}
								?>
								</select>
							</td>
							<td>
								<select name="lstType" onchange="checkAbsent(this.value)">
									<option value="I">IN</option>
									<option value="L">LUNCH</option>
									<option value="O">OUT</option>
									<option value="S">START</option>
									<option value="E">END</option>
								</select>
							</td>
							<td>
								<input type="submit" value="Save Entry" />
							</td>
						</tr>
					</table>
					<p /><p />
				</td>
			</tr>
			<tr>
				<td>
					<br />
					<table width="90%" cellspacing="0" cellpadding="5" bordercolor="#663300" align="center">
						<tr class="secondaryHeader">
							<td>RMV</td>
							<td width="75">Punch</td>
							<td width="75" align="right">Time</td>
							<td width="75" align="right">Hours</td>
							<td>Project</td>
							<td colspan="2">Notes</td>
						</tr>
						<?php
							$weeklyHours = 0;
							if($timesheet->entriesExist($today,$user->getId()))
							{
								$timeEntries = $timesheet->getDayEntries($user->getId(), $today);
								while ($timeEntries && $timeEntry = mysql_fetch_array($timeEntries))
								{
						?>
						<tr>
							<td>
								<a href="../../frzrtime/includes/index.php?page=newentry&amp;action=delete&amp;id=<?php echo($timeEntry["id"]); ?>&amp;day=<?php echo($today); ?>&amp;goto=newentry"><img src="../../frzrtime/includes/images/delete.gif" border="0" /></a>
							</td>
							<td width="75" nowrap="nowrap">
								<?php
									if($timeEntry["type"] == "I") echo("<strong>IN</strong>");
									if($timeEntry["type"] == "L") echo("<strong>LUNCH</strong>");
									if($timeEntry["type"] == "O") echo("<strong>OUT</strong>");
									if($timeEntry["type"] == "X") echo("<strong>ABSENT</strong>");
	
								?>					</td>
							<td width="75" align="right" nowrap="nowrap"><?php echo(date("h:i a",strtotime($timeEntry["ptime"]))); ?></td>
							<td width="75" align="right">
								<?php 
									if($timeEntry["hours"] == 0){
										echo("&nbsp;");
									}else{
										echo($timeEntry["hours"]);
									}
								?>
							</td>
							<td nowrap="nowrap">
								<?php if($timeEntry["pid_FK"] != null && $timeEntry["pid_FK"]>0 && $projectObj->load($timeEntry["pid_FK"])) echo($projectObj->getName()); ?>
							</td>
							<td nowrap="nowrap"><em><?php echo($timeEntry["note"]) ?></em></td>
							<td align="right"><?php if($timeEntry["type"] != "I" && $timeEntry["type"] != "X" && $timeEntry["project"] == null) echo("<a href='index.php?page=assignment&tid=".$timeEntry["id"]."&goto=newentry&day=".$today."' title='assign the time to project(s)'>[assign]</a>"); ?></td>
						</tr>
						 <?php
								}
								$totalHours = $timesheet->getDailyHours($today, $user->getId());
								if($totalHours > 0)
								{
						?>
						<tr bgcolor="#E5E5E5">
							<td colspan="3" align="right">
								<strong>Total Hours:&nbsp;&nbsp;<?php echo($totalHours); ?></strong>
							</td>
							<td colspan="4">&nbsp;
								
							</td>
						</tr>
						<?php
								}
							}else{
								echo("<tr><td colspan='5' nowrap='nowrap'><br /><blockquote><em>No entries exist for the week selected...</em></blockquote></td></tr>");
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
<input type="hidden" name="hdnReason" id="hdnReason" />
</form>
<script language="javascript">
function checkAbsent(type){
	var type,reason;
	
	if(type=="X"){
		reason = prompt("Enter reason for absence below...");
		if(reason != ""){
			document.getElementById("hdnReason").value = reason;
		}
	}
}
</script>