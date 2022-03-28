<?php
	session_start();
	include("classes/Connection.php");
	
	// Change the session timeout value to 1 hr
	ini_set("session.gc_maxlifetime", 60*60);
	
	if(isset($_GET["page"]))
	{
		include("classes/User.php");
		
		if($_GET["page"] == "login")
		{
			// login user
			if(isset($_POST["txtUsername"]) && $_POST["txtUsername"] != "" && isset($_POST["txtPassword"]) && $_POST["txtPassword"] != "")
			{
				$user = new User();
				$user->setName($_POST["txtUsername"]);
				$user->setPassword($_POST["txtPassword"]);
				if($user->verifyPassword())
				{
					$_SESSION["id"] = $user->getId();
					$_SESSION["logged"] = "yes";
				}
			}else{
				$user = new User();
				$user->reload($_SESSION["id"]);
			}
		}else{
			if(isset($_SESSION["id"]))
			{
				$user = new User();
				$user->reload($_SESSION["id"]);
			}
		}
	}else{
		unset($_SESSION["id"]);
		unset($_SESSION["logged"]);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>My Time Clock</title>
<link href="styles/style.css" rel="stylesheet" type="text/css" />
</head>
<script language="JavaScript" src="js/date.js" type="text/javascript"></script>
<script language="JavaScript" src="js/AnchorPosition.js" type="text/javascript"></script>
<script language="JavaScript" src="js/PopupWindow.js" type="text/javascript"></script>
<script language="JavaScript" src="js/CalendarPopup.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript">var cal = new CalendarPopup();</script>
<body class="body">
<?php
	if(!isset($_SESSION["logged"]))
	{
		require("includes/login.php");
	}
	else
	{
		switch($_GET["page"])
		{
			case "login":
				require("includes/timesheet.php");
				break;
			case "timesheet":
				require("includes/timesheet.php");
				break;
			case "history":
				require("includes/history.php");
				break;
			case "employee":
				require("includes/employee.php");
				break;
			case "employees":
				require("includes/employees.php");
				break;
			case "projects":
				require("includes/projects.php");
				break;
			case "newentry":
				require("includes/newentry.php");
				break;
			case "assignment":
				require("includes/assignment.php");
				break;
			case "punchmissed":
				require("includes/missingpunch.php");
				break;
			default:
				require("includes/login.php");
				break;
		}
	}
?>
<p /><p />
<div align="center" style="color:#FFFF00; font-size:10px; letter-spacing:2px;">updated on 08/13/2008 (webmaster - <a href="mailto:kstennant@cableone.net" style="color: #FFFF00; font-size:10px; letter-spacing:2px; font-weight:normal;">ken tennant</a>)</div>
</body>
</html>
