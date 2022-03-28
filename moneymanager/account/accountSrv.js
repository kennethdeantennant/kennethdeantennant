'use strict';

app.factory('accountService', ['$http', '$location', '$route', function($http, $location, $route){
    return {
        retrieveUser:function(data, scope){
            var $promise=$http.post("account/retrieveUserCode.php", data)
            
            $promise.then(function( msg ){
                scope.user.firstName = msg.data[1];
                scope.user.middleName = msg.data[2];
                scope.user.lastName = msg.data[3];
                scope.user.phoneNumber = msg.data[4];
                scope.user.altPhoneNumber = msg.data[5];
                scope.user.email = msg.data[6];
                scope.user.deposit = msg.data[7];
                scope.user.username = msg.data[11];
                scope.user.user_id = msg.data[14];
            });
        },
        update:function(data, scope){
            var $promise=$http.post("account/updateUserCode.php", data)
            
            $promise.then(function(msg){
                scope.message = msg.data + " Your information has been updated!";
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
                });
            });
        }
    }
}]);