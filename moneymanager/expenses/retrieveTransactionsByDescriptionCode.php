<?php
    session_start();

    include("../classes/Connection.php");
    include("../classes/MoneyManager.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $uid = $_SESSION["id"];

    @$cid = $request->category;

    $moneyManager = new MoneyManager();
    $results = $moneyManager->retrieveTransactionsByCategory($uid, $cid);
    if(mysqli_num_rows($results) <= 0){
        return "empty";
    }

    $rows = array();
    while($row = mysqli_fetch_assoc($results)) {
        $rows[] = $moneyManager->convert_from_latin1_to_utf8_recursively($row);
    }
    $json_response = json_encode($rows);
    echo($json_response);
?>