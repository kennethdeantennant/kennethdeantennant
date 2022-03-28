<?php
    session_start();
    
    include("../classes/Connection.php");
    include("../classes/Recipe.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$image = $request->image;
    @$rid = $request->recipe;

    $userId = $_SESSION["id"];

    $recipe = new Recipe();
    $recipe->updateImage($userId, $image, $rid);

    echo("Success!");
?>