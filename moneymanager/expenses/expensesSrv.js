'use strict';

app.factory('expensesService', ['$http', '$location', '$route', '$routeParams', function($http, $location, $route, $routeParams){
    return {
        retrieveTransactionsByDescription:function(data, scope){
            var $promise=$http.post("expenses/retrieveTransactionsByDescriptionCode.php", data)
            
            $promise.then(function( msg ){
                scope.descriptionList = msg.data;
            });
        },retrieveYears:function(scope){
            var $promise=$http.post("expenses/retrieveYearsCode.php", null)
            
            $promise.then(function( msg ){
                scope.yearList = msg.data;
            });
        }
    }
}]);