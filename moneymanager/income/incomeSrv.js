'use strict';

app.factory('incomeService', ['$http', '$location', function($http, $location){
    return {
        retrieveIncomes:function(scope){
            var $promise=$http.post("income/retrieveIncomeCode.php", null)
            
            $promise.then(function( msg ){
                scope.incomes = msg.data;
            });
        }
    }
}]);