<?php
    session_start();
    
    include("../classes/Connection.php");
    include("../classes/Recipe.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$rdid = $request->detail_id;
    @$description = $request->detail_description;

    $userId = $_SESSION["id"];

    $recipe = new Recipe();
    $recipe->updateDescription($userId, $description, $rdid);

    echo("Success!");
?>