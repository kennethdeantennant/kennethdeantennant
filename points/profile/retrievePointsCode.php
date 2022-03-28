<?php
    include("../classes/Connection.php");
    include("../classes/Points.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $points = new Points();

    @$aid = $request->age;
    @$gid = $request->gender;
    @$hid = $request->height;
    @$tid = $request->activity;
    @$mid = $request->mode;

    $keys = $aid.','.$gid.','.$hid.','.$tid.','.$mid;
    $value = $points->retrieveSummaryPoints($keys);

    echo($value);
?>