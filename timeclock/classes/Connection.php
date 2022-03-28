<?php // This is the user class for the jar System
class Connection
{
	// Class variables
	var	$dbHost,
        $dbUser,
        $dbName,
        $dbPass;
	
	function Connection()
	{
		// Work
		//$this->dbHost = "fbms2009";
		//$this->dbUser = "root";
		//$this->dbName = "ken";
		//$this->dbPass = "";
		
		//Home
		$this->dbHost = "localhost";
		$this->dbUser = "kentenna_kt";
		$this->dbName = "kentenna_db";
		$this->dbPass = "Esnack212!";
		
		//Frazier Fixture Shop
		//$this->dbHost = "localhost";
		//$this->dbUser = "root";
		//$this->dbName = "mysql";
		//$this->dbPass = "frzr.123";
	}
	
	function getHost()
	{
		return $this->dbHost;
	}
	
	function getUser()
	{
		return $this->dbUser;
	}
	
	function getName()
	{
		return $this->dbName;
	}
	
	function getPass()
	{
		return $this->dbPass;
	}
	
		
	function WordCasing($text){
		$counts=0;
		$caseText="";
		$noUpper = array('a','an','are','at','from','in','is','of','the','to');
		$words = split(' ', $text);
		foreach($words as $word)
		{
			$counts+=1;
			// Take out commas and periods
  			$word = str_replace("'","",$word);
			$word = str_replace(".","",$word);	
			// Not in array, word length greater than one, first position in word not (
			if((!in_array(trim($word),$noUpper) || $counts<2) && strlen(trim($word))>1 && substr($word, 0, 1)!="("){
				$caseText=trim($caseText)." ".strtoupper(substr($word, 0, 1)).substr($word, 1);
			// Not in array, word length greater than one
			}else if((!in_array(trim($word),$noUpper) || $counts<2) && strlen(trim($word))>1){
				$caseText=trim($caseText)." ".substr($word, 0, 1).strtoupper($word[1]).substr($word, 2);
			}else{
				$caseText=trim($caseText)." ".trim($word);
			}
		}
		return trim($caseText);
	}

}
?>