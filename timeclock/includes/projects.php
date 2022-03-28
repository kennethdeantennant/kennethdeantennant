<?php
	include("../../frzrtime/includes/classes/Project.php");
	$project = new Project();
?>
<form name="frmDaily" method="post" action="../../frzrtime/includes/index.php?page=projects&amp;action=save">
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
					<table cellspacing="0" width="100%">
						<tr>
							<td align="center">
								Project Name:&nbsp;&nbsp;
								<input name="project" id="project"  />
								<input type="submit" value="Save Project" />
							</td>
						</tr>
					</table>
					<p /><p />			
				</td>
			</tr>
			<tr>
				<td>
					<br />
					<table width="90%" align="center" cellspacing="0">
					<tr>
						<td colspan="4">
							<?php
								// Save a new project
								$projectObj = new Project();
								if($_GET["page"] == "project" && isset($_GET["action"]) && $_GET["action"] == "save"){
										$projectObj->save($_POST["project"], $user->getId());
								}
								
								// Record deleted
								if($_GET["page"] == "project" && isset($_GET["action"]) && $_GET["action"]=="remove"){
									if($projectObj->remove($_GET["id"])){
										echo("<span class='notification'>Record removed . . .</span>");
									}
								}
								
								// Update a full name
								if($_GET["page"] == "project" && (isset($_POST["hdnDescription"]) && $_POST["hdnDescription"]<>"") && isset($_GET["property"])){
									switch($_GET["property"])
									{
										case "name":
											$projectObj->setName($_POST["hdnDescription"]);
											if($projectObj->update($_GET["id"], $_GET["property"], $user->getId())){
												echo("<span class='notification'>Record updated for Full Name . . .</span>");
											}
											break;
									}
								}

							?>
						</td>
					</tr>
					<tr class="secondaryHeader">
						<td width="35" align="center">
							RMV						</td>
						<td width="39%">
							Project Name						</td>
						<td>
							Created On - By
						</td>
					</tr>
					<?php
						$projects = $project->getProjects();
						while($projects && $proj = mysql_fetch_array($projects))
						{
					?>
					<tr>
						<td align="center">
							<a href="../../frzrtime/includes/index.php?page=project&amp;action=remove&amp;id=<?php echo($proj["id"]); ?>"><img src="../../frzrtime/includes/images/delete.gif" border /></a>						</td>
						<td>
							<a href="javascript: update(<?php echo($proj["id"]); ?>, 'name')"><?php echo($proj["name"]); ?></a>
						</td>
						<td nowrap="nowrap">
							<?php 
								$createBy = new User();
								$createBy->reload($proj["uid_FK"]);
								echo(date("m/d/Y",strtotime($proj["pdate"]))." - ".$createBy->getFullname()); 	
							?>
						</td>
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
<input type="hidden" name="hdnDescription" id="hdnDescription" value="" />
</form>
<script language="javascript">
function update(id, type){
	var id, type, description, password;
	
	description = prompt("Enter a new value for '"+type+"'.","");
	if(description != "" && description != null){
		document.getElementById("hdnDescription").value = description;
		document.frmDaily.action="index.php?page=projects&property="+type+"&id="+id;
		document.frmDaily.submit();
	}
}
</script>