<html>
<head>
	<title>A Tennant Family Home Page</title>
	<link rel="stylesheet" href="tennant.css" type="text/css">

<meta name="keywords" content="Tennant,Neilson,Downey,Snyder,History,Biographies,Edna Bradshaw, Elizabeth Crapo, Irvin Farley, Julia Farley, Lorenzo Farley Junior, Jane Hastings, Mary Hastings, Benjamin Housley, Charles Housley, George Housley, Jessie Housley, Maria Housley, Charlotte Jackson, Carl Algot Neilson, Carl Peter Neilson, Emma Nuttall, Anna Stone, Joseph Stones, Ruth Scott, Bennie Tennant">
<meta name="description" content="A family web page for Mike and Cheryl Tennant with their children Ken, Scott, David, and Shanna Tennant.">

</head>

<body background="../images/bland.jpg" topmargin="3" leftmargin="3">
<!--
<form method=post action="bioRequestProcess.php" name="frmFamily">
<table class='master' align='center'>
<tr>
	<td valign="top">
		<table bgcolor="#006600" cellspacing="0" cellpadding="0" border='1' width='100%'>
			<tr>
				<td>
					<table align="center" cellpadding="2" cellspacing="0" background="./images/bg1.gif" width='100%'>
						<tr>
							<td class="welcome">
								Biography Request
							</td>
						</tr>
						<tr>
							<td align="center">
								<table width="99%" bgcolor="#006600" cellpadding="3" cellspacing="0">
									<tr>
										<td class="subtitle">
											<script language = "JavaScript">
											<!--
											// Array of day names
											var dayNames = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
											var monthNames = new Array("January","February","March","April","May","June","July",
																	   "August","September","October","November","December");
											var dt = new Date();
											var y  = dt.getYear();
											
											// Y2K compliant
											if (y < 1000) y +=1360;
											document.write(dayNames[dt.getDay()] + " - " + monthNames[dt.getMonth()] + " " + dt.getDate() + ", " + y);
											</script>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td class='data'>
								<table width='100%' cellspacing='10' cellpadding='1'>
									<tr>
										<td>
											<table width='100%'>
												<tr>
													<td class='labels'>
														Biography of:
													</td>
													<td>
														<input name=txtBio size="45" readonly="1" value='<? echo $_GET["Name"] ?>'>
													</td>
												</tr><tr>
													<td class='labels'>
														Enter Your Name:
													</td>
													<td>
														<input name=txtName size="45">
													</td>
												</tr>
												<tr>
													<td class='labels'>
														Enter Your Email:
													</td>
													<td>
														<input name=txtEmail size="45">
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan='2'>
											<table width='100%'>
												<tr>
													<td colspan='2'>
														<hr color=black size='1'>
													</td>
												</tr>
												<tr>
													<td align='center'>
														<select name=txtInterest size="1">
															<option value="NA">-- Select Interest --</option> 
															<option value="Historical">Historical</option>
															<option value="Personal">Personal</option> 
															<option value="Other">Other...</option>
														</select>
													</td>
													<td align='center'>
														<select name=txtFormat size="1">
															<option value="NA">-- Select Format --</option> 
															<option value="WordPerfect 9.0">WordPerfect 9.0</option> 
															<option value="Microsoft Word 2000">Microsoft Word 2000</option>
															<option value="Plain Text">Plain Text</option>
														</select>
													</td>
												</tr>
												<tr>
													<td colspan='2'>
														<hr color=black size='1'>
													</td>
												</tr>
												<tr>
													<td align='center'>
														<input type=submit value=submit name=b1>
													</td>
													<td align='center'>
														<input type=reset value=reset name=b2>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
 	</td>
</tr>
</table>
</form>-->
<script language='JScript'>
	var queryString; 
	queryString = location.search.substring(location.search.indexOf('=')+1);
	do 
	{ 
	   queryString = queryString.replace('%20',' ');
	} 
	while(queryString.indexOf('%20') > 0); 
	document.frmFamily.field1.value = queryString;
	document.frmFamily.field2.focus();
</script>
</body>
</html>