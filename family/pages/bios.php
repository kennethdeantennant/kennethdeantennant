<?php
	include("../classes/Connection.php");
	include("../classes/Biography.php");
	include("../classes/BiographyFamily.php");
	
	$biography = new Biography();
	$biofamily = new BiographyFamily();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- DW6 -->
<head>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tennant Family Biographies</title>
<link rel="stylesheet" href="../css/emx_nav_right.css" type="text/css" />
<link rel="icon" href="../images/favicon.ico">
<script type="text/javascript">
<!--
var time = 3000;
var numofitems = 7;

//menu constructor
function menu(allitems,thisitem,startstate){ 
  callname= "gl"+thisitem;
  divname="subglobal"+thisitem;  
	this.numberofmenuitems = allitems;
	this.caller = document.getElementById(callname);
	this.thediv = document.getElementById(divname);
	this.thediv.style.visibility = startstate;
}
				 
//menu methods
function ehandler(event,theobj){
  for (var i=1; i<= theobj.numberofmenuitems; i++){
	  var shutdiv =eval( "menuitem"+i+".thediv");
    shutdiv.style.visibility="hidden";
	}
	theobj.thediv.style.visibility="visible";
}
				
function closesubnav(event){
  if ((event.clientY <48)||(event.clientY > 107)){
    for (var i=1; i<= numofitems; i++){
      var shutdiv =eval('menuitem'+i+'.thediv');
			shutdiv.style.visibility='hidden';
		}  
	}
}
// -->
</script>
</head>
<body>
<div class="skipLinks">skip to: <a href="#content">page content</a> | <a href="#pageNav">links on this page</a> | <a href="#globalNav">site navigation</a> | <a href="#siteInfo">footer (site information)</a> </div>
<div id="masthead">
  <h1 id="siteName">A Tennant Family</h1>
  <div id="date"><?php echo date("l")?>,&nbsp;<?php echo date("M")?>&nbsp;<?php echo date("d")?>,&nbsp;<?php echo date("Y")?></div>
  <div id="globalNav"> <img alt="" src="../images/gblnav_left.gif" height="32" width="4" id="gnl" /> <img alt="" src="../images/glbnav_right.gif" height="32" width="4" id="gnr" />
    <div id="globalLink"><a href="bios.php?family=0&amp;individual=0" class="glink">All</A>
      <?php
		$family = $_GET["family"];
		$individual = $_GET["individual"];
		
		// Get Individual ID
		if($individual==0) $individual = $biography->getIndividualID($family);
		
	  	$result = $biofamily->getFamilies();
		while ($result and $myrow = mysqli_fetch_array($result)){
			printf(" <a href='bios.php?family=%s&individual=0' class='glink'>%s</A>",$myrow["Id"],$myrow["name"]);
		}
	  ?></div>
    <!--end globalLinks-->
  </div>
  <!-- end globalNav -->
  <div id="subglobal1" class="subglobalNav"> <a href="#">subglobal1 link</a> | <a href="#">subglobal1 link</a> | <a href="#">subglobal1 link</a> | <a href="#">subglobal1 link</a> | <a href="#">subglobal1 link</a> | <a href="#">subglobal1 link</a> | <a href="#">subglobal1 link</a> </div>
  <div id="subglobal2" class="subglobalNav"> <a href="#">subglobal2 link</a> | <a href="#">subglobal2 link</a> | <a href="#">subglobal2 link</a> | <a href="#">subglobal2 link</a> | <a href="#">subglobal2 link</a> | <a href="#">subglobal2 link</a> | <a href="#">subglobal2 link</a> </div>
  <div id="subglobal3" class="subglobalNav"> <a href="#">subglobal3 link</a> | <a href="#">subglobal3 link</a> | <a href="#">subglobal3 link</a> | <a href="#">subglobal3 link</a> | <a href="#">subglobal3 link</a> | <a href="#">subglobal3 link</a> | <a href="#">subglobal3 link</a> </div>
  <div id="subglobal4" class="subglobalNav"> <a href="#">subglobal4 link</a> | <a href="#">subglobal4 link</a> | <a href="#">subglobal4 link</a> | <a href="#">subglobal4 link</a> | <a href="#">subglobal4 link</a> | <a href="#">subglobal4 link</a> | <a href="#">subglobal4 link</a> </div>
  <div id="subglobal5" class="subglobalNav"> <a href="#">subglobal5 link</a> | <a href="#">subglobal5 link</a> | <a href="#">subglobal5 link</a> | <a href="#">subglobal5 link</a> | <a href="#">subglobal5 link</a> | <a href="#">subglobal5 link</a> | <a href="#">subglobal5 link</a> </div>
  <div id="subglobal6" class="subglobalNav"> <a href="#">subglobal6 link</a> | <a href="#">subglobal6 link</a> | <a href="#">subglobal6 link</a> | <a href="#">subglobal6 link</a> | <a href="#">subglobal6 link</a> | <a href="#">subglobal6 link</a> | <a href="#">subglobal6 link</a> </div>
  <div id="subglobal7" class="subglobalNav"> <a href="#">subglobal7 link</a> | <a href="#">subglobal7 link</a> | <a href="#">subglobal7 link</a> | <a href="#">subglobal7 link</a> | <a href="#">subglobal7 link</a> | <a href="#">subglobal7 link</a> | <a href="#">subglobal7 link</a> </div>
  <div id="subglobal8" class="subglobalNav"> <a href="#">subglobal8 link</a> | <a href="#">subglobal8 link</a> | <a href="#">subglobal8 link</a> | <a href="#">subglobal8 link</a> | <a href="#">subglobal8 link</a> | <a href="#">subglobal8 link</a> | <a href="#">subglobal8 link</a> </div>
