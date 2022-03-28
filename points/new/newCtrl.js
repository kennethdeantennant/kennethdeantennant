'use strict';

app.controller('newController', ['$scope', '$http', '$location', '$routeParams', 'newService', 'sessionService', 'profileService', `manageService`, function ($scope, $http, $location, $routeParams, newService, sessionService, profileService, manageService) {
    
    $scope.today = $routeParams.today;
        
    $scope.message = "";
    
    $scope.user = sessionService.get("uid");

    $scope.profile = [];
    profileService.setProfile($scope);
    
    var now = moment();
    $scope.selectedDate = {date: now.format("YYYY-MM-DD")};
    
    profileService.setUserName($scope);
    
    $scope.selectedType = {};
    $scope.types = [{code: "M", description:"Meal"}, {code:"I", description:"Item"}];
    
    $scope.points = function(){
        var values = [0.5];
        for( var i=1; i<21; i++ ){
            var idx = values.length;
            values[idx] = i;
            values[idx+1] = i + .5;
        }
        return values;
    }

    function loadFoods(){
        $scope.foods = [];
        manageService.retrieveFoods($scope);
        $scope.newfood = [];
        $scope.$apply;
    }

    $scope.delete = function( value, name ){
        if( confirm("Are you sure you want to delete " + name) ){
            var data = {id: value};
            newService.delete($scope, data);
            loadFoods();
        }
    }
    
    loadFoods();
    
    function pointValues(){
        var values = [{point: parseFloat("0.50").toFixed(2)}];
        for( var i=1; i<20; i++ ){
            var idx = values.length;
            values[idx] = {point: parseFloat(i).toFixed(2)};
            values[idx + 1] = {point: parseFloat(i + 0.50).toFixed(2)};
        }
        $scope.pointValues = values;
    }
    
    pointValues();
    
    $scope.save = function(){
        var data = {description: $scope.newfood.description, type: $scope.newfood.type.code, point: parseFloat($scope.newfood.points.point).toFixed(2)}
        newService.save($scope, data);
        loadFoods();
    }
    
    $scope.isDisabled = true;
    $scope.check = function(){
        $scope.isDisabled = !(angular.isDefined($scope.newfood.description) && angular.isDefined($scope.newfood.type) && angular.isDefined($scope.newfood.points));
    }

}]);