<?php
    include("../classes/Connection.php");
    include("../classes/Points.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$pid = $request->profile;
    @$name = $request->name;
    @$value = $request->value;

    $points = new Points();
    $results = false;
    switch($name){
        case "gender":
            $results = $points->updateGender($pid, $value);
            break;
        case "age":
            $results = $points->updateAge($pid, $value);
            break;
        case "height":
            $results = $points->updateHeight($pid, $value);
            break;
        case "activity":
            $results = $points->updateActivity($pid, $value);
            break;
        case "weight":
            $results = $points->updateWeight($pid, $value);
            break;
        case "mode":
            $results = $points->updateMode($pid, $value);
            break;
    }

    if( $results ){
        return "Success!";
    }
    return "empty";

?>