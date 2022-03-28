<?php
    session_start();

    include("../classes/Connection.php");
    include("../classes/MoneyManager.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$gross = $request->gross;
    @$net = $request->net;

    $uid = $_SESSION["id"];
    $edate = date("Y-m-d");

    $moneyManager = new MoneyManager();
    $id = $moneyManager->saveDeposit($edate, $gross, $net, $uid);

    if( $id > 0 ){
        $results = $moneyManager->retrieveCategories($uid);
        while ($results && $result = mysqli_fetch_array($results)){
            $moneyManager->saveAmount($id, $result["id"], $result["percent"]);
        }
    }

    echo($id);
?>