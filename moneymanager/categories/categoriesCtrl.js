'use strict';

app.controller('categoriesController', ['$scope', '$http', '$location', 'categoriesService', function ($scope, $http, $location, categoriesService) {
    
    $scope.categories = [];
    categoriesService.retrieveCategories($scope);
    
    $scope.selectedCategory = [];
    $scope.editCategory = function( cat ){
        angular.copy(cat, $scope.selectedCategory);
    }
    
    $scope.update = function(){
        var data = {id:$scope.selectedCategory.id, name:$scope.selectedCategory.name, description:$scope.selectedCategory.description, percent:$scope.selectedCategory.percent};
        categoriesService.update(data, $scope);
    }
    
    $scope.newName = "";
    $scope.newDescription = "";
    
    $scope.save = function(){
        var data = {name:$scope.newName, description:$scope.newDescription};
        categoriesService.save(data, $scope);
    }
    
    $scope.close = function( cat ){
        var data = {id:cat.id};
        categoriesService.close(data, $scope);
    }
    
    $scope.open = function( cat ){
        var data = {id:cat.id};
        categoriesService.open(data, $scope);
    }
    
    $scope.delete = function( cat ){
        var data = {id:cat.id};
        categoriesService.delete(data, $scope);
    }
    
}]);