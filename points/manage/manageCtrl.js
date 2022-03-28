'use strict';

app.controller('manageController', ['$scope', '$http', '$location', '$routeParams', '$route', 'manageService', 'sessionService', 'profileService', function ($scope, $http, $location, $routeParams, $route, manageService, sessionService, profileService) {
    
    $scope.today = $routeParams.today;
    
    $scope.message = "";
    
    $scope.profile = [];
    profileService.setProfile($scope);
    
    var now = moment();
    $scope.selectedDate = {date: now.format("YYYY-MM-DD")};
    
    function loadSelectedFoods(){
        var data = {day: $scope.selectedDate.date};
        manageService.retrieveSelectedFoods($scope, data);
    }
    
    $scope.selectedDates = [];
    manageService.retrieveSelectedDates($scope);
    
    manageService.setUserName($scope);
    
    $scope.user = sessionService.get("uid");
    
    $scope.foods = [];
    manageService.retrieveFoods($scope);
    
    $scope.selectedFoods = [];
    loadSelectedFoods();

    $scope.selected = function(value){
        $scope.selectedDate = value;
        loadSelectedFoods();
    }
    
    $scope.selectedFood = [];
    $scope.add = function(){
        var data = {id: $scope.selectedFood.id, day: $scope.selectedDate.date};
        manageService.save($scope, data);
        setTimeout(() => {
            var dateData = {day: $scope.selectedDate.date};
            manageService.retrieveSelectedFoods($scope, dateData);
            $scope.selectedFood = "";
        }, 125);
    }
    
    $scope.repeat = function( value ){
        var data = {id: value};
        manageService.repeat($scope, data);
        setTimeout(() => {
            var dateData = {day: $scope.selectedDate.date};
            manageService.retrieveSelectedFoods($scope, dateData);
        }, 125);
    }
    
    $scope.remove = function( value ){
        var data = {id: value};
        manageService.remove($scope, data);
        setTimeout(() => {
            var dateData = {day: $scope.selectedDate.date};
            manageService.retrieveSelectedFoods($scope, dateData);
        }, 125);
    }
    
    $scope.delete = function( value ){
        var data = {id: value};
        manageService.delete($scope, data);
        setTimeout(() => {
            var dateData = {day: $scope.selectedDate.date};
            manageService.retrieveSelectedFoods($scope, dateData);
        }, 125);
    }
    
}]);