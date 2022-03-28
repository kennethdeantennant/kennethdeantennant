'use strict';

app.factory('detailsService', ['$http', '$location', '$route', '$routeParams', function($http, $location, $route, $routeParams){
    return {
        retrieveCategory:function(data, scope){
            var $promise=$http.post("details/retrieveCategoryCode.php", data)
            
            $promise.then(function( msg ){
                scope.category.name = msg.data[0].name;
            });
        },retrieveTransactions:function(data, scope){
            var $promise=$http.post("details/retrieveTransactionsCode.php", data)
            
            $promise.then(function( msg ){
                scope.transactions = msg.data;
                var balance = 0.00;
                for( var i=scope.transactions.length-1; i > -1; i-- ){
                    // Create balance
                    if( scope.transactions[i] != null ){
                        balance = parseFloat( balance ) + parseFloat( scope.transactions[i].amount );
                        scope.transactions[i].balance = parseFloat( balance ).toFixed(2);
                    }
                }
            });
        },retrieveDescriptions:function(data, scope){
            var $promise=$http.post("details/retrieveDescriptionsCode.php", data)
            
            $promise.then(function( msg ){
                var descriptions = [];
                for( var i=0; i<msg.data.length; i++ ){
                    // Save Description
                    if( descriptions.indexOf( msg.data[i].description ) < 0 ){
                        descriptions.push( msg.data[i].description );
                    }
                }
                
                descriptions.sort();
                if( $routeParams.action == "a" ){
                    descriptions.push( "--------------------------------------------------" );
                    descriptions.push( "Add Description" );
                }
                scope.descriptions = descriptions;
            });
        },retrieveAsOfDates:function(scope){
            var $promise=$http.post("details/retrieveAsOfDatesCode.php", null)
            
            $promise.then(function( msg ){
                var asOfDates = [];
                for( var i=0; i < msg.data.length; i++ ){
                    var tranDate = new Date(msg.data[i].date);
                    var firstOfMonth = moment(tranDate.setDate(1)).format("YYYY-MM-DD");                    
                    if( asOfDates.indexOf( firstOfMonth ) < 0 ){
                        asOfDates.push( firstOfMonth );
                    }          
                }
                
                scope.asOfDates = asOfDates;
                scope.asOfDate = scope.asOfDates[1];
            });
        },deleteDetail:function(data, scope){
            var $promise=$http.post("details/deleteDetailCode.php", data)
            
            $promise.then(function(){
                for( var i=0; i < scope.transactions.length; i++ ){
                    if( scope.transactions[i].id == data.detail ){
                        scope.transactions.splice(i, 1);
                    }
                }
            });
        },save:function(data, scope){
            var $promise=$http.post("details/saveCode.php", data)
            
            $promise.then(function(){
                $route.reload();
            });
        }
    }
}]);