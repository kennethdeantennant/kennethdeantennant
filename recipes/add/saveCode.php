<?php
    session_start();
    
    include("../classes/Connection.php");
    include("../classes/Recipe.php");    

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$name = $request->name;
    @$cid = $request->category;

    $uid = $_SESSION["id"];

    $recipe = new Recipe();
    $id = $recipe->save($uid, $cid, $name);

    echo($id);
?>