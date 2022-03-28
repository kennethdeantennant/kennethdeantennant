'use strict';

app.factory('summaryService', ['$http', '$location', function($http, $location){
    return {
        retrievePointsForDay:function(scope, data){
            var $promise=$http.post("summary/retrievePointsCode.php", data)
            
            $promise.then(function( msg ){
                scope.categories = msg.data;
                var idx = scope.points.length;
                scope.points[idx] = {date: data.weekday, points:msg.data, formatted: data.formatted};
                
                var $promise=$http.post("summary/retrievePointsForDayCode.php", data)
                $promise.then(function( msg ){
                    scope.points[idx].foods = msg.data;
                });                
            });
        },
        setUserName:function(scope){
            var $promise=$http.post("login/retrieveUserNameCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.userFirstName = msg.data;
                }
            });
        }
    }
}]);