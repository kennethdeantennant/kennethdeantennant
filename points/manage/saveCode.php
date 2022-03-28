<?php
    session_start();

    include("../classes/Connection.php");
    include("../classes/Points.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$fid = $request->id;
    @$day = $request->day;

    $uid = $_SESSION["id"];

    $points = new Points();
    $id = $points->save($uid, $day, $fid);

    echo($id);
?>