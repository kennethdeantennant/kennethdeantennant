'use strict';

app.controller('profileController', ['$scope', '$http', '$location', 'profileService', 'sessionService', function ($scope, $http, $location, profileService, sessionService) {
    
    $scope.message = "";
    
    var now = moment();
    $scope.today = now.format("YYYY-MM-DD");

    profileService.setUserName($scope);

    $scope.genders = [];
    var data = {type:'g'};
    profileService.retrieveGenders($scope, data);
    
    $scope.ages = [];
    var data = {type:'a'};
    profileService.retrieveAges($scope, data);
    
    $scope.heights = [];
    var data = {type:'h'};
    profileService.retrieveHeights($scope, data);
    
    $scope.activities = [];
    var data = {type:'l'};
    profileService.retrieveActivities($scope, data);
    
    $scope.modes = [];
    var data = {type:'m'};
    profileService.retrieveModes($scope, data);
    
    function setProfile(){
        $scope.profile = [];
        profileService.setProfile($scope);
    }
    
    $scope.user = sessionService.get("uid");
    
    function getNumber( value ){
        var idx = value.indexOf("(")+1;
        var number = value.substr(idx);
        idx = number.indexOf(" ");
        number = number.substr(0, idx);
        return number;
    }
    
    $scope.update = function( name ){
        var value = "";
        switch( name ){
            case "gender":
                value = $scope.profile.selected.gender.id;
                break;
            case "age":
                value = $scope.profile.selected.age.id;
                break;
            case "height":
                value = $scope.profile.selected.height.id;
                break;
            case "activity":
                value = $scope.profile.selected.activity.id;
                break;
            case "weight":
                value = $scope.profile.selected.weight;
                break
            case "mode":
                value = $scope.profile.selected.mode.id;
                break;
        }
        
        var data = {profile:$scope.profile.id, name: name, value: value};
        profileService.update($scope, data);

        setTimeout(() => {
            $scope.profile = [];
            profileService.setProfile($scope);    
        }, 125);
    }
    
    $scope.profile = [];
    profileService.setProfile($scope);    
}]);