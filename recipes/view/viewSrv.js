'use strict';

app.service('viewService', ['$http', '$location', '$routeParams', '$route', function($http, $location, $routeParams, $route){
    return {
        retrieveRecipe:function(data, scope){
            var $promise=$http.post("view/retrieveRecipeCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.selectedRecipe = msg.data;
                    scope.name = scope.selectedRecipe[0].name;
                    scope.category = scope.selectedRecipe[0].category;
                    scope.image = scope.selectedRecipe[0].image;
                    scope.tips = scope.selectedRecipe[0].tips;
                    
                    scope.ingredients = [];
                    scope.instructions = [];
                    for( var i=0; i < msg.data.length; i++ ){
                        if( msg.data[i].type === 'I' ){
                            scope.ingredients.push( msg.data[i] );
                        }
                        if( msg.data[i].type === 'D' ){
                            scope.instructions.push( msg.data[i] );
                        }
                    }
                }
            });
        }
    }
}]);