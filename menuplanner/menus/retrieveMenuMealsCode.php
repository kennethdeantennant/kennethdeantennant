<?php 
    session_start();

    include("../classes/Connection.php");
    include("../classes/Menu.php");

    $id = $_SESSION["id"];

    $menu = new Menu();
    $results = $menu->retrieveMenuMeals($id);
    if(count($results) <= 0){
        return "empty";
    }

    $rows = array();
    while($row = mysqli_fetch_array($results)) {
        $rows[] = $row;
    }
    
    $json_response = json_encode($rows);
    echo($json_response);
?>