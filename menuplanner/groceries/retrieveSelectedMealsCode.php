<?php 
    session_start();

    include("../classes/Connection.php");
    include("../classes/Menu.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$date = $request->date;
    @$category = $request->category;

    $id = $_SESSION["id"];

    $menu = new Menu();
    $results = $menu->retrieveSelectedMeals($date, $id, $category);

    $rows = array();
    while($row = mysqli_fetch_array($results)) {
        $rows[] = $row;
    }
    
    $json_response = json_encode($rows);
    echo($json_response);
?>