<?php
    session_start();

    include("../classes/Connection.php");
    include("../classes/Points.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$type = $request->type;

    $points = new Points();
    $results = $points->retrieveTypes($type);
    if(empty($results)){
        return "empty";
    }

    $rows = array();
    while($r = mysqli_fetch_assoc($results)) {
        $rows[] = $r;
    }

    echo($json_response = json_encode($rows));
?>