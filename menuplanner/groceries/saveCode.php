<?php 
    session_start();

    include("../classes/Connection.php");
    include("../classes/Menu.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$mealId = $request->mealid;
    @$ingredientId = $request->ingredientId;

    $uid = $_SESSION["id"];

    $menu = new Menu();
    $menu->saveMealIngredient($mealId, $ingredientId, $uid);

    echo("Success!");
?>