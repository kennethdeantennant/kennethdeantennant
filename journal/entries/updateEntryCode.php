<?php 
    include("../classes/Connection.php");
    include("../classes/Journal.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$id = $request->id;
    @$text = $request->text;
	@$topic = $request->topic;

    $journal = new Journal();
    $results = $journal->update($id, $text, $topic);
    
    echo( "Success!" );
?>