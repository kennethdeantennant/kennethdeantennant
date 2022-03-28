<?php
    include("../classes/Connection.php");
    include("../classes/Journal.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$uid = $request->user;

    $journal = new Journal();
    $results = $journal->retrieveUser($uid);

    echo( json_encode($results) );
?>