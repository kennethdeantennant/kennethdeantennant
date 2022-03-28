<?php
    session_start();
        
    include("../classes/Connection.php");
    include("../classes/MoneyManager.php");

    $uid = $_SESSION["id"];

    $moneyManager = new MoneyManager();
    $results = $moneyManager->retrieveAllDeposits($uid);

    $rows = array();
    while($r = mysqli_fetch_assoc($results)) {
        $rows[] = $r;
    }

    echo($json_response = json_encode($rows));
?>