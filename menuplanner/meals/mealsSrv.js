'use strict';

app.service('mealsService', ['$http', '$location', '$routeParams', '$route', function($http, $location, $routeParams, $route){
    return {
        retrieveMeals:function(scope){
            var $promise=$http.post("meals/retrieveMealsCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.allmeals = msg.data;
                }
            });
        },
        retrieveSelectedMeals:function(data, scope){
            var $promise=$http.post("meals/retrieveSelectedMealsCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK"){
                    var counts = 0;
                    for(var key in msg.data){
                        scope.meal.selected.push(msg.data[key].meal_id);
                        if( msg.data[key].menu_type == data.category ){
                            counts++;
                        }
                    }
                    scope.mealcount = counts;
                    scope.isDisabled = (counts <= 0);
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
        deleteMeal:function(data){
            $http.post("meals/deleteMealCode.php", data)
        },
        saveMeal:function(data, scope){
            var $promise=$http.post("meals/saveMealCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK"){
                    var obj = {category:scope.mealtype, id:msg.data, name: scope.name};
                    scope.allmeals.push(obj);
                    scope.name = "";
                    scope.newMeal = false;
                }
            });
        },
        uncheck:function(data){
            $http.post("meals/uncheckCode.php", data);
        },
        check:function(data){
			$http.post("meals/checkCode.php", data);
        }
    }
}]);