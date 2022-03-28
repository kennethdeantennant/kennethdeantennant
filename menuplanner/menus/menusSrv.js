'use strict';

app.service('menusService', ['$http', '$location', '$routeParams', '$route', function($http, $location, $routeParams, $route){
    return {
        retrieveMenus:function(scope){
            var $promise=$http.post("menus/retrieveMenusCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.menus = msg.data;
                }
            });
        },
        retrieveMeals:function(scope){
            var $promise=$http.post("menus/retrieveMenuMealsCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.meals = msg.data;
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
        deleteMenu:function(data){
            $http.post("menus/deleteMenuCode.php", data)
        }
    }
}]);