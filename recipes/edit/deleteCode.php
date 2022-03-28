<?php
    include("../classes/Connection.php");
    include("../classes/Recipe.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$rid = $request->recipe;

    $recipe = new Recipe();
    $recipe->delete($rid);

    echo("Success!");
?>