<?php 
    session_start();

    include("../classes/Connection.php");
    include("../classes/Menu.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$mealingredientId = $request->mealingredient_id;
    @$quantity = $request->quantity;

    $id = $_SESSION["id"];

    $menu = new Menu();
    $menu->updateQuantityForIngredient($mealingredientId, $id, $quantity);

    echo("Success!");
?>