<?php
    session_start();

    include("../classes/Connection.php");
    include("../classes/Menu.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$menuDate = $request->today;
    @$mealId = $request->meal_id;
    @$menuType = $request->category;

    $userId = $_SESSION["id"];

    $menu = new Menu();
    $menu->uncheck($menuDate, $mealId, $userId, $menuType);

    echo("Success!");
?>