<?php
    session_start();

    include("../classes/Connection.php");
    include("../classes/MoneyManager.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $uid = $_SESSION["id"];

    @$id = $request->id;
    @$name = $request->name;
    @$description = $request->description;
    @$percent = $request->percent;

    $moneyManager = new MoneyManager();
    $results = $moneyManager->update($id, $name, $description, $percent, $uid);

    echo("Success!");
?>