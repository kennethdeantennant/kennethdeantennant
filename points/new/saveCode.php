<?php
    session_start();

    include("../classes/Connection.php");
    include("../classes/Points.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$description = $request->description;
    @$type = $request->type;
    @$point = $request->point;

    $uid = $_SESSION["id"];

    $points = new Points();
    $id = $points->saveFood($uid, $description, $type, $point);

    echo($id);
?>