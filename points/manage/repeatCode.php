<?php
    session_start();

    include("../classes/Connection.php");
    include("../classes/Points.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$did = $request->id;

    $uid = $_SESSION["id"];

    $points = new Points();
    $id = $points->repeat($did);

    echo($id);
?>