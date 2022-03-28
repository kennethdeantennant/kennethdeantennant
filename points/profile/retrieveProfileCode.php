<?php
    session_start();
    
    include("../classes/Connection.php");
    include("../classes/Points.php");

    $id = $_SESSION["id"];

    $points = new Points();
    $results = $points->retrieveProfile($id);
    if(empty($results)){
        return "empty";
    }

    $rows = array();
    while($r = mysqli_fetch_assoc($results)) {
        $rows[] = $r;
    }

    echo($json_response = json_encode($rows));
?>