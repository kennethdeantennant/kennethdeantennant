<?php 
    session_start();

    include("../classes/Connection.php");
    include("../classes/Journal.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $id = $_SESSION["id"];

    $journal = new Journal();
    $results = $journal->getDates($id);

    $rows = array();
    while($row = mysqli_fetch_array($results)) {
        $rows[] = $row;
    }
    
    $json_response = json_encode($rows);
    echo($json_response);
?>