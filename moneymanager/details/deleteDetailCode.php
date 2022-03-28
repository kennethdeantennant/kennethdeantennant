<?php
    include("../classes/Connection.php");
    include("../classes/MoneyManager.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$did = $request->detail;

    $moneyManager = new MoneyManager();
    $results = $moneyManager->deleteDetail($did);

    echo("Success!");
?>