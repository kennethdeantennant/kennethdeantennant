<?php
    include("../classes/Connection.php");
    include("../classes/Points.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$did = $request->id;

    $points = new Points();
    $id = $points->delete($did);

    echo("Success");
?>