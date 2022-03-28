<?php
    session_start();

    include("../classes/Connection.php");
    include("../classes/MoneyManager.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $uid = $_SESSION["id"];

    @$name = $request->name;
    @$description = $request->description;

    $moneyManager = new MoneyManager();
    $id = $moneyManager->save($name, $description, $uid);

    echo($id);
?>