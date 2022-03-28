<?php
    session_start();

    include("../classes/Connection.php");
    include("../classes/MoneyManager.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$cid = $request->category;

    $id = $_SESSION["id"];

    $moneyManager = new MoneyManager();
    $results = $moneyManager->retrieveCategory($cid, $id);

    $rows = array();
    while($row = mysqli_fetch_assoc($results)) {
        $rows[] = $row;
    }
    $json_response = json_encode($rows);
    echo($json_response);
?>