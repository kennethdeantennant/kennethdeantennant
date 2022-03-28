'use strict';

app.controller('addController', ['$scope', '$location', '$http', '$routeParams', '$filter', 'addService', 'editService', function ($scope, $location, $http, $routeParams, $filter, addService, editService){
    
    $scope.categories = [];
    addService.retrieveCategories($scope); 
    
    $scope.selectedCategory = "";
    
    $scope.name = "";
    
    $scope.image = "";
    
    $scope.ingredients = [];
    
    $scope.directions = [];
    
    $scope.newIngredient = "";
    
    $scope.newDirection = "";
    
    $scope.tips = "";
    
    var selectedObject = [];
    $scope.showEditField = false;
    $scope.editObject = function( value ){
        selectedObject = value;
        $scope.newDescription = value.description;
        $scope.showEditField = true;
    }
    
    $scope.update = function(){
        var data = {detail_id: selectedObject.rdid, detail_description: $scope.newDescription};
        editService.updateDescription(data, $scope);
        selectedObject.description = $scope.newDescription;
        $scope.showEditField = false;
    }
    
    $scope.id = 0;
    
    $scope.save = function(){
        var data = {name: $scope.name, category: $scope.selectedCategory.id};
        addService.save(data, $scope);
    }
    
    $scope.saveIngredient = function( value ){
        var data = {recipe: $scope.id, ingredient: value};
        addService.addIngredient(data, $scope);
    }
    
    $scope.saveDirection = function( value ){
        var data = {recipe: $scope.id, direction: value};
        addService.addDirection(data, $scope);
        $scope.newDirection = "";
    }
    
    $scope.updateImage = function( value ){
        var data = {recipe: $scope.id, image: value};        
        addService.updateImage(data, $scope);
    }
        
    $scope.update = function( value ){
        var data = {detail_id: $scope.id, detail_description: value};
        editService.updateDescription(data, $scope);
        selectedObject.description = $scope.newDescription;
        $scope.showEditField = false;
    }
    
    $scope.delete = function(){
        if( confirm("Are you sure you want to delete?") ){
            var data = {recipe: $scope.id};
            editService.delete(data);
        }
    }

    $scope.close = function(){
        window.close();
    }
    
    $scope.deleteTips = function( value ){
        if( confirm("Are you sure you want to delete " + value + "?") ){
            var data = {recipe: $scope.selectedRecipeID};
            editService.deleteTips(data, $scope);
            $route.reload();
        }
    }
    
    $scope.saveTips = function( value ){
        var data = {recipe: $scope.selectedRecipeID, tips: value};
        addService.addTips(data, $scope);
        $scope.newTips = "";
        $scope.tips = value;
    }

}]);