<?php
    session_start();

    include("../classes/Connection.php");
    include("../classes/MoneyManager.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$did = $request->deposit;

    $uid = $_SESSION["id"];

    $moneyManager = new MoneyManager();
    $id = $moneyManager->finalize($did, $uid);

    echo("Success!");
?>