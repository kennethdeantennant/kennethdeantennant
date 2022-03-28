<?php 
    session_start();

    include("../classes/Connection.php");
    include("../classes/Menu.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$today = $request->today;

    $uid = $_SESSION["id"];

    $menu = new Menu();
    $results = $menu->retrieveMealsByDate($uid,$today);

    $rows = array();
    while($r = mysqli_fetch_assoc($results)) {
        $rows[] = $r;
    }

    echo($json_response = json_encode($rows));
?>