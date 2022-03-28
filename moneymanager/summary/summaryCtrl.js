'use strict';

app.controller('summaryController', ['$scope', '$http', '$location', 'summaryService', 'sessionService', function ($scope, $http, $location, summaryService, sessionService) {
    
    $scope.categories = [];
    summaryService.retrieveCategories($scope);
    
    $scope.user = sessionService.get("uid");
    
    $scope.negativeValue=function(myValue){
      var num = parseFloat(myValue);

      if(num < 0){
        var css = { 'color':'red' };
        return css;
      }
    }
    
}]);