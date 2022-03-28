<?php 
	include("classes/Connection.php");
	include("classes/Pictures.php");

	$pictures = new Pictures();
?>

<head>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tennant Overview</title>
<link rel="stylesheet" href="css/emx_nav_right.css" type="text/css" />
<link rel="icon" href="images/favicon.ico">
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
  <div id="globalNav"> <img alt="" src="images/gblnav_left.gif" height="32" width="4" id="gnl" /> <img alt="" src="images/glbnav_right.gif" height="32" width="4" id="gnr" />
    <div id="globalLink">
    <?php include("includes/heading.php") ?></div>
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
  <img alt="" src="images/tl_curve_white.gif" height="6" width="6" id="tl" /> <img alt="" src="images/tr_curve_white.gif" height="6" width="6" id="tr" />
  <div id="breadCrumb"></div>
  <div id="pageName">
    <h2>The Family </h2>
  </div>
  <div id="pageNav">    
    <div class="relatedLinks">
      <h3>Main Links </h3>
        <a href="pages/photos.php?category=0&amp;photo=0" target="_blank">View Family Photos</a>
        <a href="pages/bios.php?family=0&amp;individual=1" target="_blank">Read Family Histories</a>
        <a href="http://www.kentennant.com/tfh/" target="_blank">View Tennant Ancestory</a>
        <a href="http://www.kentennant.com/dfh/" target="_blank">View Downey Ancestory</a>
        <a href="#">
        <?php
//				$today  = date("Y").'-'.date("m").'-'.date("d");
//				$currMonth = date("m");
//				$result = mysqli_query("SELECT * FROM events WHERE substring(date,6,2)='$currMonth' ORDER BY date",$db);
//				$idx=0;
//				while ($result && $myrow = mysqli_fetch_array($result))
//				{
//					if($idx==0)
//					{
//						print("<br/><span class='names'>This Months Events</span>");
//					}
//					if($myrow["categoryId"]==1)
//					{
//						printf("<a href='eventView.php?event=%s' target='_blank'>%s&nbsp;<span style='font-size:10pt'><br>- %s -</span></a>",$myrow["Id"],$myrow["title"],date("M",mktime(0,0,0,substr($myrow["date"],5,2),substr($myrow["date"],8,2),substr($myrow["date"],0,4))));
//					}else{
//						printf("<a href='eventView.php?event=%s' target='_blank'>%s&nbsp;<span style='font-size:10pt'><br>( %s-%s-%s )</span></a>",$myrow["Id"],$myrow["title"],substr($myrow["date"],8,2),date("M",mktime(0,0,0,substr($myrow["date"],5,2),substr($myrow["date"],8,2),substr($myrow["date"],0,4))),substr($myrow["date"],2,2));
//					}
//					$idx+=1;
//				}
        ?>
        </a>
    </div>
    <div class="relatedLinks">
      <h3>Page Links </h3>
      <a href="https://www.idaho.gov/" target="_blank">State of Idaho</a>
        <a href="http://www.lds.org/" target="_blank">Church of Jesus Christ of Latter-day Saints</a>
        <a href="http://www.byui.edu/" target="_blank">BYU-Idaho</a>
        <a href="https://www.mymission.com/lds-missions/sweden-stockholm-mission" target="_blank">Sweden Mission</a>
        <a href="http://www.palmer.edu/" target="_blank">Palmer College</a>
        <a href="http://www.colorado.gov/" target="_blank">State of Colorado</a>
        <a href="http://access.wa.gov/" target="_blank">State of Washington</a>
        <a href="http://welcome.colostate.edu/" target="_blank">Colorado State University</a>
        <a href="https://churchofjesuschristtemples.org/idaho-falls-idaho-temple/" target="_blank">Idaho Falls Temple</a>
        <a href="https://www.fruita.org/" target="_blank" alt="Current Living Location">Fruita Colorado</a></div>
    <div id="advert">
      <div align="center"><img alt="small logo" src="images/TennantTartan (Small).jpg" height="150" width="150"/ title="The Tennant Tartan" /></div>
    </div>
  </div>
  <div id="content">
    <div class="feature">
        <?php $pictures->load(40); ?>
        <img width='75%' src='../family/images/<?php echo($pictures->getName()); ?>' alt='<?php echo($pictures->getTitle()); ?>'>
    <h3>Overview</h3>
    <p>Mike and Cheryl started their lives together in Idaho. They met while attending Ricks College (now BYU-Idaho), moved to Iowa for Chiropractic schooling, and lived in Missouri, Colorado, Idaho, and back to Colorado again. They now live in a small town outside of Grand Junction, Colorado called Fruita where Mike has a practice as a chiropractor in Nucla, Colorado, and Cheryl teaches Family and Consumer Science courses in the local high school. They have a family consisting of four children (three boys and a girl), thirteen living grandchildren and one grandchild that passed away from SIDS in December of 2006.</p>
    </div>
    <div class="story">
      <h3>The Family History </h3>
      <p>Mike and Cheryl met and married in Idaho and very quickly started their family nine months later with the birth of their first son, Kenneth Dean (Ken). Moving to Boise, Idaho, the family continued to grow with the additional births of Michael Scott (Scott) and David Wayne. In time, the family moved to the state of Iowa to attend Palmer Chiropractic School and increased their family with the birth of Shanna Lynn.</p>
      <h3>More on Mike </h3>
      <p>With the birth of David, Mike wanted to do more in helping people physically feel better and decided to do this by becoming a Chiropractor.  He learned that he would need to attend Palmer Chiropractic School in Des Moines, Iowa, and after 6 years graduated with his degree in chiropractices. He started out working for various doctors in Missouri than Colorado, but none of those worked out for him as hoped.  He started his own practice in Wheatridge, Colorado and worked there until the spring of 2007 when he and Cheryl moved back to Idaho for four years.  Then in 2011, they moved back to Fruita, Colorado with a practice in Nucla, Colorado.</p>
      <p>Since moving back to Colorado, he has enjoyed the warmer climate and spends time reading, studying, hiking with his dogs, and serving in the Monticello Temple in Monticello, Utah.</p>
<h3>More on Cheryl </h3>
      <p>For several years after the marriage, Cheryl spent time raising family and supporting her husband as he went to school and he attempted his employment as a chiropractor.  She obtained her associates degree from Ricks College (now BYU-Idaho) and as the family got older, which gave her more time on her hands, Cheryl decided to get her bachelors degree in Family and Consumer Sciences from Colorado State University in Fort Collins, Colorado while they lived in Brighton and Lockbuie, Colorado. With her degree, she began teaching at a high school level in Colorado until the summer of 2006. Then that fall and after moving to Idaho, Cheryl began working for Marsh Valley High School.</p>
      <p>Since moving back to Colorado, Cheryl continues to teach at the local high school level.  She also enjoys bike riding, putting puzzles together, and spending time with family.</p>
    </div>
    <div class="story">
      <table width="100%" cellpadding="0" cellspacing="0" summary="">
        <tr valign="top">
            <td class="storyLeft">
                <p><a href="#" class="capsule">Conclusion</a>Thanks for visiting the site! The remainder of this site deals with the kids and the family history. Enjoy the site and feel free to get a hold of the family at any time through their e-mail contacts.</p>
            </td>
        </tr>
      </table>
    </div>
  </div>
  <!--end content -->
  <div id="siteInfo">
    <div align="center"><span class="photoBorder">
      <?php include("includes/updated.inc") ?>
      </span></div>
  </div>
</div>
<!--end pagecell1-->
<br />

</body>
</html>
