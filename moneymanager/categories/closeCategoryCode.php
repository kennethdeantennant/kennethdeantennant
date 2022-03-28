<?php
    include("../classes/Connection.php");
    include("../classes/MoneyManager.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$id = $request->id;

    $moneyManager = new MoneyManager();
    $results = $moneyManager->openOrClose($id, '');

    echo("Success!");
?>