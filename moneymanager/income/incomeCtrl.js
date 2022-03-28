'use strict';

app.controller('incomeController', ['$scope', '$http', '$location', 'incomeService', 'sessionService', function ($scope, $http, $location, incomeService, sessionService) {
    
    $scope.incomes = [];
    incomeService.retrieveIncomes($scope);
    
}]);