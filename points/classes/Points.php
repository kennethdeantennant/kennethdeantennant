<?php
    class Points extends Connection{

        private $dbTableUser = "User";
        private $dbTableLogin = "Login";
        private $dbTableDaily = "Daily";
        private $dbTableFood = "Food";
        private $dbTableFactor = "Factor";
        private $dbTableProfile = "Profile";
        private $dbTableIngredient = "Ingredient";
        
        private $gender;
        private $age;
        private $height;
        private $activity;
        private $weight;

        function retrieveProfile($id){
            //Connect
            $this->connect();

            //Create and execute query
			
			$query = "select * from $this->dbTableProfile where user_id = $id";
            $resultsArray = $this->select($query);
            
            //Disconnect
            $this->disconnect();

            return $this->fetchResults();
        }
        
        function retrieveUser($uid){
            //Connect
            $this->connect();

            //Create and execute query
            $query = "select * from $this->dbTableUser u inner join $this->dbTableLogin l on u.id = l.user_id where u.id=$uid";
            $resultsArray = $this->select($query);
            
            // Close connection
            $this->disconnect();

            return $this->fetchResults();
        }
        
        function updateUser($uid, $username, $password, $firstname, $middlename, $lastname, $phone, $altphone, $email){
            // Connect to database
            $this->connect();

            // Create and execute query
            $update = "update $this->dbTableLogin set username='$username' where user_id=$uid";
            $result = $this->execute($update);
            
            if( strlen($password) > 0 ){
                $md5_password = md5($password);
                $update = "update $this->dbTableLogin set password='$md5_password' where user_id=$uid";
                $result = $this->execute($update);
            }
            
            $date = date("Y-m-d");
            $update = "update $this->dbTableUser set firstName='$firstname',middleName='$middlename',lastName='$lastname',phoneNumber='$phone',altPhoneNumber='$altphone',email='$email',udate='$date' where id=$uid";
            $result = $this->execute($update);


            //Disconnect
            $this->disconnect();
            
            return true;
        }
        
        function saveUser($firstname, $middlename, $lastname, $phone, $altphone, $email){
            // Connect to database
            $this->connect();

            $date = date("Y-m-d");

            // Create and execute query
            $update = "insert into $this->dbTableUser (firstName, middleName, lastName, phoneNumber, altPhoneNumber, email, udate) values('$firstname','$middlename','$lastname','$phone','$altphone','$email','$date')";
            $result = $this->execute($update);
            $uid = mysql_insert_id();
            
            //Disconnect
            $this->disconnect();
            
            return $uid;
        }
        
        function saveLogin($username, $password, $uid){
            // Connect to database
            $this->connect();

            // Create and execute query
            $md5_password = md5($password);
            $update = "insert into $this->dbTableLogin (username,password,status,user_id) values('$username','$md5_password',1,'$uid')";
            $result = $this->execute($update);
            $lid = mysql_insert_id();
            
            //Disconnect
            $this->disconnect();
            
            return $lid;
        }
        
        function updateLogin($uid, $lid){
            // Connect to database
            $this->connect();

            $update = "update $this->dbTableUser set login_id=$lid where id=$uid";
            $result = $this->execute($update);
            
            //Disconnect
            $this->disconnect();
            
            return $uid;
        }

        function retrieveTypes($type){
            //Connect
            $this->connect();

            //Create and execute query
            $query = "select id, concat(description, ' (' ,code,' pts)') as description from $this->dbTableFactor where type='$type' order by id";
            $results = $this->select($query);

            //Disconnect
            $this->disconnect();

            return $this->fetchResults();
        }
        
        function retrieveTypePointValue($id){
            //Connect
            $this->connect();

            //Create and execute query
            $query = "select code from $this->dbTableFactor where id='$id'";
            $results = $this->select($query);

            //Disconnect
            $this->disconnect();

            return $this->fetch(0);
        }
        
        function retrieveSummaryPoints($values){
            //Connect
            $this->connect();

            //Create and execute query
            $query = "select sum(code) from $this->dbTableFactor where id in ($values)";
            $results = $this->select($query);

            //Disconnect
            $this->disconnect();

            return $this->fetch(0);
        }
        
        function updateGender($id, $value){
            //Connect
            $this->connect();
            
            //Create and execute query
            $update = "update $this->dbTableProfile set gender=$value where id=$id";
            $result = $this->execute($update);

            // Close database connection
            $this->disconnect();

            return true;            
        }
        
        function updateAge($id, $value){
            //Connect
            $this->connect();
            
            //Create and execute query
            $update = "update $this->dbTableProfile set age=$value where id=$id";
            $result = $this->execute($update);

            // Close database connection
            $this->disconnect();

            return true;            
        }
        
        function updateHeight($id, $value){
            //Connect
            $this->connect();
            
            //Create and execute query
            $update = "update $this->dbTableProfile set height=$value where id=$id";
            $result = $this->execute($update);

            // Close database connection
            $this->disconnect();

            return true;            
        }
        
        function updateActivity($id, $value){
            //Connect
            $this->connect();
            
            //Create and execute query
            $update = "update $this->dbTableProfile set activity=$value where id=$id";
            $result = $this->execute($update);

            // Close database connection
            $this->disconnect();

            return true;            
        }
        
        function updateWeight($id, $value){
            //Connect
            $this->connect();
            
            //Create and execute query
            $update = "update $this->dbTableProfile set weight=$value where id=$id";
            $result = $this->execute($update);

            // Close database connection
            $this->disconnect();

            return true;            
        }
        
        function updateMode($id, $value){
            //Connect
            $this->connect();
            
            //Create and execute query
            $update = "update $this->dbTableProfile set mode=$value where id=$id";
            $result = $this->execute($update);

            // Close database connection
            $this->disconnect();

            return true;            
        }
        
        function retrievePoints($uid, $day){
            //Connect
            $this->connect();
            
            //Create and execute query
            $query = "select sum(f.points*d.quantity) as points from $this->dbTableDaily d inner join $this->dbTableFood f on d.food_id=f.id where date = '".$day."' and d.user_id=".$uid;
            $result = $this->select($query);

            // Close database connection
            $this->disconnect();

            return $this->fetch(0);
        }
        
        function retrievePointsForWeek($uid, $day){
            //Connect
            $this->connect();
            
            //Create and execute query
            $query = "select f.description, d.quantity, f.type, f.points from $this->dbTableDaily d inner join $this->dbTableFood f on d.food_id=f.id where date = '".$day."' and f.user_id=".$uid;
            $results = $this->select($query);

            // Close database connection
            $this->disconnect();

            return $this->fetchResults();
        }
        
        function retrieveFoods($uid){
            //Connect
            $this->connect();
            
            //Create and execute query
            $query = "select id, concat(description,' ' ,points) as fulldescription, type, points, description from $this->dbTableFood where user_id=$uid order by description";
            $results = $this->select($query);

            // Close database connection
            $this->disconnect();

            return $this->fetchResults();
        }
        
        function retrieveIngredients($uid){
            //Connect
            $this->connect();
            
            //Create and execute query
            $query = "select * from $this->dbTableIngredient where user_id = $uid order by description";
            $results = $this->select($query);

            // Close database connection
            $this->disconnect();

            return $this->fetchResults();
        }
        
        function retrieveSelectedDates(){
            //Connect
            $this->connect();
            
            //Create and execute query
            $query = "select distinct date from $this->dbTableDaily order by date desc";
            $results = $this->select($query);

            // Close database connection
            $this->disconnect();

            return $this->fetchArray();
        }
        
        function retrieveSelectedFoods($uid, $day){
            //Connect
            $this->connect();
            
            //Create and execute query
            $query = "select d.id as daily_id, d.quantity, d.quantity*f.points as points, f.id, f.description, f.type from $this->dbTableDaily d inner join $this->dbTableFood f on d.food_id=f.id where d.user_id = $uid and d.date = '$day' ORDER BY d.id";
            $results = $this->select($query);

            // Close database connection
            $this->disconnect();

            return $this->fetchResults();
        }
        
        function save($uid, $day, $fid){
            // Connect to database
            $this->connect();

            $time = date("HH:mm:ss");

            // Create and execute query
            $query = "insert into $this->dbTableDaily (user_id, food_id, date, time) values($uid, $fid, '$day', '$time')";
            $results = $this->insert($query);

            // Close connection
            $this->disconnect();

            return $results;
        }
        
        function repeat($did){
            // Connect to database
            $this->connect();

            $time = date("HH:mm:ss");

            // Create and execute query
            $query = "update $this->dbTableDaily set quantity = quantity + 1 where id=$did";
            $results = $this->insert($query);

            // Close connection
            $this->disconnect();

            return $results;
        }
        
        function remove($did){
            // Connect to database
            $this->connect();

            $time = date("HH:mm:ss");

            // Create and execute query
            $query = "update $this->dbTableDaily set quantity = quantity - 1 where id=$did";
            $results = $this->insert($query);

            // Close connection
            $this->disconnect();

            return $results;
        }
        
        function delete($did){
            // Connect to database
            $this->connect();

            // Create and execute query
            $execute = "delete from $this->dbTableDaily where id = $did";
            $this->execute($execute);

            //Disconnect
            $this->disconnect();

            return true;
        }
        
        function saveFood($uid, $description, $type, $point){
            // Connect to database
            $this->connect();

            // Create and execute query
            $query = "insert into $this->dbTableFood (description, type, points, user_id) values('$description', '$type', $point, $uid)";
            $results = $this->insert($query);

            // Close connection
            $this->disconnect();

            return $results;
        }
        
        function saveIngredient($description, $points, $uid){
            // Connect to database
            $this->connect();

            // Create and execute query
            $query = "insert into $this->dbTableIngredient (description, points, user_id) values('$description', $points, $uid)";
            $results = $this->insert($query);

            // Close connection
            $this->disconnect();

            return $results;
        }
        
        function deleteFood($fid){
            // Connect to database
            $this->connect();

            // Create and execute query
            $execute = "delete from $this->dbTableFood where id = $fid";
            $this->execute($execute);

            //Disconnect
            $this->disconnect();

            return true;
        }
        
        function deleteIngredient($iid){
            // Connect to database
            $this->connect();

            // Create and execute query
            $execute = "delete from $this->dbTableIngredient where id = $iid";
            $this->execute($execute);

            //Disconnect
            $this->disconnect();

            return true;
        }
    }
?>