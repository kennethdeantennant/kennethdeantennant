<?php // This is the Category class
    class MoneyManager extends Connection{

        private $dbTableDeposit = "Deposit";
        private $dbTableAmount = "Amount";
        private $dbTableDetail = "Detail";
        private $dbTableCategory = "Category";
        private $dbTableUser = "User";
        private $dbTableLogin = "Login";
        
        function retrieveCategories($id){
            //Connect
            $this->connect();

            //Create and execute query
			$select = "select * from $this->dbTableCategory where (assigned=0 or assigned=$id) and view=' ' order by id, assigned";
            $results = $this->select($select);
            
            //Disconnect
            $this->disconnect();

            return $this->fetchResults();
        }

        function retrieveCategorySummaries($id){
            //Connect
            $this->connect();

            //Create and execute query	
			$select = "select c.id, c.active, c.name, sum(d.amount) as amount, c.assigned, c.description from $this->dbTableCategory c inner join $this->dbTableDetail d on c.id = d.category_id where (assigned=0 or assigned=$id) and view=' ' and d.user_id=$id group by c.name order by c.id, c.assigned";
            $results = $this->select($select);
            
            //Disconnect
            $this->disconnect();

            return $this->fetchResults();
        }

        function retrieveCategoryTotalAmount($uid, $cid){
            //Connect
            $this->connect();

            //Create and execute query
			$select = "select c.id, c.active, c.name, sum(d.amount) as amount, c.assigned, c.description from $this->dbTableCategory c inner join $this->dbTableDetail d on c.id = d.category_id where (assigned=0 or assigned=$uid) and view=' ' and d.user_id=$uid and c.id=$cid group by c.name order by c.id, c.assigned";
            $results = $this->select($select);
            
            //Disconnect
            $this->disconnect();

            return $this->fetchResults();
        }

        function openOrClose($id, $active){
            // Connect to database
            $this->connect();

            // Create and execute query
            $update = "update $this->dbTableCategory set active='$active' where id=$id";
            $result = $this->execute($update);

            //Disconnect
            $this->disconnect();
            
            return $result;
        }

        function save($name, $description, $uid){
            // Connect to database
            $this->connect();

            // Create and execute query
            $insert = "insert into $this->dbTableCategory (name, description, percent, assigned, active, view) values('$name', '$description', 0.00, $uid, 'Y', '')";
            $results = $this->insert($insert);
            
            //Disconnect
            $this->disconnect();

            return $results;
        }

        function delete($id){
            // Connect to database
            $this->connect();

            // Create and execute query
            $update = "delete from $this->dbTableCategory where id=$id";
            $results = $this->execute($update);

            //Disconnect
            $this->disconnect();
            
            return $results;
        }

        function update($id, $name, $description, $percent, $uid){
            // Connect to database
            $this->connect();

            // Create and execute query
            $query = "update $this->dbTableCategory set name='$name', description='$description', percent='$percent' where id=$id and assigned=$uid";
            $results = $this->execute($query);

            //Disconnect
            $this->disconnect();

            return $results;
        }
        
        function retrieveTransactions($category, $user){
            //Connect
            $this->connect();

            //Create and execute query
			$select = "select * from $this->dbTableDetail where category_id=$category and user_id=$user order by date desc, time desc";
            $results = $this->select($select);
            
            //Disconnect
            $this->disconnect();

            return $this->fetchResults();
        }

        function retrieveTransactionsByCategory($user, $category){
            //Connect
            $this->connect();

            //Create and execute query
			$select = "select d.description, abs(sum(d.amount)) as amount, max(year(d.date)) as year, c.name as cat, c.id as cat_id from $this->dbTableDetail d inner join $this->dbTableCategory c on d.category_id = c.id where c.id=$category and d.user_id=$user and d.amount<0 group by d.description, year(d.date) order by year(d.date), c.id, d.description";
            $results = $this->select($select);
            
            //Disconnect
            $this->disconnect();

            return $this->fetchResults();
        }

        function retrieveCategory($category, $uid){
            //Connect
            $this->connect();

            //Create and execute query
			$select = "select c.name, sum(d.amount) as amount from $this->dbTableCategory c inner join $this->dbTableDetail d on c.id = d.category_id where c.id=$category and d.user_id=$uid";
            $results = $this->select($select);
            
            //Disconnect
            $this->disconnect();

            return $this->fetchResults();
        }
        
        function deleteDetail($did){
            //Connect
            $this->connect();

            //Create and execute query
            $delete = "delete from $this->dbTableDetail where id=$did";
            $results = $this->execute($delete);

            //Disconnect
            $this->disconnect();

            return $results;
        }

        function retrieveDescriptions($cid,$id){
            //Connect
            $this->connect();

            //Create and execute query
            $retrieve = "SELECT Distinct d.description as description FROM $this->dbTableDetail d, $this->dbTableCategory c WHERE d.category_id=$cid and d.user_id=$id and d.category_id=c.id and c.active='Y' ORDER BY d.description";
            $results = $this->select($retrieve);

            //Disconnect
            $this->disconnect();

            return $this->fetchResults();
        }
        
        function saveDetail($amount, $date, $time, $description, $id, $uid){
            //Connect
            $this->connect();

            $float = floatval($amount);
            $time = date("h:i:s");
            
            //Create and execute query
            $insert = "insert into $this->dbTableDetail (amount, date, time, description, category_id, user_id) values($float, '$date', '$time', '$description', $id, $uid)";
            $results = $this->insert($insert);

            //Disconnect
            $this->disconnect();

            return $results;
        }

        function retrieveAsOfDates(){
            //Connect
            $this->connect();

            //Create and execute query
            $retrieve = "select distinct date from $this->dbTableDetail ORDER BY date desc, time desc";
            $results = $this->select($retrieve);

            //Disconnect
            $this->disconnect();

            return $this->fetchResults();
        }
        
        function retrieveDeposits($uid){
            //Connect
            $this->connect();

            //Create and execute query
            $retrieve = "SELECT a.type_id, d.edate, d.gross, d.net, a.percent, c.id as category_id, c.name, c.description, d.id, d.finalized FROM $this->dbTableDeposit d inner join $this->dbTableAmount a on d.id = a.deposit_id inner join $this->dbTableCategory c on a.type_id = c.id where d.user_id=$uid order by d.edate desc, c.id, c.assigned";
            $results = $this->select($retrieve);

            //Disconnect
            $this->disconnect();

            return $this->fetchResults();
        }
        
        function retrieveDeposit($id, $uid){
            //Connect
            $this->connect();

            //Create and execute query
            $retrieve = "SELECT * FROM $this->dbTableDeposit where id=$id and user_id=$uid";
            $results = $this->select($retrieve);

            //Disconnect
            $this->disconnect();

            return $this->fetchResults();
        }
        
        function saveDeposit($date, $gross, $net, $uid){
            //Connect
            $this->connect();

            //Create and execute query
            $insert = "insert into $this->dbTableDeposit (edate, gross, net, finalized, user_id) values('$date',$gross,$net,'',$uid)";
            $results = $this->insert($insert);
            $this->entryId = $results;
                
            //Disconnect
            $this->disconnect();

            return $results;
        }
        
        function saveAmount($did, $cid, $percent){
            //Connect
            $this->connect();
            
            //Create and execute query
            $insert = "insert into $this->dbTableAmount values($did, $cid, $percent)";
            $results = $this->insert($insert);

            // Close database connection
            $this->disconnect();

            return $results;
        }
        
        function updateAmount($did, $tid, $percent){
            //Connect
            $this->connect();
            
            //Create and execute query
            $update = "update $this->dbTableAmount set percent=$percent where deposit_id=$did and type_id=$tid";
            $results = $this->execute($update);

            // Close database connection
            $this->disconnect();

            return $results;
        }
        
        function finalize($did){
            //Connect
            $this->connect();

            //Create and execute query
            $update = "update $this->dbTableDeposit set finalized='Y' where id=$did and (finalized is null or finalized='')";
            $results = $this->execute($update);

            //Disconnect
            $this->disconnect();

            return $results;
        }

        function deleteDeposit($did){
            // Connect to database
            $this->connect();

            // Create and execute query
            $update = "delete from $this->dbTableDeposit where id=$did";
            $results = $this->execute($update);
            
            $update = "delete from $this->dbTableAmount where deposit_id=$did";
            $results = $this->execute($update);

            //Disconnect
            $this->disconnect();
            
            return true;
        }
        
        function updateGrossAmount($did, $amount){
            //Connect
            $this->connect();
            
            //Create and execute query
            $update = "update $this->dbTableDeposit set gross=$amount where id=$did";
            $results = $this->execute($update);

            // Close database connection
            $this->disconnect();

            return $results;
        }
        
        function updateNetAmount($did, $amount){
            //Connect
            $this->connect();
            
            //Create and execute query
            $update = "update $this->dbTableDeposit set net=$amount where id=$did";
            $results = $this->execute($update);

            // Close database connection
            $this->disconnect();

            return $results;
        }
        
        function retrieveUser($uid){
            //Connect
            $this->connect();

            //Create and execute query
            $retrieve = "select * from $this->dbTableUser u inner join $this->dbTableLogin l on u.id = l.user_id where u.id=$uid";
            $results = $this->select($retrieve);

            //Disconnect
            $this->disconnect();

            return $this->fetchResults();
        }
        
        function updateUser($uid, $username, $password, $firstname, $middlename, $lastname, $phone, $altphone, $email, $deposit){
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
            $update = "update $this->dbTableUser set firstName='$firstname',middleName='$middlename',lastName='$lastname',phoneNumber='$phone',altPhoneNumber='$altphone',email='$email',udate='$date',deposit='$deposit' where id=$uid";
            $result = $this->execute($update);

            //Disconnect
            $this->disconnect();
            
            return $result;
        }
        
        function saveUser($firstname, $middlename, $lastname, $phone, $altphone, $email, $deposit){
            // Connect to database
            $this->connect();

            $date = date("Y-m-d");

            // Create and execute query
            $update = "insert into $this->dbTableUser (firstName, middleName, lastName, phoneNumber, altPhoneNumber, email, udate, deposit) values('$firstname','$middlename','$lastname','$phone','$altphone','$email','$date','$deposit')";
            $results = $this->execute($update);
            
            //Disconnect
            $this->disconnect();
            
            return $results;
        }
        
        function saveLogin($username, $password, $uid){
            // Connect to database
            $this->connect();

            // Create and execute query
            $md5_password = md5($password);
            $update = "insert into $this->dbTableLogin (username,password,status,user_id) values('$username','$md5_password',1,'$uid')";
            $results = $this->execute($update);
            
            //Disconnect
            $this->disconnect();
            
            return $results;
        }
        
        function updateLogin($uid, $lid){
            // Connect to database
            $this->connect();

            $update = "update $this->dbTableUser set login_id=$lid where id=$uid";
            $results = $this->execute($update);
            
            //Disconnect
            $this->disconnect();
            
            return $results;
        }
        
        function retrieveYears($uid){
            //Connect
            $this->connect();

            //Create and execute query
            $retrieve = "select distinct year(date) as year from $this->dbTableDetail ORDER BY date desc";
            $results = $this->select($retrieve);

            //Disconnect
            $this->disconnect();

            return $this->fetchResults();
        }
        
        function retrieveIncomes( $uid ){
            //Connect
            $this->connect();

            //Create and execute query
            $retrieve = "SELECT year(edate) as year, sum(gross) as gross, sum(net) as net FROM $this->dbTableDeposit where user_id=$uid GROUP BY year(edate) DESC";
            $results = $this->select($retrieve);

            //Disconnect
            $this->disconnect();

            return $this->fetchResults();
        }

    /**
     * Encode array from latin1 to utf8 recursively
     * @param $dat
     * @return array|string
     */
       public static function convert_from_latin1_to_utf8_recursively($dat)
       {
          if (is_string($dat)) {
             return utf8_encode($dat);
          } elseif (is_array($dat)) {
             $ret = [];
             foreach ($dat as $i => $d) $ret[ $i ] = self::convert_from_latin1_to_utf8_recursively($d);

             return $ret;
          } elseif (is_object($dat)) {
             foreach ($dat as $i => $d) $dat->$i = self::convert_from_latin1_to_utf8_recursively($d);

             return $dat;
          } else {
             return $dat;
          }
       }
    }
?>