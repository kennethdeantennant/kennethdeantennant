'use strict';

app.factory('loginService', ['$http', '$location', 'sessionService', function($http, $location, sessionService){
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
                    scope.isLoggedIn = true;
                    $location.path("/");
                }
            });
        },
        logout:function(){
            sessionService.destroy('uid');
            $location.path("/");
        },
        islogged:function(){
            var $checkSessionServer=$http.post('login/checkSessionCode.php');
            return $checkSessionServer;
        },
        createRecipeBook:function(scope){
            var $promise=$http.post("login/createRecipeBookCode.php", null)
            
            $promise.then(function( msg ){
                scope.bookurl = msg.data;
            });
        }
    }
}]);