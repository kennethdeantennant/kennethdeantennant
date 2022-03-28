'use strict';

app.factory('loginService', ['$http', '$location', 'sessionService', function($http, $location, sessionService){
    return {
        login:function(data,scope){
            var $promise=$http.post("login/loginCode.php", data)
            
            $promise.then(function( msg ){
                var uid = msg.data;
                if(uid == "0"){
                    scope.message="Invalid username or password!"
                    $location.path("/");
                }else{
                    sessionService.set('uid', uid);
                    $location.path("/entries");
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
        },
        update:function(data,scope){
            var $promise=$http.post("code/updateProjectCode.php", data)
            
            $promise.then(function( msg ){
                var uid = msg.data;
                if(uid == "success"){
                    scope.updated = true;
                    $location.path("/admin/"+data.id);
                }
            });
        },
        save:function(data){
            var $promise=$http.post("code/saveProjectCode.php", data)
            
            $promise.then(function( msg ){
                var uid = msg.data;
                if(uid == "success"){
                    $location.path("/admin");
                }
            });
        },
        delete:function(data){
            var $promise=$http.post("code/deleteProjectCode.php", data)
            
            $promise.then(function( msg ){
                var uid = msg.data;
                if(uid == "success"){
                    $location.path("/admin");
                }
            });
        }
    }
}]);