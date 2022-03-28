<?php
    class Menu extends Connection{
        private $dbTable = "Menu";
        private $dbTableMeal = "Meal";
        private $dbTableIngredient = "Ingredient";
        private $dbTableMealIngredient = "MealIngredient";
        private $dbTableUser = "User";
        private $dbTableLogin = "Login";

        private $connection;

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

        function delete($uid, $date, $type){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "delete from $this->dbTable where user_id=$uid and menu_date='$date' and menu_type='$type'";
            $this->execute($query);
            
            //Disconnect
            $this->disconnect();

            return true;
        }

        function save($id, $today, $uid, $category){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "insert into $this->dbTable (meal_id, menu_date, user_id, menu_type) Values ($id, '$today', $uid, '$category')";
            $this->execute($query);

            //Disconnect
            $this->disconnect();

            // Load the information from the table
            return true;
        }

        function retrieveMenus($uid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "select menu_date, menu_type, count(meal.id) meals from $this->dbTable menu inner join $this->dbTableMeal meal on menu.meal_id = meal.id where user_id=$uid group by menu_date, menu_type order by menu_date desc, menu_type";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
        }
        
        function retrieveMenuMeals($uid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "select menu_date as mdate, menu_type as category, meal.name from $this->dbTable menu inner join $this->dbTableMeal meal on menu.meal_id = meal.id where user_id=$uid order by menu_date, menu_type";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
        }

        function retrieveMeals($date, $uid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "select * from $this->dbTable menu inner join $this->dbTableMeal meal on menu.meal_id = meal.id where menu.menu_date='$date' and menu.user_id=$uid order by menu.id";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
        }

        function retrieveSelectedMeals($date, $uid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "select * from $this->dbTable menu inner join $this->dbTableMeal meal on menu.meal_id = meal.id where menu.menu_date='$date' and menu.user_id=$uid order by meal.name";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
        }

        function retrieveAllMeals(){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "select * from $this->dbTableMeal order by name";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
        }
		
        function retrieveNeededIngredients( $uid, $date ){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "select i.name, i.category, sum(mi.quantity) as total from $this->dbTableIngredient i inner join $this->dbTableMealIngredient mi on i.id=mi.ingredient_id inner join $this->dbTableMeal m on mi.meal_id = m.id inner join $this->dbTable me on m.id = me.meal_id where me.menu_date = '$date' and me.user_id = $uid group by i.name, i.category order by i.category, i.name";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
        }
        
        function retrieveMealsByDate($uid,$date){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "select * from $this->dbTable menu inner join $this->dbTableMeal meal on menu.meal_id=meal.id where menu.user_id=$uid and menu.menu_date='$date' order by meal.name";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
        }

        function retrieveSelectedMealIngredients($date, $uid){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "select meal.id as mealid, meal.name as meal, ingredient.name as ingredient, ingredient.category as category, ingredient.id as ingredientId, mealingredient.quantity as quantity, mealingredient.id as mealingredientid from $this->dbTable menu inner join $this->dbTableMeal meal on menu.meal_id = meal.id left outer join $this->dbTableMealIngredient mealingredient on mealingredient.meal_id  = meal.id left outer join $this->dbTableIngredient ingredient on mealingredient.ingredient_id = ingredient.id where menu.menu_date='$date' and menu.user_id=$uid order by meal.name, ingredient.name";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
        }
        
        function retrieveCategories(){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "select distinct category as name from $this->dbTableIngredient";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
        }
        
        function saveMealIngredient($mealId, $ingredientId, $userId){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "insert into $this->dbTableMealIngredient (meal_id,ingredient_id,user_id) VALUES($mealId,$ingredientId,$userId)";
            $this->execute($query);

            //Disconnect
            $this->disconnect();

            // Load the information from the table
            return true;
        }

        function saveIngredient($name){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "insert into $this->dbTableIngredient (name, category) VALUES('$name', 'none')";
            $this->execute($query);
            $id = mysql_insert_id();

            //Disconnect
            $this->disconnect();

            // Load the information from the table
            return $id;
        }

        function removeMealIngredient($ingredientId){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "delete from $this->dbTableMealIngredient where id = $ingredientId";
            echo($query);
            $this->execute($query);

            //Disconnect
            $this->disconnect();

            // Load the information from the table
            return true;
        }

        function updateCategoryForIngredient($ingredientId, $name){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "update $this->dbTableIngredient set category = '$name' where id = $ingredientId";
            $this->execute($query);

            //Disconnect
            $this->disconnect();

            // Load the information from the table
            return true;
        }

        function updateQuantityForIngredient($mealingredientId, $uid, $quantity){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "update $this->dbTableMealIngredient set quantity = $quantity where id = $mealingredientId and user_id=$uid";
            echo($query);
            $this->execute($query);

            //Disconnect
            $this->disconnect();

            // Load the information from the table
            return true;
        }
        
        function uncheck($menuDate, $mealId, $userId, $menuType){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "delete from $this->dbTable where menu_date='$menuDate' and meal_id=$mealId and user_id=$userId and menu_type='$menuType'";
            $this->execute($query);
            
            //Disconnect
            $this->disconnect();

            return true;
        }
        
        function check($menuDate, $mealId, $userId, $menuType){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "insert into $this->dbTable (meal_id, menu_date, user_id, menu_type) Values ($mealId, '$menuDate', $userId, '$menuType')";
            $this->execute($query);

            //Disconnect
            $this->disconnect();

            // Load the information from the table
            return true;
        }

        function retrieveIngredents(){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "select * from $this->dbTableIngredient order by name";
            $results = $this->select($query);

            // Close connection
            $this->disconnect();

            return $this->fetchResults();
        }

        function deleteMeal($id, $category){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "delete from $this->dbTableMeal WHERE id=$id and category='$category'";
            $this->execute($query);
            
            //Disconnect
            $this->disconnect();

            return true;
        }

        function saveMeal($meal, $category){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "insert into $this->dbTableMeal (name,category) values('$meal','$category')";
            $this->execute($query);
            $id = mysql_insert_id();
            
            //Disconnect
            $this->disconnect();

            return $id;
        }

        function updateMeal($id, $value){
            //Connect
            $this->connect();
            
            // Create and execute SQL
            $query = "update $this->dbTableMeal set name='$value' where id=$id";
            $this->execute($query);
            
            //Disconnect
            $this->disconnect();

            return true;
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
        
    }
?>