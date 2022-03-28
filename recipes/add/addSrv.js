'use strict';

app.service('addService', ['$http', '$location', '$routeParams', '$route', function($http, $location, $routeParams, $route){
    return {
        save:function(data, scope){
            var $promise=$http.post("add/saveCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.id = msg.data;
                }
            });
        },
        retrieveCategories:function(scope){
            var $promise=$http.post("listing/retrieveCategoriesCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.categories = msg.data;
                }
            });
        },
        addIngredient:function(data, scope){
            var $promise=$http.post("add/addIngredientCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    var obj = {type: "I", recpid_id: data.recipe, description: data.ingredient}
                    scope.ingredients.push(obj);
                    scope.newIngredient = "";
                }
            });
        },
        addDirection:function(data, scope){
            var $promise=$http.post("add/addDirectionCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    var obj = {type: "D", recpid_id: data.recipe, description: data.direction}
                    scope.directions.push(obj);
                    scope.newDirection = "";
                }
            });
        },
        addTips:function(data, scope){
            var $promise=$http.post("add/addTipsCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                }
            });
        },
        updateImage:function(data, scope){
            var $promise=$http.post("edit/updateImageCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.image = data.image;
                }
            });
        }
    }
}]);