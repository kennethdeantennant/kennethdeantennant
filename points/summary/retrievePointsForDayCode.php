<?php
    session_start();
    
    include("../classes/Connection.php");
    include("../classes/Points.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$day = $request->formatted;

    $uid = $_SESSION["id"];

    $points = new Points();
    $results = $points->retrievePointsForWeek($uid, $day);
    if(empty($results)){
        return "empty";
    }

    $rows = array();
    while($row = mysqli_fetch_assoc($results)) {
        $rows[] = $row;
    }
    $json_response = json_encode($rows);
    echo($json_response);
?>