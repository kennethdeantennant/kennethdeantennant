'use strict';

app.service('printService', ['$http', '$location', '$routeParams', '$route', function($http, $location, $routeParams, $route){
    return {
        retrieveMeals:function(data, scope){
            var $promise=$http.post("print/retrieveMealsCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.meals = msg.data;
                }
            });
        },
        retreiveNeededIngredients:function(data, scope){
            var $promise=$http.post("print/retrieveNeededIngredientsCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.ingredients = msg.data;
                }
            });
        }
    }
}]);