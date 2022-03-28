'use strict';

app.service('entriesService', ['$http', '$location', function($http, $location){
    return {
        retrieveSingleEntry:function(data,scope){
            var $promise=$http.post("entries/retrieveSingleEntryCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.singleEntry = msg.data;
                    scope.singleEntryID = msg.data[0];
					scope.singleEntryDate = msg.data[1];
                    scope.singleTopic = msg.data[2];
                    scope.singleEntryText = msg.data[3].split("<p></p><p></p>").join("\n\n");
                }
            });
        },
        retrieveEntries:function(data,scope){
            var $promise=$http.post("entries/retrieveEntriesCode.php", data)
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty"){
                    scope.entries = msg.data;
                }
            });
        },
        saveSingleEntry:function(data, scope, autosave){
            var $promise=$http.post("entries/saveEntryCode.php", data)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK"){
                    if(!autosave){
                        scope.message = "Journal entry is saved!";
                    }
                    scope.singleEntryID = msg.data;
                }
            });
        },
        updateSingleEntry:function(data, scope, autosave){
            var $promise=$http.post("entries/updateEntryCode.php", data);
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && !autosave){
                    scope.message = "Journal entry is updated!";
                }
            });
        },
        deleteSingleEntry:function(data){
            var $promise=$http.post("entries/deleteEntryCode.php", data);
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK"){
                    $location.path("/entries");
                }
            });
        },
        doesTodayExist:function(data,scope){
            var $promise=$http.post("entries/doesTodayExistCode.php", data);
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK"){
                    scope.doesTodayExist = true;
                }
            });
        },
        setUserName:function(scope){
            var $promise=$http.post("login/retrieveUserNameCode.php", null)
            
            $promise.then(function( msg ){
                if(msg.statusText == "OK" && msg.data != "empty          "){
                    scope.userFirstName = msg.data;
                }
            });
        },        
    }
}]);