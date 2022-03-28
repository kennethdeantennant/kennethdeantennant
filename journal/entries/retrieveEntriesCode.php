<?php 
    session_start();

    include("../classes/Connection.php");
    include("../classes/Journal.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $id = $_SESSION["id"];

    $journal = new Journal();
    $results = $journal->getEntries($id);
    if(mysqli_num_rows($results) <= 0){
        return "empty";
    }

    $rows = array();
    while($row = mysqli_fetch_assoc($results)) {
        $rows[] = $journal->convert_from_latin1_to_utf8_recursively($row);
    }
    $json_response = json_encode($rows);
    echo($json_response);
?>