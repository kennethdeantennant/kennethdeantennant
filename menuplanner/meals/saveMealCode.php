<?php 
    include("../classes/Connection.php");
    include("../classes/Menu.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$name = $request->name;
    @$categoryType = $request->category;

    $menu = new Menu();
    $id = $menu->saveMeal($name, $categoryType);

    echo($id);
?>