<?php
    session_start();
    
    include("../classes/Connection.php");
    include("../classes/Recipe.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$id = $request->id;

    $recipe = new Recipe();
    $results = $recipe->retrieveRecipe( $id );
    if(mysqli_num_rows($results) <= 0){
        return "empty";
    }

    $rows = array();
    while($r = mysqli_fetch_assoc($results)) {
        $rows[] = $r;
    }

    echo($json_response = json_encode($rows));
?>