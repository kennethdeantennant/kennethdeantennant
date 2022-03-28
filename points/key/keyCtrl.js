'use strict';

app.controller('keyController', ['$scope', '$http', '$location', '$routeParams', '$route', 'keyService', 'sessionService', 'profileService', `manageService`, function ($scope, $http, $location, $routeParams, $route, keyService, sessionService, profileService, manageService) {
    
    $scope.today = $routeParams.today;
        
    $scope.message = "";
    
    $scope.user = sessionService.get("uid");

    $scope.profile = [];
    profileService.setProfile($scope);
    
    profileService.setUserName($scope);
    
    function loadIngredients(){
        $scope.ingredients = [];
        keyService.retrieveIngredients($scope);
        $scope.keyingredient = [];
    }

    $scope.delete = function( value, name ){
        if( confirm("Are you sure you want to delete " + name) ){
            var data = {id: value};
            keyService.delete($scope, data);
            loadIngredients();
            $route.reload();
        }
    }
    
    loadIngredients();
    
    $scope.save = function(){
        var data = {description: $scope.keyingredient.description, points: parseFloat($scope.keyingredient.points).toFixed(0)}
        keyService.save($scope, data);
        loadIngredients();
        $route.reload();
    }
    
    $scope.isDisabled = true;
    $scope.check = function(){
        $scope.isDisabled = !(angular.isDefined($scope.keyingredient.description));
    }

    $scope.tablespoon = function(value){
        return Math.round((parseFloat(value)/16)).toFixed(0);
    }

    $scope.teaspoon = function(value){
        return Math.round((parseFloat(value)/48)).toFixed(0);
    }

}]);