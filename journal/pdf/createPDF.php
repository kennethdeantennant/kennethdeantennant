<?php
	include ('class.ezpdf.php');
	include("../classes/UserInfo.php");
	include("../classes/Connection.php");
	include("../classes/Journal.php");
	
	$user = new UserInfo();
	$user->load($_GET["id"]);
	$pCount=0;
	$pdf =& new Cezpdf();
	$pdf->ezSetMargins(50,50,50,50);
	$journal = new Journal();
	$results = $journal->getEntriesByYear($_GET["year"], $_GET["id"]);
	$crlf=Chr(13).Chr(10).Chr(13).Chr(10);
	$holdName="";
	$pdf->setLineStyle(3,'round');
	$pdf->line(50,750,550,750);
	$pdf->addTextWrap(115,600,400,30,'The Personal Journal','center',0);
	$pdf->addTextWrap(115,550,400,30,'of','center',0);
	$pdf->addTextWrap(115,500,400,30,$user->getName(),'center',0);
	$pdf->addTextWrap(115,400,400,20,'- Year '.$_GET["year"].' -','center',0);
	$pdf->setLineStyle(3,'round');
	$pdf->line(50,140,550,140);
	$pdf->addTextWrap(125,150,350,9,'Compiled '.date("m-d-Y"),'center',0);
	$pdf->setLineStyle(3,'round');
	$pdf->line(50,165,550,165);
	$pdf->ezNewPage();
	$i = $pdf->ezStartPageNumbers(300,25,10,'','',1);
    while($results && $myrow = mysql_fetch_array($results)){
		if($myrow["JDate"]!=$holdDate)
		{
			if($pCount>0)
			{
				$pdf->ezStopPageNumbers(1,1,$i);
				$pdf->ezNewPage();
				$i = $pdf->ezStartPageNumbers(300,25,10,'','',1);
			}
			$pCount+=1;
			$pdf->selectFont('./fonts/Helvetica.afm');
			$text = "<c:uline>".date("l - F d, Y",mktime(0,0,0,substr($myrow["JDate"],5,2),substr($myrow["JDate"],8,2),substr($myrow["JDate"],0,4)))."</c:uline>";
			$pdf->addTextWrap(50,790,500,14,$text,'center',0);
			$text="";
			$holdName="";
		}
		$holdDate=$myrow["JDate"];

		if($myrow["jcname"]!=$holdName)
		{
			$pdf->selectFont('./fonts/Helvetica-Oblique.afm');
			$text = "-- ".$myrow["jcname"]." --";
			$pdf->ezText(Chr(13).Chr(10).$text,10);
			$text="";
		}
		$holdName=$myrow["jcname"];

		$entry = $myrow["JEntry"];
		$entry = str_replace("<p></p><p></p>",$crlf,$entry);
		$pdf->selectFont('./fonts/Helvetica.afm');
		$pdf->ezText(Chr(13).Chr(10).$entry,10);
	}
	
	$pdf->ezStopPageNumbers();
	$pdf->ezStream();
?>
