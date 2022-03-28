<?php require("../includes/connection.php")?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<!-- DW6 -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>A Tennant Family</title>
<link rel="stylesheet" href="../css/2col_rightNav.css" type="text/css">
</head>
<body topmargin="0" leftmargin="0">
<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td valign="top">
			<?php include("../includes/heading.inc")?>
		</td>
	</tr>
	<tr>
		<td>
			<?php 
				$id=$_GET["event"];
			  	$result = mysqli_query("SELECT * FROM events WHERE Id=$id",$db);
				if ($result && $myrow = mysqli_fetch_array($result))
				{
			?>		
			<div id="content">  
			  <h2 id="pageName"><?php echo($myrow["title"]." Event"); ?></h2> 
			  <div class="feature">
			  <table width="100%">
			  	<tr>
			  <?php 
					echo("<td align='right'><strong>Date:</strong>&nbsp;</td><td>");
					if($myrow["categoryId"]==1)
					{
						printf("%s",date("M",mktime(0,0,0,substr($myrow["date"],5,2),substr($myrow["date"],8,2),substr($myrow["date"],0,4))));
					}else{
						printf("%s-%s-%s",substr($myrow["date"],8,2),date("M",mktime(0,0,0,substr($myrow["date"],5,2),substr($myrow["date"],8,2),substr($myrow["date"],0,4))),substr($myrow["date"],2,2));
					}
					echo("</td></tr><tr><td align='right'><strong>Location:</strong>&nbsp;</td><td>".$myrow["location"]."</td></tr><tr><td align='right' valign='top'><strong>Description:</strong></td><td>".$myrow["description"]."</td>");
			  ?> 
				</tr>
			  </table>

			  <?php 
				}
			  ?> 
				</div> 
			</div> 
		</td>
	</tr>
	<tr>
		<td colspan='2'>
			<div id="masthead">&nbsp;</div>
			<h3 align="Center"><a href="##" onclick='javascript:window.close();'>Close Window</a></h3>
		</td>
	</tr>
</table>
</body>
</html>
