<?php
    include("../classes/Connection.php");
    include("../classes/Recipe.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$did = $request->detail_id;

    $recipe = new Recipe();
    $recipe->deleteDetail($did);

    echo("Success!");
?>