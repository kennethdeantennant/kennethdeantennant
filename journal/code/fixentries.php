<?php
    include("../classes/Connection.php");
    include("../classes/Journal.php");

    $journal = new Journal();
    $results = $journal->getAllEntries();

    $holdDate = "";
    $holdUID = 0;
    $holdEntry = "";
    $rows = array();
    $totals = 0;
    while($r = mysql_fetch_assoc($results)) {
        if($holdDate == ""){
            $holdDate = $r["JDate"];
        }
        if($r["JDate"]!=$holdDate){
            $journal->saveNew( $holdDate, $holdEntry, $holdUID );
            $holdDate = $r["JDate"];
            $holdUID = $r["pid"];
            $holdEntry = "";
            $totals++;
        }
        if($holdUID == 0){
            $holdUID = $r["pid"];
        }
        if( $holdEntry != "" ){
            $holdEntry = $holdEntry."<p></p><p></p>";
        }
        
        $holdEntry = $holdEntry.$r["JEntry"];
    }
    $journal->saveNew( $holdDate, $holdEntry, $holdUID );
    echo($totals);
?>          