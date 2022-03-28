'use strict';

app.controller('loginController', ['$scope', '$http', '$location', 'adminService', function ($scope, $http, $location, adminService) {

	$scope.username = "";
	$scope.password = "";
    
    $scope.message = "";
	
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
            adminService.login(credentials, $scope);
        } else {
            $scope.message = "Missing login credentials!";
        }
    }
    
    $scope.logout = function () {
        $scope.message = "";
        adminService.logout();
    }

}]);