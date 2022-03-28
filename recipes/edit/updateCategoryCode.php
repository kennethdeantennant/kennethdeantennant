<?php
    session_start();
    
    include("../classes/Connection.php");
    include("../classes/Recipe.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$rid = $request->recipe;
    @$cid = $request->category;

    $uid = $_SESSION["id"];

    $recipe = new Recipe();
    $recipe->updateCategory($uid, $cid, $rid);

    echo("Success!");
?>