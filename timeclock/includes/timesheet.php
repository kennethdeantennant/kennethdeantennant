<?php
	include("../../frzrtime/includes/classes/Timesheet.php");
	include("../../frzrtime/includes/classes/Project.php");
	
	$timesheet = new Timesheet();
	// Save a time entry
	if($_GET["page"] == "timesheet" && isset($_GET["type"])){
		$timesheet->save($_POST["project"],$_GET["type"],$user->getId(),$_POST["hdnDescription"]);
	}
		
	// Delete a time entry
	if($_GET["page"] == "timesheet" && isset($_GET["action"]) && $_GET["action"] == "delete"){
			$timesheet->delete($_GET["id"]);
	}
		
	$projectObj = new Project();
	$sdate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-date("w"), date("Y")));
?>

<form name="frmDaily" method="post" action="">
<table width="100%" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td colspan="2" bgcolor="#FFFFFF" background="../../frzrtime/includes/images/filler.JPG">
			<img src="images/logo.jpg" />
		</td>
		<td background="images/filler.JPG">
			<strong><?php echo(date("l, F jS, Y")); ?></strong>
		</td>
	</tr>
	<tr>
	<td colspan="3">
		<table width="100%" align="center" cellpadding="3" cellspacing="0" bgcolor="white">
			<tr>
				<td height="10px" nowrap="nowrap" colspan="2" valign="top" class="row">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td width="33%" nowrap="nowrap" valign="top">
								<span class="smalltext">(not <?php echo($user->getName()); ?> - <a href="index.php" class="log">Logout</a>)</span>
							</td>
							<td width="34%" align="center" nowrap="nowrap">&nbsp;
								
							</td>
							<td width="33%" align="right" valign="top" nowrap="nowrap">
								<strong><a href="../../frzrtime/includes/index.php?page=history" target="_blank">The Week</a><?php if($user->getAuthority() == "m"){ ?> |	<a href="../../frzrtime/includes/index.php?page=employees" target="_blank">Employees</a> | <a href="index.php?page=projects" target="_blank">Projects</a>&nbsp;<?php } ?></strong>
							</td>
						</tr>
					</table>
					<br />
					<strong><?php echo("Welcome ".$user->getFullname()); ?></strong>
					<table cellspacing="0" cellpadding="5px" align="center">
						<tr>
							<td height="10" colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td align="center">
								<input name="pin" id="pin" type="button" onclick="punchMade('I')" class="punch" value="In" <?php if($timesheet->punchCheck(date("Y-m-d"),"I",$user->getId())) echo("disabled='disabled'") ?> />
								<input name="plunch" id="plunch" type="button" onclick="punchMade('L')" class="punch" value="Lunch" <?php if($timesheet->punchCheck(date("Y-m-d"),"L",$user->getId())) echo("disabled='disabled'") ?> />
								<input name="pout" id="pout" type="button" onclick="punchMade('O')" class="punch" value="Out" <?php if($timesheet->punchCheck(date("Y-m-d"),"O",$user->getId())) echo("disabled='disabled'") ?> />
								<p />
								<select name="project" id="project" <?php if($timesheet->punchCheck(date("Y-m-d"),"O",$user->getId())) echo("disabled='disabled'") ?>>
									<option value="">--- Select Project ---</option>
									<?php
										$projects = $projectObj->getProjects();
										while($projects && $project = mysql_fetch_array($projects))
										{
									?>
										<option value="<?php echo($project["id"]); ?>" ><?php echo($project["name"]); ?></option>
									<?php
										}
									?>
								</select>
								<input name="pstart" id="pstart" type="button" onclick="punchMade('S')" class="punch" value="Start" <?php if($timesheet->punchCheck(date("Y-m-d"),"S",$user->getId())) echo("disabled='disabled'") ?> />
								<input name="pend" id="pend" type="button" onclick="punchMade('E')" class="punch" value="End" <?php if($timesheet->punchCheck(date("Y-m-d"),"E",$user->getId())) echo("disabled='disabled'") ?> />
							</td>
						</tr>
				  </table>
				</td>
			</tr>
			<tr>
				<td height="10" colspan="2">
					<?php
						if($_GET["page"] == "timesheet" && isset($_GET["type"])){
								echo("<span class='notification'>Record saved . . .</span>");
							}
							
						if($_GET["page"] == "timesheet" && isset($_GET["action"]) && $_GET["action"] == "delete"){
								echo("<span class='notification'>Record deleted . . .</span>");
							}
					?>				</td>
			</tr>
			<tr>
			  <td><table width="100%" cellspacing="0" cellpadding="5" bordercolor="#663300" align="center">
			  		<tr>
						<td colspan="5" nowrap="nowrap">
							<?php
								echo("<strong>Date: ".date("m/d/Y",strtotime($timeEntry["pdate"]))."</strong>");
								$holdDate=$timeEntry["pdate"];
							?>
						</td>
					</tr>
					<tr class="secondaryHeader">
					  <td width="32" align="center">RMV</td>
					  <td width="75">Punch</td>
					  <td width="75" align="right">Time</td>
					  <td width="75" align="right">Hours</td>
					  <td>Project</td>
					  <td>Notes</td>
					</tr>
                <?php
					if($timesheet->entriesExist($sdate, $user->getId()))
					{
						$timeEntries = $timesheet->getDailyEntries($user->getId(),$sdate);
						while ($timeEntries && $timeEntry = mysql_fetch_array($timeEntries))
						{
							$exist = true;
				?>
                <tr>
					<td align="center" width="32">
						<?php
							if($timeEntry["pdate"] == date("Y-m-d"))
							{
						?>
								<a href="../../frzrtime/includes/index.php?page=timesheet&amp;action=delete&amp;id=<?php echo($timeEntry["id"]); ?>"><img src="../../frzrtime/includes/images/delete.gif" border="0" /></a>
						<?php }else{ echo("&nbsp;"); } ?>					</td>
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
							if($timeEntry["pid_FK"] != null && $projectObj->load($timeEntry["pid_FK"])) echo($projectObj->getName()); ?>
					</td>
					<td nowrap="nowrap"><em><?php echo($timeEntry["note"]) ?></em></td>
                </tr>
				 <?php
						}
						$totalHours = $timesheet->getDailyHours(date("Y-m-d"),$user->getId());
						if($totalHours > 0)
						{
					?>
					<tr bgcolor="#E5E5E5">
						<td colspan="4" align="right">
							<strong>Total Hours:&nbsp;&nbsp;<?php echo($totalHours); ?></strong>
						</td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<?php
						}
					}
					
					if(!$exist) echo("<tr><td colspan='4' nowrap='nowrap'><br /><blockquote><em>No entries exist for today...</em></blockquote></td></tr>");						
					?>
              </table></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<input type="hidden" name="hdnDescription" id="hdnDescription" value="" />
