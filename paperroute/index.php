<?php
	session_start();

	include("classes/Connection.php");
	include("classes/LogonInfo.php");
	include("classes/UserInfo.php");
	include("classes/Newspaper.php");
	include("classes/Address.php");
	include("classes/Daily.php");
	include("classes/Other.php");

	if(isset($_GET["page"]) and $_GET["page"]=="logout") unset($_SESSION["id"]);
		
	if(isset($_SESSION["id"]))
	{
		$user = new UserInfo();
		$user->load($_SESSION["id"]);
	}

	$_SESSION["logon"] = "";
	if(isset($_POST["txtUsername"]) && isset($_POST["txtPassword"]))
	{
		$logon = new LogonInfo();
		if($logon->verifyPassword($_POST["txtUsername"], $_POST["txtPassword"]) == true)
		{
			$user = new UserInfo();
			$user->load($logon->getUserID());
			$_SESSION["id"] = $user->getId();
		}else{
			$_SESSION["logon"] = "I";
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Paper Route</title>
    <link href="styles/paperroute.css" rel="stylesheet" type="text/css">
</head>

<body background="images/newspaper.jpeg">
<?php
	if(!isset($_SESSION["id"]))
	{
		include("pages/login.php");
	}else{
		if(isset($_GET["page"]))
		{
			include("pages/".$_GET["page"].".php");
		}else{
			include("pages/calendar.php");
		}
	}
?>
<div style="font-size:8pt; color:black;" align="center">updated 10/01/2010</div>
</body>
</html>
