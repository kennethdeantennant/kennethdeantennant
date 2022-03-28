<?php
    session_start();
    
    include("../classes/Connection.php");
    include("../classes/Recipe.php");    

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$rid = $request->recipe;
    @$tips = $request->tips;

    $uid = $_SESSION["id"];

    $recipe = new Recipe();
    $id = $recipe->addTips($uid, $rid, $tips);

    echo($id);
?>