<?php 
    session_start();

    include("../classes/Connection.php");
    include("../classes/Journal.php");

    $id = $_SESSION["id"];

    $journal = new Journal();
    $createdDate = date("Y-m-d", mktime(0,0,0,date("m"),1,date("Y")));
    $results = $journal->getEntries($createdDate, $id);

    if( $results == null ){
        echo("Empty!");
    }else{
        $rows = array();
        while($r = mysqli_fetch_assoc($journal->fetchArray)) {
            $rows[] = $r;
        }

        echo($json_response = json_encode($rows));
    }
?>