<?php
    session_start();

    include("../classes/Connection.php");
    include("../classes/MoneyManager.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$amount = $request->amount;
    @$tid = $request->type;

    $uid = $_SESSION["id"];
    $date = date("Y-m-d");
    $time = date("H:i:s");

    $moneyManager = new MoneyManager();
    $id = $moneyManager->saveDetail($amount, $date, $time, "Finalized Deposit", $tid, $uid);

    echo($id);
?>