'use strict';

app.factory('manageService', ['$http', '$location', function($http, $location){
    return {
        setUserName:function(scope){
            var $promise=$http.post("login/retrieveUserNameCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.status == 200 && msg.data != ""){
                    scope.userFirstName = msg.data;
                }
            });
        },
        retrieveSelectedDates:function(scope){
            var $promise=$http.post("manage/retrieveSelectedDatesCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.status == 200 && msg.data != ""){
                    var now = moment()
                    scope.selectedDates = [{date:now.format("YYYY-MM-DD")}];
                    for( var i=0; i<msg.data.length; i++){
                        var idx = scope.selectedDates.length;
                        scope.selectedDates[idx] = msg.data[i];
                    }
                }
            });
        },
        retrieveFoods:function(scope){
            var $promise=$http.post("manage/retrieveFoodsCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.status == 200 && msg.data != ""){
                    scope.foods = msg.data;
                }
            });
        },
        retrieveSelectedFoods:function(scope, data){
            var $promise=$http.post("manage/retrieveSelectedFoodsCode.php", data)
            
            $promise.then(function( msg ){
                
                if(msg.status == 200){
                    scope.selectedFoods = msg.data;
                    var total = 0.00;
                    for( var i=0; i<msg.data.length; i++ ){
                        total += parseInt( msg.data[i].points );
                    }
                    scope.total = total;
                }
            });
        },
        save:function(scope, data){
            var $promise=$http.post("manage/saveCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200 && msg.data != ""){
                    scope.message = "Item added...";
                }
            });
        },
        repeat:function(scope, data){
            var $promise=$http.post("manage/repeatCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200 && msg.data != ""){
                    scope.message = "Item repeated...";
                }
            });
        },
        remove:function(scope, data){
            var $promise=$http.post("manage/removeCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200 && msg.data != ""){
                    scope.message = "Item removed...";
                }
            });
        },
        delete:function(scope, data){
            var $promise=$http.post("manage/deleteCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200 && msg.data != ""){
                    scope.message = "Item deleted...";
                }
            });
        }
    }
}]);