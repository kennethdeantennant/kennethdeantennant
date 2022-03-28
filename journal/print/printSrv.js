'use strict';

app.factory('printService', ['$http', '$location', '$route', function($http, $location, $route){
    return {
        retrieveUser:function(data, scope){
            var $promise=$http.post("account/retrieveUserCode.php", data)
            
            $promise.then(function( msg ){
                scope.user = msg.data[0];
            });
        },
        setUserName:function(scope){
            var $promise=$http.post("login/retrieveUserNameCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.userFirstName = msg.data;
                }
            });
        }
    }
}]);