</div>
<!-- end masthead -->
<div id="pagecell1">
  <!--pagecell1-->
  <img alt="" src="../images/tl_curve_white.gif" height="6" width="6" id="tl" /> <img alt="" src="../images/tr_curve_white.gif" height="6" width="6" id="tr" />
  <div id="breadCrumb"></div>
  <div id="pageName">
    <h2>
      <?php
		  	$biography->load($individual);
			echo("History of ".$biography->getName());
		?>
    </h2>
  </div>
  <div id="pageNavBio">
    
    <div class="relatedLinks">
        <?php
			if($family==0)
			{
			  	$result = $biography->getAllBiographies($family, $individual);
			}else{
				echo("<SPAN class=names>");
				$biofamily->load($family);
				echo("<br><h3>".$biofamily->getName()."</h3>");
				echo("</SPAN>");
			  	$result = $biography->getBiographies($family, $individual);
			}
			$familyId = "";
		  	while ($result and $myrow = mysqli_fetch_array($result))
			{
				if($familyId<>$myrow["famId"] and $family==0)
				{
					$nameId = $myrow["famId"];
					echo("<SPAN class=names>");
					$biofamily->load($nameId);
					echo("<br><h3>".$biofamily->getName()."</h3>");
					echo("</SPAN>");
				}
				
				printf("<A href='bios.php?family=$family&individual=%s' title='Click to read history'>%s</A>",$myrow["Id"],$myrow["name"]);	
			  	$familyId = $myrow["famId"];
			}
		  ?>
    </div>
  </div>
  <div id="content">
    <div class="feature">
      <?php
	  		$biography->load($individual);
			if($biography->getAuthor()!=""){
				echo("<em>Written / Compiled by ".$biography->getAuthor()."</em>");
			}
			
			if($biography->getPicture()!=""){
				printf("<img alt='' src='../images/%s'>",$biography->getPicture());
			}
			
			if($biography->getText()!=""){
				//echo("<textarea>".$biography->getText()."</textarea>");
				echo($biography->getText());
			}
			
			if($biography->getLink()!=""){
				echo("<div align='right'><a href='".$biography->getLink()."' target='_blank'>".$biography->getLink()."</a></div><hr />");
			}
		?>
    </div>
  </div>
    <div class="story">
      <table width='100%' cellpadding='0' cellspacing='0'>
        <tr>
          <td valign="top"><h3>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" target="_top">^Top</a></h3></td>
          <td align='center'><span style="font-size: 12px; font-style: italic;">If you would like to get a copy of this document, send an email to
            <h3><a href="mailto:kstennant@cableone.net">kstennant@cableone.net</a></h3>          </td>
        </tr>
      </table>
    </div>
</div>
  <!--end content -->
<div id="siteInfo"></div>
</div>
<!--end pagecell1-->
<br />

</body>
</html>
