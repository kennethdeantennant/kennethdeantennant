<?php
    include("../classes/Connection.php");
    include("../classes/Login.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    @$username = $request->username;
    @$password = $request->password;

    $login = new Login();
    if( $login->verifyPassword($username, $password) ){
        $uid = $login->getUserID();
        session_start();
        $_SESSION['uid']=uniqid($uid);
        $_SESSION['id']=$uid;
        echo($uid);
    }else{
        echo("0");
    }
?>