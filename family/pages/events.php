<?php require("../includes/connection.php")?>
<?php include("../includes/buildCalendar.inc")?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<!-- DW6 -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>A Tennant Family</title>
<link rel="stylesheet" href="../css/2col_rightNav.css" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
</head>
<body topmargin="0" leftmargin="0">
<?php
	$currentMonth = date("m");
	$currentYear = date("Y");
	call_user_func('BuildCalendar',$currentMonth,$currentYear);
?>
</body>
</html>
