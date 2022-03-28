<?php
	include("../../frzrtime/includes/classes/Project.php");
	include("../../frzrtime/includes/classes/Timesheet.php");
	
	$projectObj = new Project();
	$timesheet = new Timesheet();
	$sdate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-date("w"), date("Y")));
	if(isset($_POST["hdnType"]) && $_POST["hdnType"] == "a"){
		$timesheet->saveAssignment($_POST["lstUnassigned"],$_GET["tid"]);
	}
	
	if(isset($_POST["hdnType"]) && $_POST["hdnType"] == "u"){
		$timesheet->removeAssignment($_POST["lstAssigned"],$_GET["tid"]);
	}
?>
<form action="../../frzrtime/includes/index.php?page=assignment&amp;tid=<?php echo($_GET["tid"]) ?>&amp;goto=<?php echo($_GET["goto"]); ?>&amp;day=<?php if(isset($_GET["day"])) echo($_GET["day"]); ?>" method="post" name="frmAssignment">
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
	<td colspan="3">
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
								<a href="../../frzrtime/includes/index.php?page=<?php echo($_GET["goto"]); ?>&amp;goto=<?php echo($_GET["goto"]); if($_GET["goto"]=="punchmissed" || $_GET["goto"]=="newentry") echo("&day=".$_GET["day"]); ?>">Return</a>
							</td>
						</tr>
					</table>
					<br />
					<table cellspacing="0" cellpadding="5px" align="center">
						<tr>
							<td height="10" colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3" class="secondaryHeader" align="center">
								<?php
									$timesheet->load($_GET["tid"]);
									if($timesheet->getType() == "I") echo("<strong>IN</strong>");
									if($timesheet->getType() == "L") echo("<strong>LUNCH</strong>");
									if($timesheet->getType() == "O") echo("<strong>OUT</strong>");
									if($timesheet->getType() == "X") echo("<strong>ABSENT</strong>");
									echo(date(" - m/d/Y",strtotime($timesheet->getDate()))." (".date("h:i a",strtotime($timesheet->getTime())).")");
								?>
							</td>
						</tr>
						<tr>
							<td>
								Unassigned:<br />
								<select name="lstUnassigned" size="10" class="selectionBox">
								<?php
									$projects = $projectObj->getUnassignedProject($_GET["tid"]);
									while($projects && $project = mysql_fetch_array($projects))
									{
								?>
									<option value="<?php echo($project["id"]); ?>" ><?php echo($project["name"]); ?></option>
								<?php
									}
								?>
								</select>
							</td>
							<td>
								<input type="submit" name="a" value="assign >>" onclick="actionButton(this.name)" <?php if($timesheet->isAssigned($_GET["tid"])) echo("disabled='disabled'"); ?> />
								<p />
								<input type="submit" name="u" value="<< remove" onclick="actionButton(this.name)" <?php if(!$timesheet->isAssigned($_GET["tid"])) echo("disabled='disabled'"); ?> />
						  </td>
							<td>
								Assigned:<br />
								<select name="lstAssigned" size="10" class="selectionBox">
								<?php
									$projects = $projectObj->getAssignedProject($_GET["tid"]);
									while($projects && $project = mysql_fetch_array($projects))
									{
								?>
									<option value="<?php echo($project["id"]); ?>" ><?php echo($project["name"]); ?></option>
								<?php
									}
								?>
								</select>
							</td>
						</tr>
				  	</table>
				</td>
			</tr>
		</table>
	</td>
  </tr>
</table>
<input type="hidden" name="hdnType" id="hdnType" />
</form>

<script language="javascript">
function actionButton(type){
	var type;
	document.getElementById('hdnType').value=type; 
}
</script>