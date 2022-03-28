'use strict';

app.controller('expensesController', ['$scope', '$http', '$location', '$routeParams', 'expensesService', 'summaryService', function ($scope, $http, $location, $routeParams, expensesService, summaryService) {
    
    $scope.selectedCategory = "1";
    if( angular.isDefined( $routeParams.category ) ){
        $scope.selectedCategory = $routeParams.category;
    }
    
    $scope.categories = [];
    summaryService.retrieveCategories($scope);
    
    $scope.selectedYear = moment().format("YYYY");
    $scope.yearList = [];
    expensesService.retrieveYears($scope);
    
    var data = {category:$scope.selectedCategory};
    $scope.descriptionList = [];
    expensesService.retrieveTransactionsByDescription(data, $scope);
    
    $scope.change = function( value ){
        $scope.selectedYear = value;
    }
    
}]);