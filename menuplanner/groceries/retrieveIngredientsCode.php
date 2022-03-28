<?php 
    session_start();

    include("../classes/Connection.php");
    include("../classes/Menu.php");

    $menu = new Menu();
    $results = $menu->retrieveIngredents();

    $rows = array();
    while($row = mysqli_fetch_array($results)) {
        $rows[] = $row;
    }
    
    $json_response = json_encode($rows);
    echo($json_response);
?>