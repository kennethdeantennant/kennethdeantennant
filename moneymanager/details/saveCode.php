<?php
    session_start();

    include("../classes/Connection.php");
    include("../classes/MoneyManager.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$amount = $request->amount;
    @$date = $request->date;
    @$time = $request->time;
    @$description = $request->description;
    @$cid = $request->category;

    $uid = $_SESSION["id"];

    $moneyManager = new MoneyManager();
    $id = $moneyManager->saveDetail($amount, $date, $time, $description, $cid, $uid);

    echo($id);
?>