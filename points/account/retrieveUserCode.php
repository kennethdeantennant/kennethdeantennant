<?php
    include("../classes/Connection.php");
    include("../classes/Points.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$uid = $request->user;

    $points = new Points();
    $results = $points->retrieveUser($uid);
    if(empty($results)){
        return "empty";
    }

    $rows = array();
    while($r = mysqli_fetch_assoc($results)) {
        $rows[] = $r;
    }

    echo($json_response = json_encode($rows));
?>