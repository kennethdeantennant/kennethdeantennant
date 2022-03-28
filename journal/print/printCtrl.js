'use strict';

app.controller('printController', ['$scope', '$http', '$location', 'printService', 'sessionService', function ($scope, $http, $location, printService, sessionService) {
    
    printService.setUserName($scope);
    
    $scope.messge = "";
    $scope.error = "";
    
    $scope.user = [];
    if( sessionService.get("uid") != null ){
        $scope.isUpdateAccount = true;
        $scope.id = sessionService.get("uid");
    
        var data = {user:sessionService.get("uid")};
        accountService.retrieveUser(data, $scope);
    }else{
        $scope.isUpdateAccount = false;
    }
    
    $scope.save = function(){
        if( angular.isDefined( $scope.user.confirmpassword ) && $scope.user.password !== $scope.user.confirmpassword ){
            $scope.error = "Password and confirmed password do not match!";
        }else{
            if( $scope.isUpdateAccount ){
                var data = {username:$scope.user.username, 
                            password:$scope.user.password,
                            firstname:$scope.user.firstName,
                            middlename:$scope.user.middleName,
                            lastname:$scope.user.lastName,
                            phone:$scope.user.phoneNumber,
                            altphone:$scope.user.altPhoneNumber,
                            email:$scope.user.email,
                            id:$scope.user.user_id};
                accountService.update(data, $scope)
            }else{
                var data = {username:$scope.user.username, 
                            password:$scope.user.password,
                            firstname:$scope.user.firstName,
                            middlename:$scope.user.middleName,
                            lastname:$scope.user.lastName,
                            phone:$scope.user.phoneNumber,
                            altPhone:$scope.user.altPhoneNumber,
                            email:$scope.user.email};
                accountService.save(data, $scope)
            }
        }
    }
    
}]);