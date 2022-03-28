<?php // This is the User class
    class User extends Connection{


        private $dbTable = "User";
        private $dbTableLogin = "Login";
        
        private $id;
        private $fname;
        private $mname;
        private $lname;
        private $phone;
        private $altPhone;
		private $email;
        private $udate;
        private $logonID;

        function getId(){
            return $this->id;
        }

        function getFirstName(){
            return $this->fname;
        }

        function getMiddleName(){
            return $this->mname;
        }

        function getLastName(){
            return $this->lname;
        }

        function getPhone(){
            return $this->phone;
        }

        function getAltPhone(){
            return $this->altPhone;
        }

        function getEmail(){
            return $this->email;
        }

        function getDate(){
            return $this->udate;
        }

        function getLogonID(){
            return $this->logonID;
        }

        function getName(){
            return trim($this->fname)." ".trim($this->lname);
        }

        function load($uid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $select = "select * from $this->dbTable where Id = ".$uid;
            $result = $this->select($select);

            if($result){  //Do logic if successful
                $this->id = $this->fetch(0);
                $this->fname = $this->fetch(1);
                $this->mname = $this->fetch(2);
                $this->lname = $this->fetch(3);
                $this->phone = $this->fetch(4);
                $this->altPhone = $this->fetch(5);
				$this->email = $this->fetch(6);
                $this->udate = $this->fetch(7);
                $this->logonID = $this->fetch(8);
            }
            
            //Disconnect
            $this->disconnect();
        }
        
        function update($uid, $firstName, $middleName, $lastName, $phoneNumber, $altPhoneNumber, $email){
            $id = 0;
            
            //Connect
            $this->connect();
            
            //Create and execute SQL
            $date = date("Y-m-d");
            $update = "update $this->dbTable set firstName = '$firstName', middleName = '$middleName', lastName = '$lastName', phoneNumber = '$phoneNumber', altPhoneNumber = '$altPhoneNumber', email = '$email', udate = '$date' where id = $uid";
            $id = $this->execute($update);

            //Disconnect
            $this->disconnect();
            
            return $id;
        }
        
        function save($firstName, $middleName, $lastName, $phoneNumber, $altPhoneNumber, $email, $lid){
            $id = 0;
            
            //Connect
            $this->connect();
            
            //Create and execute SQL
            $date = date("Y-m-d");
            $insert = "insert into $this->dbTable (firstName, middleName, lastName, phoneNumber, altPhoneNumber, email, udate, login_id) values('$firstName', '$middleName', '$lastName', '$phoneNumber', '$altPhoneNumber', '$email', '$date', $lid)";
            $id = $this->insert($insert);

            //Disconnect
            $this->disconnect();
            
            return $id;
        }
        
        function retrieveAllUsernames(){
            //Connect
            $this->connect();

            //Create and execute query
            $retrieve = "SELECT l.username FROM $this->dbTable u inner join $this->dbTableLogin l on u.login_id = l.id WHERE l.status='1'";
            $results = $this->select($retrieve);

            //Disconnect
            $this->disconnect();

            return $this->fetchAll();
        }
    }
?>