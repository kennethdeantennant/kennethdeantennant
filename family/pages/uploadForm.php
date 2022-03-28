<?php require("../includes/connection.php")?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- DW6 -->
<head>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tennant Overview</title>
<link rel="stylesheet" href="../css/emx_nav_right.css" type="text/css" />
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
    <div id="globalLink">
    <?php include("../includes/heading.inc") ?></div>
    <!--end globalLinks-->
    <!--<form id="search" action="">
      <input name="searchFor" type="text" size="10" />
      <a href="">search</a>
    </form>-->
  </div>
  <!-- end globalNav -->
</div>
<!-- end masthead -->
<div id="pagecell1">
  <!--pagecell1-->
  <img alt="" src="../images/tl_curve_white.gif" height="6" width="6" id="tl" /> <img alt="" src="../images/tr_curve_white.gif" height="6" width="6" id="tr" />
  <div id="breadCrumb"></div>
  <div id="pageName">
    <h2>Picture Upload </h2>
  </div>
  <div id="content">
    <div class="story">
      <table width="100%" cellpadding="0" cellspacing="0" summary="">
        <tr valign="top">
          <td class="storyLeft">
            <p> <a href="#" class="capsule">Instruction</a>Before saving your picture, be sure to resize the pic </p>          </td>
        </tr>
      </table>
    </div>
    <div class="feature">
    <form name="frmUpload" action="upload.php" method="post">
		  <table align="center" border="1">
			<tr>
			  <td align="right"> Category </td>
			  <td><select name="category">
				  <?php 
						$result = mysqli_query("SELECT * FROM pictures_category WHERE Id<6",$db);
						while ($result && $myrow = mysqli_fetch_array($result))
						{
							printf("<option value='%s'>%s</option>",$myrow["Id"],$myrow["Description"]);
						}
					?>
				</select>
			  </td>
			</tr>
			<tr>
			  <td align="right"> Subcategory </td>
			  <td><select name="subcategory">
				  <option value="0">-- Select If Needed --</option>
				  <?php 
						$result = mysqli_query("SELECT * FROM pictures_category WHERE Id>5",$db);
						while ($result && $myrow = mysqli_fetch_array($result))
						{
							printf("<option value='%s'>%s</option>",$myrow["Id"],$myrow["Description"]);
						}
					?>
				</select>
			  </td>
			</tr>
			<tr>
			  <td align="right"> Photo Title </td>
			  <td><input name="title" size="50" maxlength="100" />
			  </td>
			</tr>
			<tr>
			  <td align="right"> File Browse </td>
			  <td><input name="file" type="file" size="50" />
			  </td>
			</tr>
			<tr>
				<td align="right">Send Email </td>
				<td>
					<input name="send" type="checkbox"/>
				</td>
			</tr>
			<tr>
			  <td align="right">&nbsp;</td>
			  <td><input name="submit" type="submit" value="Upload File" />
			  </td>
			</tr>
		  </table>
		  </form>
    </div>
    <div class="story">
      <h3>&nbsp;</h3>
    </div>
  </div>
  <!--end content -->
  <div id="siteInfo">
    <div align="center"><span class="photoBorder">
      <?php include("../includes/updated.inc") ?>
      </span></div>
  </div>
</div>
<!--end pagecell1-->
<br />

</body>
</html>
