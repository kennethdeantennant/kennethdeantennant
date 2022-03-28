'use strict';

app.service('recipesService', ['$http', '$location', '$routeParams', '$route', function($http, $location, $routeParams, $route){
    return {
        retrieveCategories:function(scope){
            var $promise=$http.post("recipes/retrieveCategoriesCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.statusCode == 200){
                    scope.categories = msg.data;
                    scope.selectedCategory = $routeParams.category || scope.categories[0];
                }
            });
        },
        retrieveRecipes:function(scope){
            var $promise=$http.post("recipes/retrieveRecipesCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.recipes = msg.data;
                    scope.selectedCategory = $routeParams.category || scope.categories[0];
                }
            });
        },
        retreieveRecipeDetails:function(scope){
            var $promise=$http.post("recipes/retrieveRecipeDetailsCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.details = msg.data;
                }
            });
        },
        createCategory:function(data, scope){
            var $promise=$http.post("recipes/createCategoryCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.details = msg.data;
                    
                    var obj = {category_date: data.category_date, id:msg.data, name: data.name} ; 
                    scope.categories.push( obj );
                    scope.message = "Category created!";
                }
            });
        },
        deleteCategory:function(data, scope){
            var $promise=$http.post("recipes/deleteCategoryCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.details = msg.data;
                    
                    var obj = {category_date: data.category_date, id:msg.data, name: data.name} ; 
                    scope.message = "Category deleted!";

                    for( var i=0; i<scope.categories.length; i++ ){
                        if( scope.categories[i].id == data.category_id ){
                            scope.categories.splice(i, 1);
                        }
                    }                }
            });
        }
    }
}]);