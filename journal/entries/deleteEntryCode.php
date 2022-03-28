<?php 
    session_start();

    include("../classes/Connection.php");
    include("../classes/Journal.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$id = $request->id;

    $uid = $_SESSION["id"];
	echo($id);
    $journal = new Journal();
    $journal->delete($id, $uid);

    echo( "Success!" );
?>