<?php
    include("../classes/Connection.php");
    include("../classes/Recipe.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$name = $request->name;

    $recipe = new Recipe();
    $results = $recipe->retrieveRecipeByName( $name );
    if(count($results) <= 0){
        echo(null);
    }

    $rows = array();
    while($r = mysqli_fetch_assoc($results)) {
        $rows[] = $r;
    }

    echo($json_response = json_encode($rows));
?>