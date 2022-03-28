<?php
	class Recipe extends Connection{
        
        private $dbTable = "Recipe";
		private $dbTableDetail = "RecipeDetail";
        private $dbTableCategory = "RecipeCategory";
			
		private $id;
		private $name;
		private $category_id;
		private $user_id;
		private $recipe_date;
		private $image;
		private $tips;
		private $source;

		function getId(){
			return $this->id;
		}
			
		function getName(){
			return $this->name;
		}
			
        function getCategoryId(){
			return $this->category_id;
		}
			
		function getUserId(){
			return $this->user_id;
		}
			
		function getDate(){
			return $this->recipe_date;
		}
		
		function getImage(){
			return $this->image;
		}
			
		function getSource(){
			return $this->source;
		}
			
		function getTips(){
			return $this->tips;
		}
		
		function load($rid){
            if($rid == null) return false;

            //Connect
            $this->connect();
            
            // Create and execute SQL
			$query = "select * from $this->dbTable where id=$rid";
            $result = $this->select($query);

            if($result){  //Do logic if successful
                $this->id = $this->fetch("id");
                $this->name = $this->fetch("name");
                $this->category_id = $this->fetch("category_id");
                $this->user_id = $this->fetch("user_id");
                $this->recipe_date = $this->fetch("recipe_date");
                $this->image = $this->fetch("image");
                $this->source = $this->fetch("source");
                $this->tips = $this->fetch("tips");
            }
            
            //Disconnect
            $this->disconnect();

			return true;
		}
		
		function addImage($uid, $url, $rid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$date = date("Y-m-d");
			$query = "update $this->dbTable set image='$url', user_id=$uid, recipe_date='$date' where id=$rid";
            $results = $this->execute($query);

            // Close connection
            $this->disconnect();

            return true;
		}
		
		function addSource($uid, $src, $rid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$date = date("Y-m-d");
			$query = "update $this->dbTable set source='$src', user_id=$uid, recipe_date='$date' where id=$rid";
            $results = $this->execute($query);

            // Close connection
            $this->disconnect();

            return true;
		}
		
		function retrieveRecipeIDs(){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "select id from $this->dbTable";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
		}
		
		function retrieveRecipesByCategoryLetter($cid, $letter){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            if(isset($letter) && $letter != ""){
                $query = "select * from $this->dbTable where category_id=$cid and name like '$letter%' order by name";
            }else{
                $query = "select * from $this->dbTable where category_id=$cid order by name";
            }
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
		}
		
		function retrieveRecipesByCategory($cid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$query = "select * from $this->dbTable where category_id=$cid order by name";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
		}
        
        function retrieveRecipesByName( $name ){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$query = "select * from $this->dbTable where name like '$name%' order by category_id, name";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
        }
			
		function retrieveCounts($letter, $cid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$query = "select * from $this->dbTable where name like '$letter%' and category_id=$cid";
			$results = $this->select($query);

            // Close connection
            $this->disconnect();
			
            if( $results == null ){
                return 0;
            }
			
			return mysql_num_rows($this->fetchResults);
		}
		
		function retrieveCountsForCategory($cid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$query = "select * from $this->dbTable where category_id=$cid";
			$results = $this->select($query);

            // Close connection
            $this->disconnect();
            
            if( $results == null ){
                return 0;
            }
			
			return mysql_num_rows($this->fetchResults);
		}
		
		function deleteImage($id){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$query = "update $this->dbTable set image=null where id=$id";
            $results = $this->execute($query);

            // Close connection
            $this->disconnect();

            return true;
		}
        
		function deleteSource($id){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$query = "update $this->dbTable set source=null where id=$id";
            $results = $this->execute($query);

            // Close connection
            $this->disconnect();

            return true;
		}
        
		function retrieveRecipes(){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$query = "select * from $this->dbTable order by name";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
		}

        function retrieveCategories(){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$query = "select * from $this->dbTableCategory order by name";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
        }
		
        function retrieveRecipeDetails(){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$query = "select * from $this->dbTableDetail order by recipe_id, type desc, id";
            $results = $this->select($query);
            
            // Close connection
            $this->disconnect();

            return $this->fetchResults();
        }
		
        function retrieveRecipeDetailsByID( $id, $type ){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$query = "select * from $this->dbTableDetail where recipe_id=$id and type='$type' order by recipe_id, type desc, id";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
        }
		
        function retrieveRecipe( $id ){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$query = "select r.id as rid, r.name as name, r.image as image, r.source as source, r.tips as tips, rd.id as rdid, rd.type as type, rd.description as description, rc.name as category from $this->dbTable r inner join $this->dbTableDetail rd on r.id=rd.recipe_id inner join $this->dbTableCategory rc on r.category_id=rc.id where r.id=$id order by rd.id";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
        }
		
        function retrieveRecipeByName( $name ){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$query = "select r.id as rid, r.name as name, r.image as image, r.source as source, r.tips as tips, rd.id as rdid, rd.type as type, rd.description as description, rc.name as category from $this->dbTable r inner join $this->dbTableDetail rd on r.id=rd.recipe_id inner join $this->dbTableCategory rc on r.category_id=rc.id where lower(r.name) like '%".strtolower($name)."%' order by rd.id";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $results;
        }
		
		function updateName($uid, $name, $rid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$date = date("Y-m-d");
			$query = "update $this->dbTable set name='$name', user_id=$uid, recipe_date='$date' where id=$rid";
            $results = $this->execute($query);

            // Close connection
            $this->disconnect();

            return true;
		}
		
		function updateImage($uid, $image, $rid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$date = date("Y-m-d");
			$query = "update $this->dbTable set image='$image', user_id=$uid, recipe_date='$date' where id=$rid";
            $results = $this->execute($query);

            // Close connection
            $this->disconnect();

            return true;
		}
		
		function updateDescription($uid, $description, $id){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$date = date("Y-m-d");
            $time = date("hh:mm:ss");
			$query = "update $this->dbTableDetail set description='$description', user_id=$uid, detail_date='$date', detail_time='$time' where id=$id";
            $results = $this->execute($query);

            // Close connection
            $this->disconnect();

            return true;
		}
		
		function delete($id){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$query = "delete from $this->dbTable where id=$id";
            $results = $this->execute($query);
            
            $query = "delete from $this->dbTableDetail where recipe_id=$id";
            $results = $this->execute($query);

            // Close connection
            $this->disconnect();

            return true;
		}
        
		function saveCategory($name, $uid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$date = date("Y-m-d");
			$query = "insert into $this->dbTableCategory (name, user_id, category_date) values('$name', $uid, '$date')";
            $results = $this->execute($query);
            $id = mysql_insert_id();

            // Close connection
            $this->disconnect();

            return $id;
		}
		
		function deleteCategory($id){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$query = "delete from $this->dbTableCategory where id=$id";
            $results = $this->execute($query);

            // Close connection
            $this->disconnect();

            return true;
		}
        
		function updateCategory($uid, $cat, $rid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$date = date("Y-m-d");
			$query = "update $this->dbTable set category_id=$cat, user_id=$uid, recipe_date='$date' where id=$rid";
            $results = $this->execute($query);

            // Close connection
            $this->disconnect();

            return true;
		}
		
		function save($uid, $cid, $name){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$date = date("Y-m-d");
            $cleanName = mysql_real_escape_string($name);
			$query = "insert into $this->dbTable (name, category_id, user_id, recipe_date, image) values('$cleanName', $cid, $uid, '$date', 'unavailable.gif')";
            $results = $this->execute($query);
            $id = mysql_insert_id();

            // Close connection
            $this->disconnect();

            return $id;
		}
        
		function addDetail($type, $description, $rid, $uid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$date = date("Y-m-d");
            $time = date("hh:mm:ss");
			$query = "insert into $this->dbTableDetail (type, description, recipe_id, user_id, detail_date, detail_time) values('$type', '$description', $rid, $uid, '$date', '$time')";
            $results = $this->execute($query);
            $id = mysql_insert_id();

            // Close connection
            $this->disconnect();

            return $id;
		}
        
		function addTips($uid, $rid, $tips){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$correctedTips = mysql_real_escape_string($tips);
			$date = date("Y-m-d");
			$query = "update $this->dbTable set tips='$correctedTips', user_id=$uid, recipe_date='$date' where id=$rid";
            $results = $this->execute($query);

            // Close connection
            $this->disconnect();

            return true;
		}
        
        function deleteDetail($id){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$query = "delete from $this->dbTableDetail where id=$id";
            $results = $this->execute($query);

            // Close connection
            $this->disconnect();

            return true;
		}        

        function deleteTips($uid, $rid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
			$date = date("Y-m-d");
			$query = "update $this->dbTable set tips=null, user_id=$uid, recipe_date='$date' where id=$rid";
            $results - $this->execute($query);

            // Close connection
            $this->disconnect();

            return true;
		}        
		
	}
?>