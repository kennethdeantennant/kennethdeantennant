<?php
    session_start();
    
    include("../classes/Connection.php");
    include("../classes/Recipe.php");    

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$cid = $request->category_id;

    $uid = $_SESSION["id"];

    $recipe = new Recipe();
    $id = $recipe->deleteCategory( $cid );

    echo($id);
?>