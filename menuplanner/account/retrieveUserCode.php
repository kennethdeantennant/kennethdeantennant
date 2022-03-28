<?php
    include("../classes/Connection.php");
    include("../classes/Menu.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$uid = $request->user;

    $menu = new Menu();
    $results = $menu->retrieveUser($uid);

    if(count($results) <= 0){
        return "empty";
    }

    $rows = array();
    while($r = mysql_fetch_assoc($results)) {
        $rows[] = $r;
    }

    echo($json_response = json_encode($rows));
?>