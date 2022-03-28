<?php
    session_start();
        
    include("../classes/Connection.php");
    include("../classes/MoneyManager.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$id = $request->deposit;

    $uid = $_SESSION["id"];

    $moneyManager = new MoneyManager();
    $results = $moneyManager->retrieveDeposit($id, $uid);

    $rows = array();
    while($r = mysqli_fetch_assoc($results)) {
        $rows[] = $r;
    }

    echo($json_response = json_encode($rows));
?>