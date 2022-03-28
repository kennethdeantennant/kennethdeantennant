'use strict';

app.controller('summaryController', ['$scope', '$http', '$location', 'summaryService', 'sessionService', function ($scope, $http, $location, summaryService, sessionService) {
    
    var now = moment();
    $scope.today = now.format("YYYY-MM-DD");
    
    summaryService.setUserName($scope);
    
    $scope.user = sessionService.get("uid");
    
    $scope.points = [];

    var day = moment();
    var data = {weekday:day.format('dddd, Do'), formatted: day.format('YYYY-MM-DD')}
    summaryService.retrievePointsForDay($scope, data);
        
}]);