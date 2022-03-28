<?php
    include("../classes/Connection.php");
    include("../classes/Recipe.php");

    $recipe = new Recipe();
    $results = $recipe->retrieveRecipes();

    $rows = array();
    while($r = mysqli_fetch_assoc($results)) {
        $rows[] = $r;
    }

    $json_response = json_encode($rows);
    echo($json_response);
?>