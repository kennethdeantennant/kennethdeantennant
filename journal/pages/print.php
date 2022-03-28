<?php $holdDate='0001-01-01'; ?>
<html>
<head>
	<title>My Journal - Print</title>
	<link rel="stylesheet" href="styles/journal.css" type="text/css">
</head>

<body bgcolor='#eee8aa'>
<table width='100%' cellpadding='10' cellspacing='0' color='black'>
	<tr>
		<td colspan='2' valign='top'>
			<table width='700' cellpadding='10' cellspacing='0' color='black' class='data'>
				<tr>
					<td valign='top'>
						<?php
							$category=0;
							$from=date("Y-m-d");
							$to=date("Y-m-d");
							if(isset($_GET["from"])) $from=$_GET["from"];
							if(isset($_GET["to"])) $to=$_GET["to"];
							if(isset($_GET["cat"])) $category=$_GET["cat"];
							if(isset($_POST["lstCategory"])) $category=$_POST["lstCategory"];
							if(isset($_POST["txtFrom"]) && $_POST["txtFrom"]!="") $from=$_POST["txtFrom"];
							if(isset($_POST["txtTo"]) && $_POST["txtTo"]!="") $to=$_POST["txtTo"];
							if($category>0){
								$results = $journal->printByCategory($from, $to, $category, $user->getId());
							}else{
								$results = $journal->printAll($from, $to, $user->getId());
							}
							while($results && $myrow=mysql_fetch_array($results)){
								if($myrow["JDate"]!=$holdDate){
						?>
							<strong>
							<?php 
								echo(date("l - F d, Y",mktime(0,0,0,substr($myrow["JDate"],5,2),substr($myrow["JDate"],8,2),substr($myrow["JDate"],0,4))));?>
							</strong>
							<hr size='1' color='black'>
							<?php
									}
									$holdDate=$myrow["JDate"];
									echo("<blockquote>");
									printf("<strong>[%s]</strong><br>%s<p>",$myrow["jcname"],$myrow["JEntry"]);
									echo("</blockquote>");
								}
							?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<script language='javascript'>
	window.print();
	setTimeout("window.close();",1000);
</script>
</body>
</html>