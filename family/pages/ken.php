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
<title>Kenneth Dean Tennant</title>
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
    <h2>Kenneth Dean   </h2>
  </div>
  <div id="pageNav">
    
    <div class="relatedLinks">
      <h3>Main Links </h3>
      <a href="photos.php?category=2&amp;photo=0" target="_blank">View Family Photos</a><a href="mailto:kstennant@cableone.net" title="cheryltennant@earthlink.net">Send Family Email</a></div>
    <div class="relatedLinks">
      <h3>Children Links</h3>
      <a href="angela.php">Angela Lyn</a>
      <a href="christopher.php">Christopher Dean</a>
      <a href="naomi.php">Naomi Ruth</a>
      <a href="kirsten.php">Kirsten Ann</a>
      <a href="elizabeth.php">Elizabeth Jane</a>
      <a href="charles.php">Charles Scott</a></div>
    <div class="relatedLinks">
      <h3>Page Links </h3>
      <a href="http://maps.google.com/maps?oi=map&amp;q=Pocatello,+ID" class="side" target="_blank">Pocatello Idaho</a> <a href="http://www.isu.edu" target="_blank">Idaho State University</a> <a href="http://www.ldschurchtemples.com/cgi-bin/pages.cgi?idaho_falls" target="_blank"> Idaho Falls Temple</a> <a href="http://www.colorado.gov/" target="_blank">State of Colorado </a> <a href="http://www.byui.edu/" target="_blank"> BYU-Idaho (Ricks) </a> <a href="http://www.mission.net/new-york/utica/" target="_blank">Utica New York Mission</a><a href="http://idfbins.com/" target="_blank">Idaho Farm Bureau</a><a href="http://www.idaho.gov/" target="_blank">State of Idaho</a><a href="http://www.lds.org/" target="_blank">LDS Church</a><a href="https://www.idfbins.com/" target="_blank">Farm Bureau of Idaho</a><a href="https://sites.google.com/site/agapebirthserviceandcenter/" class="side" target="_blank" title="Located in Pocatello Idaho">Agape Birth Service</a></div>
    <div id="advert">
      <div align="center"><img alt="small logo" src="../images/TennantTartan (Small).jpg" height="150" width="150"/ title="The Tennant Tartan" /></div>
    </div>
  </div>
  <div id="content">
    <div class="feature">
	<?php $pictures->load(41); ?>
    <img width="50%" src='../images/<?php echo($pictures->getName()); ?>' alt=''>
      <h3>Overview</h3>
      <p><span class="names"><strong>Kenneth Dean Tennant</strong></span> lives in Pocatello, Idaho with his wife, Shani, and three children - Angela, Christopher, and Kirsten. After growing up in the states of Idaho, Iowa, Missouri (a 9 month short stay), and Colorado, he moved to Pocatello in 1999 to work and finish his education at Idaho State University. After this move, Ken and Shani met through a roommate and in November of 1999, they got married in the Idaho Falls Temple in Idaho Falls, Idaho. </p>
      <p>During their marriage, the family size has grown with the births of Angela Lyn, Christopher Dean, Naomi Ruth, Kirsten Ann, and Elizabeth Jane. Sadly, Naomi Ruth passed away from SIDS five and a half weeks after her birth. Since her passing, the family has redefined a new normal and continues to live their lives.</p>
</div>
    <div class="story">
      <h3>More on Ken </h3>
      <p>In the spring of 1995, Ken graduated from high school in a small community outside of Denver, Colorado called Brighton. Today, that community is no longer small as it has grown from the influx of people migrating from other states around the country. </p>
      <p>When he graduated, he left this small town to attend Ricks College (now BYU-Idaho) for a year before going on a two mission for the Church of Jesus Christ of Latter-day Saints to Utica, New York.</p>
      <p> When he returned from the mission in 1998, he went back to Ricks College and obtained his Associates Degree in Computer Information Systems. As mentioned, he moved to Pocatello to work and attend school at Idaho State University where he graduated with his Bachelors Degree in Computer Information System during the spring of 2005. Currently, he works for Farm Bureau Mutual Insurance of Idaho as a programmer.</p>
      <h3>More on Shani </h3>
      <p>Shani was born into the family of  Neil and Lisa Hubbard of Grace, Idaho and ended up with having six brothers and sisters. She graduated from high school in the spring of 1996 and began to attend Idaho State University. While attending the University,  she met a lot of people and made some good friends. Even though she never settled on a degree that would work for her, she does not regret the time spent and the memories made with her friends and her eventual husband.</p>
      <p> Since the birth of her children, Shani has focused on her family and has found her happiness in raising the children and being a wonderful wife to her husband. She has developed excellent talents in cooking, scrapbooking, and continues to educate herself in all areas of her life through studying and reading. </p>
      <p>Despite the daily grind of taking care of the family, she still finds her private moments of solitude. There is nothing more that she really wants to do in her life than be a great wife and a wonderful mom. </p>
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
    <div align="center"><span class="photoBorder"><?php include("../includes/updated.inc") ?></span></div>
  </div>
</div>
<!--end pagecell1-->
<br />

</body>
</html>
