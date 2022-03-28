<?php
    session_start();

    include("../classes/Connection.php");
    include("../classes/MoneyManager.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$cid = $request->category;

    $uid = $_SESSION["id"];

    $moneyManager = new MoneyManager();
    $results = $moneyManager->retrieveDescriptions($cid,$uid);
    if(mysqli_num_rows($results) <= 0){
        return "empty";
    }

    $rows = array();
    while($row = mysqli_fetch_assoc($results)) {
        $rows[] = $moneyManager->convert_from_latin1_to_utf8_recursively($row);
    }
    $json_response = json_encode($rows);
    echo($json_response);
?>