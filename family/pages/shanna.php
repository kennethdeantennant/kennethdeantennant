<?php 
	include("../classes/Connection.php");
	include("../classes/Pictures.php");
	
	$pictures = new Pictures();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- DW6 -->
<head>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Shanna Lynn Tennant</title>
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
    <div id="globalLink">
      <?php include("../includes/heading.php") ?>
    </div>
    <!--end globalLinks-->
    <!--<form id="search" action="">
      <input name="searchFor" type="text" size="10" />
      <a href="">search</a>
    </form>-->
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
    <h2>Shanna Lynn  </h2>
  </div>
  <div id="pageNav">
    
    <div class="relatedLinks">
      <h3>Main Links </h3>
      <a href="photos.php?category=5&amp;photo=0" target="_blank">View Family Photos</a> <a href="mailto:shanna_ctr@yahoo.com" title="shanna_ctr@yahoo.com">Send Email</a></div>
    <div class="relatedLinks">
      <h3>Page Links </h3>
      <a href="http://www.state.ia.us/" title="www.state.ia.us" class="side" target="_blank">State of Iowa</a> <a href="http://www.colorado.gov/" title="www.colorado.gov" class="side" target="_blank">State of Colorado</a> <a href="http://www.aims.edu/" title="www.aims.edu" class="side" target="_blank">Aims Community College</a> <a href="http://www.merrittequipment.com/" title="www.merrittequipment.com" class="side" target="_blank">Merritt Industrial</a> <a href="http://www.frazier.com/" title="www.ffcastings.com" class="side" target="_blank">Frazier Industrial</a><a href="http://www.mission.net/micronesia/guam/" target="_blank">Micronesia Guam Mission</a></div>
    <div id="advert">
      <div align="center"><img alt="small logo" src="../images/TennantTartan (Small).jpg" height="150" width="150"/ title="The Tennant Tartan" /></div>
    </div>
  </div>
  <div id="content">
    <div class="feature">
	<?php $pictures->load(36); ?>
    <img src='../images/<?php echo($pictures->getName()); ?>' alt=''>
      <h3>Overview</h3>
      <p><strong>Shanna Lynn Tennant</strong>, the only girl among her brothers, was born during the summer of 1985 in Iowa.&nbsp;Shanna graduated in the spring of 2003 from Brighton High School in Colorado.&nbsp;Shanna graduated from AIMS Community College obtaining her Associates of Applied Sciences in welding during the Spring of 2005. She has since worked for Merritt Industrial, Frazier Industrial, and Premier Technology in her degree.</p>
    </div>
    <div class="story">
      <h3>More on Shanna</h3>
      <p>For the last eighteen months, Shanna has served a mission for the Chruch of Jesus Christ of Latter-day Saints in the Guam mission and will be arriving home by the end of October of this year. She has loved serving, but does not know what she will be doing after she gets home.</p>
    </div>
    <div class="story">
      <table width="100%" cellpadding="0" cellspacing="0" summary="">
        <tr valign="top">
          <td class="storyLeft">
          <p> <a href="#" class="capsule">Conclusion</a>Thanks for visiting the site! To view more history on the rest of the family, click on the links at the top of the page.  Enjoy the site and feel free to get a hold of the family at any time through their e-mail contacts.</p>          </td>
        </tr>
      </table>
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
