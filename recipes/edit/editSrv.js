'use strict';

app.service('editService', ['$http', '$location', '$routeParams', '$route', function($http, $location, $routeParams, $route){
    return {
        retrieveRecipe:function(data, scope){
            var $promise=$http.post("edit/retrieveRecipeCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    scope.selectedRecipe = msg.data;
                    scope.name = scope.selectedRecipe[0].name;
                    scope.category = scope.selectedRecipe[0].category;
                    scope.image = scope.selectedRecipe[0].image;
                    scope.tips = scope.selectedRecipe[0].tips;
                    
                    scope.ingredients = [];
                    scope.directions = [];
                    for( var i=0; i < msg.data.length; i++ ){
                        if( msg.data[i].type === 'I' ){
                            scope.ingredients.push( msg.data[i] );
                        }
                        if( msg.data[i].type === 'D' ){
                            scope.directions.push( msg.data[i] );
                        }
                    }
                }
            });
        },
        retrieveCategories:function(scope){
            var $promise=$http.post("recipes/retrieveCategoriesCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    scope.categories = msg.data;
                }
            });
        },
        updateName:function(data, scope){
            var $promise=$http.post("edit/updateNameCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    scope.message = "Name updated!";
                    scope.name = data.name;
                }
            });
        },
        updateImage:function(data, scope){
            var $promise=$http.post("edit/updateImageCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    scope.message = "Image updated!";
                    scope.image = data.image;
                }
            });
        },
        updateDescription:function(data, scope){
            var $promise=$http.post("edit/updateDescriptionCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    scope.message = "Description updated!";
                }
            });
        },
        updateCategory:function(data, scope){
            var $promise=$http.post("edit/updateCategoryCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    scope.message = "Category updated!";
                }
            });
        },
        delete:function(data){
            var $promise=$http.post("edit/deleteCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    window.close();
                }
            });
        },
        deleteIngredient:function(data, scope){
            var $promise=$http.post("edit/deleteDetailCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    for( var i=0; i<scope.ingredients.length; i++ ){
                        if( scope.ingredients[i].id == data.detail_id ){
                            scope.ingredients.splice(i, 1);
                        }
                    }
                }
            });
        },
        deleteDirection:function(data, scope){
            var $promise=$http.post("edit/deleteDetailCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    for( var i=0; i<scope.directions.length; i++ ){
                        if( scope.directions[i].id == data.detail_id ){
                            scope.directions.splice(i, 1);
                        }
                    }
                }
            });
        },
        deleteTips:function(data, scope){
            var $promise=$http.post("edit/deleteTipsCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    scope.tips = "";
                }
            });
        }
    }
}]);