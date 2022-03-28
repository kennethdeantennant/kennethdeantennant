<?php
    session_start();
    
    include("../classes/Connection.php");
    include("../classes/Recipe.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$name = $request->name;
    @$rid = $request->recipe;

    $userId = $_SESSION["id"];

    $recipe = new Recipe();
    $recipe->updateName($userId, $name, $rid);

    echo("Success!");
?>