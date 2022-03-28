<?php
    session_start();
    
    include("../classes/Connection.php");
    include("../classes/User.php");

    $id = $_SESSION["id"];

    $user = new User();
    $user->load($id);
    echo($user->getFirstName());
?>