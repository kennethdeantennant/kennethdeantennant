<?php 
    session_start();

    include("../classes/Connection.php");
    include("../classes/Journal.php");

    $id = $_SESSION["id"];

    $journal = new Journal();
    $exists = $journal->isEntry(date("Y-m-d"), $_SESSION["id"]);

    echo( $exists );
?>          