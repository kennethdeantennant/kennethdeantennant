'use strict';

app.factory('summaryService', ['$http', '$location', function($http, $location){
    return {
        retrieveCategories:function(scope){
            var $promise=$http.post("summary/retrieveCategorySummariesCode.php", null)
            
            $promise.then(function( msg ){
                scope.categories = msg.data;
                var total = 0;
                for( var i=0; i < scope.categories.length; i++ ){
                    total += parseFloat(scope.categories[i].amount);
                }
                scope.totalAmount = total;
            });
        }
    }
}]);