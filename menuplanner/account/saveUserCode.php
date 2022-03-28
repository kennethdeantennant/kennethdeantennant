<?php
    include("../classes/Connection.php");
    include("../classes/Menu.php");
    include("../tools/tools.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$username = $request->username;
    @$password = $request->password;
    @$firstname = $request->firstname;
    @$middlename = $request->middlename;
    @$lastname = $request->lastname;
    @$phone = $request->phone;
    @$altphone = $request->altphone;
    @$email = $request->email;

    $menu = new Menu();
    $uid = $menu->saveUser($firstname, $middlename, $lastname, $phone, $altphone, $email);
    $lid = $menu->saveLogin($username, $password, $uid);
    $menu->updateLogin($uid, $lid);

    if( strlen( $email )> 0 ){
        $tools = new Tools();
        $fullName = $firstname." ".$lastname;
        $tools->sendWelcomeEmail($email, $fullName);
    }

    echo($uid);
?>