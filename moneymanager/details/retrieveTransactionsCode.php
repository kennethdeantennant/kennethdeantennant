<?php
    session_start();

    include("../classes/Connection.php");
    include("../classes/MoneyManager.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$cid = $request->category;

    $uid = $_SESSION["id"];

    $moneyManager = new MoneyManager();
    $results = $moneyManager->retrieveTransactions($cid, $uid);
    if(mysqli_num_rows($results) <= 0){
        return "empty";
    }

    $rows = array();
    while($row = mysqli_fetch_assoc($results)) {
        $rows[] = $row;
    }
    $json_response = json_encode($rows);
    echo($json_response);
?>