</form>
<script language="javascript">
function punchMade(type){
	var type,description;
	
	if(document.getElementById("project").value=="" && (type=="S" || type=="E")){
		alert("No project description selected.");
	}else{
		document.frmDaily.action="index.php?page=timesheet&type="+type;
		
		switch(type)
		{
			case "I":
				if(confirm("Click OK to confirm your punch IN action.")){
					document.frmDaily.submit();
				}
				break;
			case "L":
				if(confirm("Click OK to confirm your punch LUNCH action.")){
					document.frmDaily.submit();
				}
				break;
			case "O":
				if(confirm("Click OK to confirm your punch OUT action.")){
					document.frmDaily.submit();
				}
				break;
			case "S":
				if(confirm("Click OK to confirm your punch START PROJECT action.")){
					document.frmDaily.submit();
				}
				break;
			case "E":
				if(confirm("Click OK to confirm your punch END PROJECT action.")){
					document.frmDaily.submit();
				}
				break;
			case "X":
				if(confirm("Click OK to confirm your punch ABSENT action.")){
					description = prompt("Enter a reason for your absence. . .","");
					if(description != null && description != "")
					{
						document.getElementById("hdnDescription").value = description;
						document.frmDaily.submit();
					}
				}
				break;
		}
	}
}
</script>