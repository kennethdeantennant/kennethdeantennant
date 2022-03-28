<?php // This is the Journal class for the journal program
    class Journal extends Connection{

        private	$dbTable;
        private $dbTableUser;
        private $dbTableLogin;

        private	$id;
        private	$date;
        private	$entry;
        private	$category;
        private	$person;

        function __construct(){
            $this->dbTable = "Entry";
            $this->dbTableUser = "User";
            $this->dbTableLogin = "Login";
        }
        
        function getEntries($uid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "select * from $this->dbTable where uid=$uid Order By edate Desc";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
        }

        function getDates($uid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "select edate as date from $this->dbTable where uid=$uid group by edate";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();
            return $this->fetchResults();
        }

        function getSingleEntry($date, $uid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "select * from $this->dbTable where edate='$date' and uid=$uid";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
        }

        function getYears($uid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "select distinct year(edate) as year from $this->dbTable where uid=$uid order by edate";
            $resultsArray = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchArray();
        }


        function getEntriesByYear($year, $uid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "select j.*,u.firstName,u.lastName from $this->dbTable as j inner join user u on j.uid = u.id where year(edate)=$year and uid=$uid order by j.edate,j.id";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchArray();
        }
        
        function getAllEntries(){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "select * from $this->dbTable order by id";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchAll();
        }
        
        function isEntry($date, $uid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "select entry from $this->dbTable where edate='$date' and uid=$uid";
            $results = $this->hasResults($query);

            // Close connection
            $this->disconnect();
            
            return $results === true;
        }

        function delete($id, $uid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "delete from $this->dbTable where id='$id' and uid=$uid";
            $results = $this->execute($query);

            // Close connection
            $this-disconnect();

            return $results;
        }

        function update($id, $entry, $topic){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $crlf=Chr(13).Chr(10).Chr(13).Chr(10);
            $entry = str_replace($crlf,"<p></p><p></p>",$entry);
            $query = "update $this->dbTable set topic='".mysqli_escape_string($this->fetchDBLink(),$topic)."', entry='".mysqli_escape_string($this->fetchDBLink(),$entry)."' where id=$id";
            echo($query);
            exit();
            $results = $this->execute($query);

            // Close connection
            $this->disconnect();

            return $results;
        }

        function save($entry, $date, $uid, $topic){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $crlf=Chr(13).Chr(10).Chr(13).Chr(10);
            $entry = str_replace($crlf,"<p></p><p></p>",$entry);
            $query = "insert into $this->dbTable (topic, edate, entry, uid) values('".mysqli_escape_string($this->fetchDBLink(),$topic)."', '$date', '".mysqli_escape_string($this->fetchDBLink(),$entry)."', $uid)";
            $results = $this->insert($query);

            // Close connection
            $this->disconnect();

            return $results;
        }

        function saveNew( $edate, $entry, $uid ){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "insert into $this->dbTable values(0, '$edate', '".mysqli_escape_string($this->fetchDBLink(),$entry)."', $uid)";
            $results = $this->execute($query);

            // Close connection
            $this->disconnect();

            return $results;
        }
        
        function retrieveUser($uid){
            //Connect
            $this->connect();

            //Create and execute query
            $query = "select * from $this->dbTableUser u inner join $this->dbTableLogin l on u.id = l.user_id where u.id=$uid";
            $resultsArray = $this->select($query);
            
            // Close connection
            $this->disconnect();

            return $this->fetchArray();
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
            
            return $result;
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