<?php
	$email = ["txtEmail"];
	$bioName = ["txtBio"];
	$name = ["txtName"];
	$interest = ["txtInterest"];
	$format = ["txtFormat"];
	$header =  "From: ktennant@idfbins.com\r\nMIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\n";
	$to = "ktennant@idfbins.com";
	$subject = "Biography Request";
	$message = "<style>
		a.mainLink:link {
			color: 'navy';
			text-decoration:none;
			font-size : 10pt;
			font-weight: bolder;
			font-family: verdana;
		}
		
		a.mainLink:visited {
			color:'navy'; 
			text-decoration:none;
			font-size:10pt;
			font-weight: bolder;
			font-family: verdana;
		}
		
		a.mainLink:hover {
			color:#FF6347;
			text-decoration:none;
			font-size:10pt;
			font-weight:folder;
			font-family: verdana;
		}
	</style><p>The following individual has requested the biography for $bioName.<p><p>$email<br>$name<br>$format<br>$interest";
		
	mail($to, $subject, $message, $header);
//	echo "<script language=\"JavaScript\">window.close();</script>";
?>