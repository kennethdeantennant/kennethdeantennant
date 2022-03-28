'use strict';

app.factory('accountService', ['$http', '$location', '$route', function($http, $location, $route){
    return {
        retrieveUser:function(data, scope){
            var $promise=$http.post("account/retrieveUserCode.php", data)
            
            $promise.then(function( msg ){
                scope.user = msg.data[0];
            });
        },
        update:function(data, scope){
            var $promise=$http.post("account/updateUserCode.php", data)
            
            $promise.then(function( msg ){
                scope.message = "Your information has been updated!";
            });
        },
        save:function(data, scope){
            var $promise=$http.post("account/saveUserCode.php", data)
            
            $promise.then(function( msg ){
                scope.message = "You are now registered and may login!";
                
                var data = {user:msg.data};
                var $promise = $http.post("account/retrieveUserCode.php", data)
                $promise.then(function( msg ){
                    scope.user = msg.data[0];
                    console.log(msg.data[0]);
                });
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
    }
}]);