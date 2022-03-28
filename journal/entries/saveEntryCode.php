<?php 
    session_start();

    include("../classes/Connection.php");
    include("../classes/Journal.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$entry = $request->entry;
    @$date = $request->entrydate;
	@$topic = $request->topic;

    $id = $_SESSION["id"];

    $journal = new Journal();
    $id = $journal->save($entry, $date, $id, $topic);

    echo( $id );
?>