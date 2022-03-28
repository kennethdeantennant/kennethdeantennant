<?php
    session_start();

    include("../classes/Connection.php");
    include("../classes/Points.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$day = $request->day;

    $uid = $_SESSION["id"];

    $points = new Points();
    $results = $points->retrieveSelectedFoods($uid, $day);
    if(empty($results)){
        return "empty";
    }

    $rows = array();
    while($r = mysqli_fetch_assoc($results)) {
        $rows[] = $r;
    }

    echo($json_response = json_encode($rows));
?>