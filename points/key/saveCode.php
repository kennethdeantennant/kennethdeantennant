<?php
    session_start();

    include("../classes/Connection.php");
    include("../classes/Points.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$description = $request->description;
    @$point = $request->points;

    $uid = $_SESSION["id"];

    $points = new Points();
    $id = $points->saveIngredient($description, $point, $uid);

    echo($id);
?>