<?php
    session_start();

    include("../classes/Connection.php");
    include("../classes/MoneyManager.php");

    $id = $_SESSION["id"];

    $moneyManager = new MoneyManager();
    $results = $moneyManager->retrieveIncomes($id);
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