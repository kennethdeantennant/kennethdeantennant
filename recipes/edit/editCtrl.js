'use strict';

app.controller('editController', ['$scope', '$location', '$http', '$routeParams', '$filter', '$route', 'editService', 'listingService', 'addService', function ($scope, $location, $http, $routeParams, $filter, $route, editService, listingService, addService){
    
    $scope.selectedRecipeID = $routeParams.id;

    $scope.selectedRecipe = [];
    var data = {id: $scope.selectedRecipeID};
    editService.retrieveRecipe(data, $scope);
    
    $scope.message = "";
    
    $scope.categories = [];
    listingService.retrieveCategories($scope);    
    
    $scope.updateName = function(){
        var data = {recipe: $scope.selectedRecipeID, name: $scope.name};
        editService.updateName(data, $scope);
    }
    
    $scope.updateImage = function(){
        var data = {recipe: $scope.selectedRecipeID, image: $scope.image};
        editService.updateImage(data, $scope);
    }
    
    $scope.delete = function(){
        if( confirm("Are you sure you want to delete?") ){
            var data = {recipe: $scope.selectedRecipeID};
            editService.delete(data);
        }
    }

    var selectedObject = [];
    $scope.showEditField = false;
    $scope.editObject = function( value ){
        selectedObject = value;
        $scope.newDescription = value.description;
        $scope.showEditField = true;
    }
    
    $scope.deleteIngredient = function( value ){
        if( confirm("Are you sure you want to delete " + value.description + "?") ){
            var data = {detail_id: value.rdid};
            editService.deleteIngredient(data, $scope);
            $route.reload();
        }
    }
    
    $scope.deleteTips = function( value ){
        if( confirm("Are you sure you want to delete " + value + "?") ){
            var data = {recipe: $scope.selectedRecipeID};
            editService.deleteTips(data, $scope);
            $route.reload();
        }
    }
    
    $scope.deleteDirection = function( value ){
        if( confirm("Are you sure you want to delete " + value.description + "?") ){
            var data = {detail_id: value.rdid};
            editService.deleteDirection(data, $scope);
            $route.reload();
        }
    }
    
    $scope.update = function(){
        var data = {detail_id: selectedObject.rdid, detail_description: $scope.newDescription};
        editService.updateDescription(data, $scope);
        selectedObject.description = $scope.newDescription;
        $scope.showEditField = false;
    }
    
    $scope.updateSelectedCategory = function( value ){
        for( var i=0; i<$scope.categories.length; i++ ){
            if( $scope.categories[i].name == value ){
                $scope.selectedCategory = $scope.categories[i];
                var data = {recipe: $scope.selectedRecipeID, category: $scope.categories[i].id};
                editService.updateCategory(data, $scope);
                $scope.selectedCategory = $scope.categories[i];
            }
        }
    }
    
    $scope.selectedCategory = "";
    $scope.setSelectedCategory = function( value ){
        for( var i=0; i<$scope.categories.length; i++ ){
            if( $scope.categories[i].name == value ){
                $scope.selectedCategory = $scope.categories[i];
            }
        }
    }
    
    $scope.saveIngredient = function( value ){
        var data = {recipe: $scope.selectedRecipeID, ingredient: value};
        addService.addIngredient(data, $scope);
    }
    
    $scope.saveDirection = function( value ){
        var data = {recipe: $scope.selectedRecipeID, direction: value};
        addService.addDirection(data, $scope);
        $scope.newDirection = "";
    }
    
    $scope.saveTips = function( value ){
        var data = {recipe: $scope.selectedRecipeID, tips: value};
        addService.addTips(data, $scope);
        $scope.newTips = "";
        $scope.tips = value;
    }
    
    $scope.close = function(){
        window.close();
    }
    
}]);