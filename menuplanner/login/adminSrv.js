'use strict';

app.factory('adminService', ['$http', '$location', 'sessionService', function($http, $location, sessionService){
    return {
        login:function(data,scope){
            var $promise=$http.post("login/loginCode.php", data)
            
            $promise.then(function( msg ){
                var uid = msg.data;
                if(uid == "0"){
                    scope.message="Invalid username/password!"
                    $location.path("/");
                }else{
                    sessionService.set('uid', uid);
                    $location.path("/meals");
                }
            });
        },
        logout:function(){
            sessionService.destroy('uid');
            $location.path("/login");
        },
        islogged:function(){
            var $checkSessionServer=$http.post('login/checkSessionCode.php');
            return $checkSessionServer;
        }
    }
}]);