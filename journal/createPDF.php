<?php
	include ('pdf/class.ezpdf.php');
	include("classes/Connection.php");
	include("classes/Journal.php");
	
	$category=0;
	$from=0;
	$to=0;
	$holdDate='0001-01-01';
	if(isset($_POST["lstCategory"])){
		$category=$_POST["lstCategory"];
	}else if(isset($_GET["cat"])){
		$category=0;
	}
	if(isset($_POST["txtFrom"]) && $_POST["txtFrom"]!=""){
		$from=$_POST["txtFrom"];
	}else if(isset($_GET["from"])){
		$from=$_GET["from"];
	}
	if(isset($_POST["txtTo"]) && $_POST["txtTo"]!=""){
		$to=$_POST["txtTo"];
	}else if(isset($_GET["to"])){
		$to=$_GET["to"];
	}
	
	$journal = new Journal();
	if($category>0){
		$results = $journal->printByCategory($from, $to, $category, $user->getId());
	}else{
		$results = $journal->printAll($from, $to, $user->getId());
	}
	$text = $_GET["from"].$_GET["to"];
	$pdf =& new Cezpdf();
	$pdf->selectFont('./fonts/Courier.afm');
	$pdf->ezText($text,50);
	$pdf->ezStream();
?>
