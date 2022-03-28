'use strict';

app.service('listingService', ['$http', '$location', '$routeParams', '$route', function($http, $location, $routeParams, $route){
    return {
        retrieveCategories:function(scope){
            var $promise=$http.post("listing/retrieveCategoriesCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    scope.categories = msg.data;
                    scope.selectedCategory = $routeParams.category || scope.categories[0];
                }
            });
        },
        retrieveRecipes:function(scope){
            var $promise=$http.post("listing/retrieveRecipesCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    scope.recipes = msg.data;
                    scope.selectedCategory = $routeParams.category || scope.categories[0];
                }
            });
        },
        retreieveRecipeDetails:function(scope){
            var $promise=$http.post("listing/retrieveRecipeDetailsCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    scope.details = msg.data;
                }
            });
        },
        createCategory:function(data, scope){
            var $promise=$http.post("listing/createCategoryCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    scope.details = msg.data;
                    
                    var obj = {category_date: data.category_date, id:msg.data, name: data.name} ; 
                    scope.categories.push( obj );
                    scope.message = "Category created!";
                }
            });
        },
        deleteCategory:function(data, scope){
            var $promise=$http.post("listing/deleteCategoryCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    scope.details = msg.data;
                    
                    var obj = {category_date: data.category_date, id:msg.data, name: data.name} ; 
                    scope.message = "Category deleted!";

                    for( var i=0; i<scope.categories.length; i++ ){
                        if( scope.categories[i].id == data.category_id ){
                            scope.categories.splice(i, 1);
                        }
                    }                }
            });
        },
        retrieveSingleRecipeByName:function(data, scope){
            var $promise=$http.post("listing/retrieveRecipeByNameCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    scope.searchedRecipes = msg.data;
                    scope.showSearchedItems = true;
                    console.log(msg.data);
                }
            });
        }
    }
}]);