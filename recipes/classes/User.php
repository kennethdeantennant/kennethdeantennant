<?php // This is the User class
    class User extends Connection{

        private $dbTable;
        private $dbTableLogin;
        
        private $id;
        private $fname;
        private $mname;
        private $lname;
        private $phone;
        private $altPhone;
		private $email;
        private $udate;
        private $logonID;

        function User(){
            parent::Connection();
            $this->dbTable = "User";
			$this->dbTableLogin = "Login";
        }

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
                $this->id = $this->fetch("id");
                $this->fname = $this->fetch("firstName");
                $this->mname = $this->fetch("middleName");
                $this->lname = $this->fetch("lastName");
                $this->phone = $this->fetch("phoneNumber");
                $this->altPhone = $this->fetch("altPhoneNumber");
				$this->email = $this->fetch("email");
                $this->udate = $this->fetch("udate");
                $this->logonID = $this->fetch("lidFK");
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
            $insert = "insert into $this->dbTable (firstName, middleName, lastName, phoneNumber, altPhoneNumber, email, udate, lidFK) values('$firstName', '$middleName', '$lastName', '$phoneNumber', '$altPhoneNumber', '$email', '$date', $lid)";
            $id = $this->insert($insert);

            //Disconnect
            $this->disconnect();
            
            return $id;
        }
        
        function retrieveAllUsernames(){
            //Connect
            $this->connect();

            //Create and execute query
            $retrieve = "SELECT l.username FROM $this->dbTable u inner join $this->dbTableLogin l on u.lidFK = l.id WHERE l.status='1'";
            $results = $this->selectAll($retrieve);

            //Disconnect
            $this->disconnect();

            return $results;
        }

    }
?>