<?php
    session_start();

    include("../classes/Connection.php");
    include("../classes/MoneyManager.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$did = $request->deposit;
    
    $moneyManager = new MoneyManager();
    $id = $moneyManager->deleteDeposit($did);

    echo("Success!");
?>