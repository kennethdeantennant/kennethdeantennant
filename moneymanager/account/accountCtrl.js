'use strict';

app.controller('accountController', ['$scope', '$http', '$location', 'accountService', 'sessionService', function ($scope, $http, $location, accountService, sessionService) {
    
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
            var data = {};
            if( $scope.isUpdateAccount ){
                data = {username:$scope.user.username, 
                            password:$scope.user.password,
                            firstname:$scope.user.firstName,
                            middlename:$scope.user.middleName,
                            lastname:$scope.user.lastName,
                            phone:$scope.user.phoneNumber,
                            altphone:$scope.user.altPhoneNumber,
                            email:$scope.user.email,
                            id:$scope.user.user_id,
                            deposit: $scope.user.deposit};
                accountService.update(data, $scope);
            }else{
                data = {username:$scope.user.username, 
                            password:$scope.user.password,
                            firstname:$scope.user.firstName,
                            middlename:$scope.user.middleName,
                            lastname:$scope.user.lastName,
                            phone:$scope.user.phoneNumber,
                            altPhone:$scope.user.altPhoneNumber,
                            email:$scope.user.email,
                            deposit: $scope.user.deposit};
                accountService.save(data, $scope);
            }
        }
    }
    
}]);