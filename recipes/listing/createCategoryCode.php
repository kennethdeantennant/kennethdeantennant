<?php
    session_start();
    
    include("../classes/Connection.php");
    include("../classes/Recipe.php");    

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$name = $request->name;

    $uid = $_SESSION["id"];

    $recipe = new Recipe();
    $id = $recipe->saveCategory($name, $uid);

    echo($id);
?>