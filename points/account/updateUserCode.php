<?php
    include("../classes/Connection.php");
    include("../classes/Points.php");
    include("../tools/tools.php");

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    @$uid = $request->id;
    @$username = $request->username;
    @$password = $request->password;
    @$firstname = $request->firstname;
    @$middlename = $request->middlename;
    @$lastname = $request->lastname;
    @$phone = $request->phone;
    @$altphone = $request->altphone;
    @$email = $request->email;

    $points = new Points();
    $results = $points->updateUser($uid, $username, $password, $firstname, $middlename, $lastname, $phone, $altphone, $email);

    if( strlen( $email )> 0 ){
        $tools = new Tools();
        $fullName = $firstname." ".$lastname;
        $tools->sendUpdateEmail($email, $fullName);
    }

    echo("Success!");
?>