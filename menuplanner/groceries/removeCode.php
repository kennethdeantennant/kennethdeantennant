<?php 
    include("../classes/Connection.php");
    include("../classes/Menu.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$ingredientId = $request->ingredient_id;

    $menu = new Menu();
    $menu->removeMealIngredient($ingredientId);

    echo("Success!");
?>