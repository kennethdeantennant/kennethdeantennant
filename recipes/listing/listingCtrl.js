'use strict';

app.controller('listingController', ['$scope', '$location', '$http', '$routeParams', '$filter', 'listingService', 'sessionService', function ($scope, $location, $http, $routeParams, $filter, listingService, sessionService) {
    
    var today = moment();

    $scope.message = "";
    
    $scope.showSearchedItems = false;
    $scope.searchedRecipes = [];
    $scope.searchValue = "";
    $scope.search = function(){
        var data = {name: $scope.searchValue};
        listingService.retrieveSingleRecipeByName(data, $scope);
    }
        
    $scope.selectedLetter = "";
    $scope.setSelectedLetter = function( value ){
        $scope.selectedLetter = value;
        if( value.length > 0 ){
            $scope.viewHeader = true;
        }else{
            $scope.viewHeader = false;
        }
    }
    
    $scope.setSelectedCategory = function( value ){
        $scope.selectedCategory = value;
    }
    
    $scope.viewHeader = false;
    $scope.viewCategory = true;
    $scope.checkViewCategory = function( value ){
        $scope.viewCategory = $scope.selectedCategory.name == value;
    }
    
    if (typeof String.prototype.startsWith != 'function') {
      String.prototype.startsWith = function (str){
        return this.slice(0, str.length) == str;
      };
    }
    
    if (typeof String.prototype.endsWith != 'function') {
      String.prototype.endsWith = function (str){
        return this.slice(-str.length) == str;
      };
    }
    
    $scope.letters = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];

    $scope.categories = [];
    listingService.retrieveCategories($scope);    
    
    $scope.recipes = [];
    listingService.retrieveRecipes($scope);
    
    $scope.details = [];
    listingService.retreieveRecipeDetails($scope);
    
    $scope.hasRecipes = function( letter ){
        for(var i=0; i < $scope.recipes.length; i++){
            if( $scope.recipes[i].name != null && $scope.recipes[i].name.trim().startsWith(letter) ){
                return true;
            }
        }
        return false;
    }
    
    $scope.hasRecipesForCategory = function( value ){
        for(var i=0; i < $scope.recipes.length; i++){
            if( $scope.recipes[i].category_id == value ){
                return true;
            }
        }
        return false;
    }
    
    $scope.isLoggedIn = function(){
        return sessionService.get('uid') != null;
    }
    
    $scope.newCategory = "";
    $scope.showCategoryText = false;    
    $scope.addCategory = function(){
        $scope.showCategoryText = false;
        var data = {category_date: today.format("YYYY-MM-DD"), id:999, name: $scope.newCategory}
        listingService.createCategory(data, $scope);
        $scope.newCategory = "";
    }
    
    $scope.deleteCategory = function( value ){
        var data = {category_id: value}
        listingService.deleteCategory(data, $scope);        
    }
}])
.filter('startsWithAndMatch', function() {
    return function(array, letter, category) {
        var matches = [];
        if( category != null ){
            for( var i = 0; i < array.length; i++ ){
                if( array[i].name.startsWith( letter ) && array[i].category_id == category.id ){
                    matches.push(array[i]);
                }
            }
        }
        return matches;
    };
});