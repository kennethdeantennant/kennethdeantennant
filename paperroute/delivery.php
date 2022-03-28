<?php
	include("classes/Connection.php");
	include("classes/Newspaper.php");
	include("classes/Address.php");
	include("classes/Daily.php");
	include("classes/Other.php");

	$daily = new Daily();
	$address = new Address();
	$newspaper = new Newspaper();
	
	$results = $address->getAll(1);
	while($results && $result = mysql_fetch_array($results)){
		$results2 = $newspaper->getDailyNewspapers();
		while($results2 && $result2 = mysql_fetch_array($results2)){
			$daily->save(date("Y-m-d"),$result["id"],$result2["id"],1);
			//echo($result["id"]);
		}
	}
	
	$date = date("w");
	if($date == 2){
		$other = new Other();
		$other->save(107,4,date("Y-m-d"),1);
	}
?>