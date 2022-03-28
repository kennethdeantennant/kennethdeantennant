<?php // This is the LogonInfo
    class Login extends Connection{

        private $dbTable;
        
        private $id;
        private $username;
        private $password;
        private $status;
        private $userID;

        function Login(){
            parent::Connection();
            $this->dbTable = "Login";
        }

        // Class methods
        function getId(){
            return $this->id;
        }

        function getUsername(){
            return $this->username;
        }

        function getPassword(){
            return $this->password;
        }

        function getUserID(){
            return $this->userID;
        }
        
        function load($uid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $select = "select * from $this->dbTable where uidFK = ".$uid;
            $result = $this->select($select);

            if($result){  //Do logic if successful
                $this->id = $this->fetch("id");
                $this->username = $this->fetch("username");
                $this->password = $this->fetch("password");
                $this->status = $this->fetch("status");
                $this->userID = $this->fetch("uidFK");
            }
            
            //Disconnect
            $this->disconnect();
        }

        function checkUsername($name){
            $returnValue = false;
            
            //Connect
            $this->connect();
            
            //Create and execute SQL
            $select = "select * from $this->dbTable where status='1' and username = '$name'";
            $result = $this->select($select);

            if($result){ // Do logic if successful
                $username = $this->fetch("username");

                if($name == $username){  // Verify that they match
                    $returnValue = true;
                }
            }

            // Disconnect
            $this->disconnect();

            return $returnValue;
        }

        function verifyPassword($name, $password){
            $returnValue = false;
            
            //Connect
            $this->connect();
            
            //Create and execute SQL
            $md5 = MD5($password);
			
            $query = "select * from $this->dbTable where status='1' and username = '$name' and password = '$md5'";
            $result = $this->select($query);

            if($result){ // Do logic if successful
                $username = $this->fetch("username");

                if($name == $username){  // Verify that they match
                    $this->userID = $this->fetch("uidFK");
                    $returnValue = true;
                }
            }

            // Disconnect
            $this->disconnect();

            return $returnValue;
        }

        function update($uid, $username, $password){
            $returnValue = false;

            //Connect
            $this->connect();

            //Create and execute SQL
			$update = "update $this->dbTable set username = '$username', password = '$password' where uidFK = $uid";
			$result = $this->execute($update);
			if($result){
				$returnValue = true;
            }
            
            //Disconnect
            $this->disconnect();

            return $returnValue;
        }

        function save($username, $password){
            $id = 0;
            
            //Connect
            $this->connect();
            
            //Create and execute SQL
            $md5 = MD5($password);
            $insert = "insert into $this->dbTable (username, password, status) values('$username', '$md5', 1)";
            $id = $this->insert($insert);

            //Disconnect
            $this->disconnect();
            
            return $id;
        }
        
        function updateUID($lid, $uid){
            //Connect
            $this->connect();
            
            //Create and execute SQL
            $update = "update $this->dbTable set uidFK=$uid where id=$lid";
            $result = $this->execute($update);

            //Disconnect
            $this->disconnect();
        }
        
    }
?>