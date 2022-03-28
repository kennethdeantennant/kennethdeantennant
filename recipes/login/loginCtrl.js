'use strict';

app.controller('loginController', ['$scope', '$http', '$location', '$routeParams', '$route', 'loginService', 'sessionService', function ($scope, $http, $location, $routeParams, $route, loginService, sessionService) {
    
    $scope.refresh = function(){
        $route.reload();
    }
    
    $scope.onRecipe = function(){
        var value = $routeParams.id || 0;
        return value == 0 ? false : true;
    }
    
    $scope.username = "";
	$scope.password = "";
    
    $scope.message = "";
	
    $scope.isLoggedIn = false;//sessionService.get('uid') != null;
    
    $scope.login = function () {
        $scope.message = "";
        var error = 0;
        if ($scope.username == "" || $scope.username == null) {
            error = 1;
        }
        if ($scope.password == "" || $scope.password == null) {
            error = 2;
        }
        if (error == 0) {
            var credentials = {username: $scope.username, password: $scope.password};
            loginService.login(credentials, $scope);
        } else {
            $scope.message = "Missing login credentials!";
        }
    }
    
    $scope.logout = function () {
        $scope.message = "";
        loginService.logout();
        $scope.isLoggedIn = false;
    }
    
    $scope.print = function(){
        window.print();
    }
    
    $scope.bookurl = "";
    $scope.create = function(){
        loginService.createRecipeBook($scope);
    }
}]);