<?php // This is the user class for System Tech Software
    class Connection{

        private	$dbHost = "localhost";
        private	$dbUser = "kentenna_kt";
        private	$dbName = "kentenna_points";
        private	$dbPass = "KDT7721_dbpw!";
        private $dbLink;
        private $resultsArray;
        private $results;

        // Connection functions
        function connect(){
            $this->dbLink = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
            if( mysqli_connect_error() ){
              die("Could not connect to database. " . mysqli_error($this->dbLink));  
            }
        }
        
        function disconnect(){
            if($this->dbLink != null){
                mysqli_close ($this->dbLink);
            }
        }

        // Query functions
        function select($sql){ // Single select
            $results = $this->executeSQL($sql);
            if(mysqli_num_rows($results)>0){
                $this->results = $results;
                return true;
            }
            return false;
        }
        
        function hasResults($sql){ // Return boolean if results exist
            return mysqli_num_rows($this->executeSQL($sql))>0;
        }

        function execute($sql){ // Update, delete
            return $this->executeSQL($sql);
        }
        
        function insert($sql){ // Insert
            $results = mysqli_query($this->dbLink, $sql);
            return mysqli_insert_id($this->dbLink);
        }
        
        function fetch($field){ // Return single field
            if( $this->resultsArray == null ){
                $this->resultsArray=mysqli_fetch_array($this->results);    
            }
            return $this->resultsArray[$field];
        }

        function fetchAll(){  // Return all fields
            return mysqli_fetch_all($this->results);
        }
        
        function fetchArray(){  // Return all fields
            return $this->resultsArray;
        }
        
        function fetchResults(){
            return $this->results;
        }
        
        function fetchDBLink(){
            return $this->dbLink;
        }
        
        // Json functions
        function json_e(){
            if(count($this->resultsArray) <= 0){
                return "empty";
            }
            return json_encode($this->resultsArray);
        }

        function json_d($payload){
            return json_decode($payload);
        }
        
        // Private functions
        private function executeSQL($sql){
            $results = mysqli_query($this->dbLink, $sql);
            if( $results === false ){
                echo("Query failed: " . mysqli_error($this->dbLink));
            }
            return $results;
        }        
    }
?>