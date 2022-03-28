'use strict';

app.factory('keyService', ['$http', '$location', function($http, $location){
    return {
        setUserName:function(scope){
            var $promise=$http.post("login/retrieveUserNameCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.userFirstName = msg.data;
                }
            });
        },
        retrieveIngredients:function(scope){
            var $promise=$http.post("key/retrieveIngredientsCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.ingredients = msg.data;
                }
            });
        },
        save:function(scope, data){
            var $promise=$http.post("key/saveCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.message = "Food successfully saved...";
                }
            });
        },
        delete:function(scope, data){
            var $promise=$http.post("key/deleteCode.php", data)
            
            $promise.then(function( msg ){
                console.log(msg);
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.message = "Food successfully deleted...";
                }
            });
        }
    }
}]);