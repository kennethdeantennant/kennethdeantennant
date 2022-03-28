<?php // This is the LogonInfo
    class Login extends Connection{

        private $dbTable = "Login";
        
        private $id;
        private $username;
        private $password;
        private $status;
        private $userID;

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
        
        function getLoginInfo(){
            return "(".$this->userID.") Username: ".$this->username."; Password: ".$this->password."; Status: ".$this->status;
        }
        
        function load($uid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $select = "select * from $this->dbTable where user_id = ".$uid;
            $result = $this->select($select);

            if($result){  //Do logic if successful
                $this->id = $this->fetch(0);
                $this->username = $this->fetch(1);
                $this->password = $this->fetch(2);
                $this->status = $this->fetch(3);
                $this->userID = $this->fetch(4);
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
                $username = $this->fetch(1);

                if($name === $username){  // Verify that they match
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
			
            $select = "select * from $this->dbTable where status='1' and username = '$name' and password = '$md5'";
            $result = $this->select($select);

            if($result){ // Do logic if successful
                $username = $this->fetch(1);
                
                if($name === $username){  // Verify that they match
                    $this->userID = $this->fetch("user_id");
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
			$update = "update $this->dbTable set username = '$username', password = '$password' where user_id = $uid";
			$result = $this->execute($update);
			
            //Disconnect
            $this->disconnect();

            return $result;
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
            $update = "update $this->dbTable set user_id=$uid where id=$lid";
            $result = $this->execute($update);

            //Disconnect
            $this->disconnect();
        }        
    }
?>