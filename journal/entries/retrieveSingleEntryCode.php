<?php 
    session_start();

    include("../classes/Connection.php");
    include("../classes/Journal.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$entrydate = $request->entrydate;

    $id = $_SESSION["id"];

    $journal = new Journal();
    $results = $journal->getSingleEntry($entrydate, $id);

    $row = $results->fetch_row();
    echo( json_encode($row) );
?>          