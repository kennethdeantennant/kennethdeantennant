'use strict';

app.factory('categoriesService', ['$http', '$location', '$route', function($http, $location, $route){
    return {
        retrieveCategories:function(scope){
            var $promise=$http.post("categories/retrieveCategoriesCode.php", null)
            
            $promise.then(function( msg ){
                console.log(msg);
                scope.categories = msg.data;
            });
        },update:function(data, scope){
            var $promise=$http.post("categories/updateCategoryCode.php", data)
            
            $promise.then(function( msg ){
                $route.reload();
            });
        },save:function(data, scope){
            var $promise=$http.post("categories/saveCategoryCode.php", data)
            
            $promise.then(function( msg ){
                $route.reload();
            });
        },close:function(data, scope){
            var $promise=$http.post("categories/closeCategoryCode.php", data)
            
            $promise.then(function( msg ){
                $route.reload();
            });
        },open:function(data, scope){
            var $promise=$http.post("categories/openCategoryCode.php", data)
            
            $promise.then(function( msg ){
                $route.reload();
            });
        },delete:function(data, scope){
            var $promise=$http.post("categories/deleteCategoryCode.php", data)
            
            $promise.then(function( msg ){
                $route.reload();
            });
        }
    }
}]);