<?php
    session_start();
    
    include("../classes/Connection.php");
    include("../classes/Recipe.php");    

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$rid = $request->recipe;
    @$description = $request->direction;

    $uid = $_SESSION["id"];

    $recipe = new Recipe();
    $id = $recipe->addDetail('D', $description, $rid, $uid);

    echo($id);
?>