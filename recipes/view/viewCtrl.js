'use strict';

app.controller('viewController', ['$scope', '$location', '$http', '$routeParams', '$filter', 'viewService', function ($scope, $location, $http, $routeParams, $filter, viewService) {
    
    $scope.selectedRecipeID = $routeParams.id;
    $scope.selectedRecipe = [];
    var data = {id: $scope.selectedRecipeID};
    viewService.retrieveRecipe(data, $scope);
        
}]);