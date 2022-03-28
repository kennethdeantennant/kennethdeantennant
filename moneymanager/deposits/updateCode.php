<?php
    include("../classes/Connection.php");
    include("../classes/MoneyManager.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$did = $request->deposit;
    @$tid = $request->type;
    @$percent = $request->percent;

    $moneyManager = new MoneyManager();
    $results = $moneyManager->updateAmount($did, $tid, $percent);

    echo("Success!");
?>