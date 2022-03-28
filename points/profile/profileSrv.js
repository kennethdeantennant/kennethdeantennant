'use strict';

app.factory('profileService', ['$http', '$location', function($http, $location){
    return {
        setUserName:function(scope){
            var $promise=$http.post("login/retrieveUserNameCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    scope.userFirstName = msg.data;
                }
            });
        },
        setProfile:function(scope){
            var $promise=$http.post("profile/retrieveProfileCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.status == 200 && msg.data != ""){
                    var results = msg.data[0];
                    scope.profile = results;
                    scope.profile.selected = [];
                    scope.profile.selected.gender = {id:results.gender};
                    scope.profile.selected.age = {id:results.age};
                    scope.profile.selected.height = {id:results.height};
                    scope.profile.selected.activity = {id:results.activity};
                    scope.profile.selected.weight = parseFloat(results.weight);
                    scope.profile.selected.points = parseInt(results.weight.substring(0, 2));
                    scope.profile.selected.mode = {id:results.mode};
                    
                    var $promise2=$http.post("profile/retrievePointsCode.php", results)
                    $promise2.then(function( msg ){
                        if(msg.status == 200){
                            scope.profile.selected.points = parseFloat(scope.profile.selected.points) + parseFloat(msg.data);
                        }
                    });
                }
            });
        },
        retrieveGenders:function(scope, data){
            var $promise=$http.post("profile/retrieveFactorsCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    scope.genders = msg.data;
                }
            });
        },
        retrieveAges:function(scope, data){
            var $promise=$http.post("profile/retrieveFactorsCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    scope.ages = msg.data;
                }
            });
        },
        retrieveHeights:function(scope, data){
            var $promise=$http.post("profile/retrieveFactorsCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    scope.heights = msg.data;
                }
            });
        },
        retrieveActivities:function(scope, data){
            var $promise=$http.post("profile/retrieveFactorsCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    scope.activities = msg.data;
                }
            });
        },
        retrieveModes:function(scope, data){
            var $promise=$http.post("profile/retrieveFactorsCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    scope.modes = msg.data;
                }
            });
        },
        update:function(scope, data){
            var $promise=$http.post("profile/updateCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.status == 200){
                    var name = data.name.charAt(0).toUpperCase() + data.name.slice(1);
                    scope.message = name + " updated successfully...";
                }
            });
        }
    }
}]);