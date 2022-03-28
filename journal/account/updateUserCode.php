<?php
    include("../classes/Connection.php");
    include("../classes/Journal.php");
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

    $journal = new Journal();
    $results = $journal->updateUser($uid, $username, $password, $firstname, $middlename, $lastname, $phone, $altphone, $email);

    $whitelist = ['127.0.0.1','::1'];
    if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
        if( strlen( $email ) > 0 ){
            $tools = new Tools();
            $fullName = $firstname." ".$lastname;
            $tools->sendUpdateEmail($email, $fullName);
        }
    }    

    if($results == "1"){
        echo("Success!");  
    }else{
        echo("Failed!");
    }
?>