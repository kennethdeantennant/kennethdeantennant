'use strict';

app.factory('depositsService', ['$http', '$location', '$route', '$routeParams', function($http, $location, $route, $routeParams){
    return {
        retrieveDeposits:function(scope){
            var $promise=$http.post("deposits/retrieveDepositsCode.php", null)
            
            $promise.then(function( msg ){
                scope.depositCategories = msg.data;
                
                var dates = [];
                var grossAmounts = [];
                var netAmounts = [];
                var years = [];
                var deposits = [];
                for( var i=0; i < scope.depositCategories.length; i++ ){
                    if( dates.indexOf( scope.depositCategories[i].edate ) < 0 ){
                        dates.push( scope.depositCategories[i].edate );
                        grossAmounts.push( scope.depositCategories[i].gross );
                        netAmounts.push( scope.depositCategories[i].net );
                        var data = {edate:scope.depositCategories[i].edate, gross:scope.depositCategories[i].gross, net:scope.depositCategories[i].net};
                        deposits.push(data);
                    }
                    var year = moment(scope.depositCategories[i].edate).format("YYYY");
                    if( years.indexOf( year ) < 0 ){
                        years.push( year );
                    }
                    
                    scope.depositCategories[i].calculatedAmount = parseFloat(scope.depositCategories[i].percent) * parseFloat(scope.depositCategories[i].net);
                }
                
                scope.depositDates = dates;
                scope.depositDate = dates[0];
                scope.depositGross = scope.depositCategories[0].gross;
                scope.depositNet = scope.depositCategories[0].net;
                scope.isDepositFinalized = scope.depositCategories[0].finalized == "Y";
                scope.grossAmounts = grossAmounts;
                scope.netAmounts = netAmounts;
                scope.years = years;
                scope.year = years[0];
                scope.deposits = deposits;
            });
        },retrieveDeposit:function(data, scope){
            var $promise=$http.post("deposits/retrieveDepositCode.php", data)
            
            $promise.then(function( msg ){
                scope.deposit = msg.data;
            });
        },save:function(data, scope){
            var $promise=$http.post("deposits/saveCode.php", data)
            
            $promise.then(function( msg ){
                console.log(msg);
                $location.path("/deposits_update/" + msg.data);
            });
        },remove:function(data, scope){
            var $promise=$http.post("deposits/deleteCode.php", data)
            
            $promise.then(function( msg ){
                $route.reload();
            });
        }
    }
}]);