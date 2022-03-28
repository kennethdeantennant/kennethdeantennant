<?php 
    include("../classes/Connection.php");
    include("../classes/Menu.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$mealId = $request->meal_id;
    @$categoryType = $request->category;

    $menu = new Menu();
    $menu->deleteMeal($mealId, $categoryType);

    echo("Success!");
?>