<?php
include("../includes/connection.php");
	
// Where the file is going to be placed 
$target_path = "includes/";

/* Add the original filename to our target path. Result is "uploads/filename.extension" */
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

// This is how we will get the temporary file...
$_FILES['uploadedfile']['tmp_name']; 

$target_path = "images/";
$target_path = $target_path . basename($_FILES['uploadedfile']['name']); 
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	$category=["category"];
	$result = mysqli_query("SELECT Description FROM pictures_category WHERE Id=$category",$db);
	$myrow = mysqli_fetch_array($result);
	$catDescription = $myrow["Description"];
	$subcategory=["subcategory"];
	$result = mysqli_query("SELECT Description FROM pictures_category WHERE Id=$subcategory",$db);
	$myrow = mysqli_fetch_array($result);
	$subDescription = $myrow["Description"];
	$title=["title"];
	$name=$_FILES['uploadedfile']['name'];
	
	mysqli_query("Insert pictures (category,subcategory,title,name) Values($category,$subcategory,'$title','$name')",$db);

	$from =  "From: File Upload <webmaster@kentennant.existhost.com>\r\nMIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\n";
	if(["chkSend"])
	{
		$to = "kstennant@cableone.net;cheryltennant@earthlink.net;snlt15@aol.com;eldermusculos@hotmail.com;shanna_ctr@yahoo.com";
	}
	else
	{
		$to = "kstennant@cableone.net";
	}
	$subject = "Picture Added to Family Site";
	$message = "<html><head><title>Family Picture Added</title></head><body>Another picture was added to the family site with the following information.<p>Category:&nbsp;$catDescription<br>Subcategory:&nbsp;$subDescription<p>Description:&nbsp;$title<p><a href='http://kentennant.existhost.com/family/'>Visit Site</a></body></html>";
	mail($to, $subject, $message, $from, $headers);
	echo("<script language='javascript'>window.close();</script>");
} else{
    echo "There was an error uploading the file, please try again!";
}
?>