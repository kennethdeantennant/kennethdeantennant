'use strict';

app.factory('updateService', ['$http', '$location', '$route', '$routeParams', function($http, $location, $route, $routeParams){
    return {
        retrieveDeposits:function(scope){
            var $promise=$http.post("deposits/retrieveDepositsCode.php", null)
            
            $promise.then(function( msg ){
                scope.depositCategories = msg.data;
                
                var dates = [];
                var grossAmounts = [];
                var netAmounts = [];
                var deposits = [];
                for( var i=0; i < scope.depositCategories.length; i++ ){
                    if( dates.indexOf( scope.depositCategories[i].edate ) < 0 ){
                        dates.push( scope.depositCategories[i].edate );
                        grossAmounts.push( scope.depositCategories[i].gross );
                        netAmounts.push( scope.depositCategories[i].net );
                        
                        var data = {edate:scope.depositCategories[i].edate, gross:scope.depositCategories[i].gross, net:scope.depositCategories[i].net};
                        deposits.push(data);
                    }
                }
                
                scope.depositDates = dates;
                scope.depositDate = dates[0];
                
                var percentages = [];
                for( var i=0; i<scope.depositCategories.length; i++ ){
                    if( scope.depositCategories[i].edate == scope.depositDate ){
                        var data = {name:scope.depositCategories[i].name, percent:scope.depositCategories[i].percent, net:scope.depositCategories[i].net, edate:scope.depositCategories[i].edate, deposit:scope.id, type:scope.depositCategories[i].type_id, description:scope.depositCategories[i].description, category:scope.depositCategories[i].category_id}
                        percentages.push(data);                        
                    }
                }
                
                scope.percentages = percentages;
                scope.depositGross = scope.depositCategories[0].gross;
                scope.depositNet = scope.depositCategories[0].net;
                scope.grossAmounts = grossAmounts;
                scope.netAmounts = netAmounts;
                scope.deposits = deposits;
            });
        },retrieveDeposit:function(data, scope){
            var $promise=$http.post("deposits/retrieveDepositCode.php", data)
            
            $promise.then(function( msg ){
                scope.deposit = msg.data;
            });
        },update:function(data, scope){
            $http.post("deposits/updateCode.php", data)
        },updateGrossAmount:function(data, scope){
            var $promise = $http.post("deposits/updateGrossCode.php", data)
            $promise.then(function( msg ){
            });
        },updateNetAmount:function(data, scope){
            $http.post("deposits/updateNetCode.php", data)
        },finalize:function(data, scope){
            var $promise=$http.post("deposits/finalizeCode.php", data)
            
            $promise.then(function( msg ){
                for( var i=0; i<scope.percentages.length; i++ ){
                    if( parseFloat( parseFloat( scope.percentages[i].calculatedAmount ).toFixed(2) ) > 0 ){
                        var data = {amount:parseFloat( scope.percentages[i].calculatedAmount ).toFixed(2), type:scope.percentages[i].type};
                        $http.post("deposits/addDetailCode.php", data);
                    }
                }
                $location.path("/deposits")
            });
        }
    }
}]);