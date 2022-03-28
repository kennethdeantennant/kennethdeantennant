<?php
    include("../classes/Connection.php");
    include("../classes/MoneyManager.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$uid = $request->user;

    $moneyManager = new MoneyManager();
    $results = $moneyManager->retrieveUser($uid);
    echo( json_encode($results) );
?>