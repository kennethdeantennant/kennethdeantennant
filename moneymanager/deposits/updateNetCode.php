<?php
    include("../classes/Connection.php");
    include("../classes/MoneyManager.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$did = $request->deposit;
    @$amount = $request->amount;

    $moneyManager = new MoneyManager();
    $results = $moneyManager->updateNetAmount($did, $amount);

    echo("Success!");
?>