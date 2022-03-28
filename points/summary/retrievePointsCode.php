<?php
    session_start();
    
    include("../classes/Connection.php");
    include("../classes/Points.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$day = $request->formatted;

    $uid = $_SESSION["id"];

    $points = new Points();
    $results = $points->retrievePoints($uid, $day);

    if($results == "" ){
        echo("0");
    }else{
        echo($results);
    }
?>