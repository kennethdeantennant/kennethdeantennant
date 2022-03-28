'use strict';

app.controller('printController', ['$scope', '$location', '$routeParams', 'printService', function ($scope, $location, $routeParams, printService) {
    
    $scope.today = moment();
    
    $scope.meals = [];
    var data = {today: $routeParams.today};
    printService.retrieveMeals(data, $scope);
    
    $scope.ingredients = [];
    var data = {today: $routeParams.today};
    printService.retreiveNeededIngredients(data, $scope);
    
    $scope.currentName = "";
    $scope.setCurrentName = function(value){
        $scope.currentName = value;
    }
    
    $scope.print = function(){
        window.print();
        if( $scope.today.format("YYYY-MM-DD") == $routeParams.today ){
            $location.path("/groceries/" + $routeParams.today + "/" + $routeParams.category);
        }else{
            $location.path("/menus/" + $routeParams.category);
        }
    }
	
	$scope.hasMeals = function( value ){
		for( var i = 0; i < $scope.meals.length; i++ ){
			if( $scope.meals[i].category == value ){
				return true;
			}
		}
		return false;
	}
    
}]);