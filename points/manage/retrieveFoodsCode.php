<?php
    session_start();
    
    include("../classes/Connection.php");
    include("../classes/Points.php");

    $uid = $_SESSION["id"];

    $points = new Points();
    $results = $points->retrieveFoods($uid);
    if(mysqli_num_rows($results) <= 0){
        return "empty";
    }

    $rows = array();
    while($r = mysqli_fetch_assoc($results)) {
        $rows[] = $r;
    }

    echo($json_response = json_encode($rows));
?>