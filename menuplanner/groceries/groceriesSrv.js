'use strict';

app.service('groceryService', ['$http', '$location', '$routeParams', '$filter', '$route', function($http, $location, $routeParams, $filter, $route){
    return {
        updateQuantity:function( data, scope ){
            $http.post("groceries/updateQuantityCode.php", data)
        },
        updateCategory:function( data, scope ){
            $http.post("groceries/updateCategoryCode.php", data)
        },
        retrieveIngredients:function( scope ){
            var $promise=$http.post("groceries/retrieveIngredientsCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.ingredientObjects = msg.data;
                    var values = [];
                    for( var i = 0; i < msg.data.length; i++ ){
                        values.push(msg.data[i].name);
                    }
                    scope.ingredients = values.sort();
					scope.ingredients.push("--------- ADD INGREDIENT ---------");
                }
            });
        },
        retrieveCategories:function( scope ){
            var $promise=$http.post("groceries/retrieveCategoriesCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    var values = [];
                    for( var i = 0; i < msg.data.length; i++ ){
                        values.push(msg.data[i].name);
                    }
					scope.categories = values.sort();
					scope.categories.push("--------- ADD CATEGORY ---------");
                }
            });
        },
        retrieveSelectedMeals:function( data, scope ){
            var $promise=$http.post("groceries/retrieveSelectedMealsCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.selectedMeals = msg.data;
                    var counts =0;
                    for(var key in msg.data){
                        if( msg.data[key].menu_type == data.category ){
                            counts++;
                        }
                    }

                    scope.mealcount = counts;
                }
            });
        },
        retrieveSelectedMealIngredients:function( data, scope ){
            var $promise=$http.post("groceries/retrieveSelectedMealIngredientsCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.selectedMealIngredients = msg.data;
                }
            });
        },
        setUserName:function(scope){
            var $promise=$http.post("login/retrieveUserNameCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.userFirstName = msg.data;
                }
            });
        },
        save:function( data ){
            var $promise=$http.post("groceries/saveCode.php", data);
            
            $promise.then(function( msg ){
                $route.reload();
            });
        },
        saveIngredient:function( data, scope ){
		 	var $promise=$http.post("groceries/saveIngredientCode.php", data);
            $promise.then(function( msg ){
				var obj = {mealid: data.mealid, ingredient: data.name, category: 'none', ingredientId:msg.data, quantity:"1" };
				$http.post("groceries/saveCode.php", obj).success(function(msg){
					$route.reload();
				});
			});
        },
        remove:function( data ){
            $http.post("groceries/removeCode.php", data)
        }
    }
}]);