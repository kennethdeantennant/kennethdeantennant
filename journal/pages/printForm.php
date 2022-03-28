<?php 
	$category=0;
	$from=0;
	$to=0;
	$holdDate='0001-01-01';
	if(isset($_POST["lstCategory"])){
		$category=$_POST["lstCategory"];
	}else if(isset($_GET["cat"])){
		$category=0;
	}
	if(isset($_POST["txtFrom"]) && $_POST["txtFrom"]!=""){
		$from=$_POST["txtFrom"];
	}else if(isset($_GET["from"])){
		$from=$_GET["from"];
	}
	if(isset($_POST["txtTo"]) && $_POST["txtTo"]!=""){
		$to=$_POST["txtTo"];
	}else if(isset($_GET["to"])){
		$to=$_GET["to"];
	}
?>
<script language="JavaScript" src="js/date.js" type="text/javascript"></script>
<script language="JavaScript" src="js/AnchorPosition.js" type="text/javascript"></script>
<script language="JavaScript" src="js/PopupWindow.js" type="text/javascript"></script>
<script language="JavaScript" src="js/CalendarPopup.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript">
//For the calendar
var cal = new CalendarPopup(); 
</script>
<form name='frmPrint' action='' method='post'>
<table width='800' cellpadding='10' cellspacing='0' color='black' align='center' class='page'>
	<tr>
		<td colspan='2' class='heading' align='center'>
			<table width='800' cellpadding='10' cellspacing='0' color='black' align='center' class='data'>
				<tr>
				  <td valign='top'>
						<table cellspacing='0' cellpadding='3' width='100%'>
							<tr valign="top">
								<td width="200">
									<span class="smallText">
									<?php echo($user->getName()); ?>&nbsp;(not you, <a href="javascript: document.frmUpdate.submit();" class="smallLink">logout</a>)
									</span>
								</td>
								<td class="data" align="center">
									<span class='heading'>My Personal Journal</span><br />
									<?php 
										$myDate=date("Y-m-d");
										echo(date("l, F d, Y",mktime(0,0,0,substr($myDate,5,2),substr($myDate,8,2),substr($myDate,0,4))));
									?>
						 		</td>
								<td align='right' width="200">
									<a href="index.php?page=printForm"><img src="images/return.gif" alt="Return to Entry" border="0"></a>
								</td>
							</tr>
						</table>
						<input type='hidden' name='hdnStatus' value='<?php echo($status); ?>'>
							<hr size="1" color="black" />
					  <table width="100%" bordercolor="#CCCCCC" cellpadding="0" cellspacing="0">
                          <tr>
                            <td valign="top">
								<table cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td>
											<table width="100%" class="data">
												<tr>
													<td align="right" nowrap="nowrap">
														Categories:
													</td>
													<td>
														<select name="lstCategory">
														<?php 
															if($category==0){
																echo("<option value=0 selected='selected'>All</option>");
															}else{
																echo("<option value=0>All</option>");
															}
															$result = mysql_query("Select * From journalcat",$db);
															while($result && $myrow=mysql_fetch_array($result))
															{
														?>
															<option value=<?php echo($myrow["jcid"]) ?><?php if($myrow["jcid"]==$category) echo(" selected='selected'") ?>><?php echo($myrow["jcname"]) ?></option>
												<?php } ?>
														</select>
													</td>
												</tr>
												<tr>
													<td align="right" nowrap="nowrap">
														Starting:
													</td>
													<td>
														<A NAME="anchor1" ID="anchor1"> </A>
														<input type="Text" name="txtFrom" size="8" maxsize="15" value="<?php echo($from) ?>">&nbsp;<A href="#anchor1" onClick="cal.select(document.frmPrint.txtFrom,'anchor1','MM-dd-yyyy'); return false;" name="anchor1x" id="anchor1x"><img src="images/cal.gif" alt="calendar" border="0" title="Click on the calendar to enter a date." align="texttop"></a><div id="calDiv"></div>
													</td>
												</tr>
												<tr>
													<td align="right" nowrap="nowrap">
														Ending:
													</td>
													<td>
														<A NAME="anchor1" ID="anchor1"> </A>
															<input type="Text" name="txtTo" size="8" maxsize="15" value="<?php echo($to) ?>">&nbsp;<A href="#anchor1" onClick="cal.select(document.frmPrint.txtTo,'anchor1','MM-dd-yyyy'); return false;" name="anchor1x" id="anchor1x"><img src="images/cal.gif" alt="calendar" border="0" title="Click on the calendar to enter a date." align="texttop"></a><div id="calDiv"></div>
													</td>
												</tr>
												<tr>
													<td>&nbsp;
														
													</td>
													<td>
														<a href="javascript: document.frmPrint.action='index.php?page=printForm&cat=<?php echo($category); ?>&from=<?php echo($from); ?>&to=<?php echo($to); ?>&view=1'; document.frmPrint.submit();"><img src="images/View.gif" alt="View Entries" width="30" height="25" border="0"></a>
													<?php if(isset($_GET["view"])){ ?>
														<?php if(isset($category) && isset($from) && isset($to)){?><a href="index.php?page=printForm&action=p&cat=<?php echo($category); ?>&from=<?php echo($from); ?>&to=<?php echo($to); ?>" target="_blank"><img src="images/print.gif" alt="Print Entry" width="26" height="29" border="0"></a><?php }else{ ?><img src="images/print.gif" alt="Select criteria first." width="26" height="29" border="0"><?php } ?>
													</td>
													<?php } ?>
												</tr>
											</table>
										</td>
										<td align="center">
											<strong>--- Generate Journals ---</strong><p />
											<?php
												$journal = new Journal();
												$results = $journal->getYears($user->getId());
												while($results && $myrow = mysql_fetch_array($results))
												{
											?>
												<a href="pdf/createPDF.php?page=printForm&year=<?php echo($myrow["year"]); ?>&id=<?php echo($user->getId()); ?>" target="_blank" class="smallLink"><?php echo($myrow["year"]); ?></a><img src="images/pdf.gif" alt="Create PDF" width="25" border="0" align="absmiddle">
											<?php } ?>
										</td>
									</tr>
								</table>
								<hr size="1" color="black" />
						</td>
					</tr>
				</table>
				<div class="data">
				<?php
					if($category>0){
						$results = $journal->printByCategory($from, $to, $category, $user->getId());
					}else{
						$results = $journal->printAll($from, $to, $user->getId());
					}
					while($results && $myrow = mysql_fetch_array($results)){
						if($myrow["JDate"]!=$holdDate){
						}
						$holdDate=$myrow["JDate"];
						echo("<blockquote>");
						echo("<strong>[".date("l - F d, Y",mktime(0,0,0,substr($myrow["JDate"],5,2),substr($myrow["JDate"],8,2),substr($myrow["JDate"],0,4))));
						echo(" - <em>".$myrow["jcname"]."</em>]</strong><br>".$myrow["JEntry"]."<p>");
						echo("</blockquote>");
						$fullEntry = $fullEntry.$myrow["JEntry"];
					}
					if(!isset($holdDate) || mysql_num_rows($results)==0){
						echo("<p><div align='center'><em><strong>No entries found...</strong></em></div><p>Directions to print your entries.<ol><li>Select category.</li><li>Click on the calender icons to fill in the From and the To fields.</li><li>Click on the view icon to verify your selection.</li><li>Once you have verified your selection, click on the print button to finish the print process.</li></ol>");
					}
				?>
				</div>
					<input type="hidden" name="hdnText" value="<?php echo($fullEntry); ?>" />
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</form>