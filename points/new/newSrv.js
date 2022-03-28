'use strict';

app.factory('newService', ['$http', '$location', function($http, $location){
    return {
        setUserName:function(scope){
            var $promise=$http.post("login/retrieveUserNameCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.userFirstName = msg.data;
                }
            });
        },
        save:function(scope, data){
            var $promise=$http.post("new/saveCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.message = "Food successfully saved...";
                }
            });
        },
        delete:function(scope, data){
            var $promise=$http.post("new/deleteCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.message = "Food successfully deleted...";
                }
            });
        }
    }
}]);