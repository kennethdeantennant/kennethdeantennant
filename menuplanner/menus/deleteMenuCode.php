<?php 
    session_start();
        
    include("../classes/Connection.php");
    include("../classes/Menu.php");

    $uid = $_SESSION["id"];

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$date = $request->menu_date;
    @$type = $request->menu_type;

    $menu = new Menu();
    $menu->delete($uid, $date, $type);

    echo("Success!");
?>