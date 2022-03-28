'use strict';

app.controller('mealsController', ['$scope', '$location', '$http', 'mealsService', function ($scope, $location, $http, mealsService) {
    
    mealsService.setUserName($scope);
    
    $scope.list = {};
    $scope.isDisabled = true;

    $scope.mealtype = "b";
    $scope.today = moment();
    
    $scope.meal = { selected: [] };
    var data = {date: $scope.today.format("YYYY-MM-DD"), category: $scope.mealtype};
    mealsService.retrieveSelectedMeals(data, $scope);
    
    $scope.allmeals = [];
    mealsService.retrieveMeals($scope);    
    
    $scope.checkMealCount = function( cattype ){
        $scope.mealcount = 0;
        if( $scope.meal.selected.length > 0 ){ // Make sure meals where selected
            for( var i=0; i<$scope.allmeals.length; i++ ){  // Loope through all meals
                var imeal = $scope.allmeals[i]
                if( imeal.category == cattype ){    // Make sure that the meal category matches the selected meal type
                    var idx = $scope.meal.selected.indexOf(imeal.id);
                    if( idx > -1 ){ // if the meal is found in the selected meals, then count it
                        $scope.mealcount += 1;
                    }
                }
            }
        }
        $scope.isDisabled = ($scope.mealcount <= 0);
    }

    $scope.reset = function(){
        for( var i = 0; i < $scope.meal.selected.length; i++ ){ 
            var data = { meal_id: $scope.meal.selected[i], category: $scope.mealtype, today: $scope.today.format("YYYY-MM-DD") };
            mealsService.uncheck(data);
        }
        $scope.meal = { selected: [] };
        $scope.isDisabled = true;
    }
    
    $scope.makeGroceryList = function(){
        $location.path("/groceries/" + $scope.today.format("YYYY-MM-DD") + "/" + $scope.mealtype);
    }
    
    $scope.getIds = function() {
        return $scope.meal.selected;
    };
    
    $scope.check = function(value, checked) {
        var idx = $scope.meal.selected.indexOf(value);
        if (idx >= 0 && !checked) {
            $scope.meal.selected.splice(idx, 1);
            var data = { meal_id: value, category: $scope.mealtype, today: $scope.today.format("YYYY-MM-DD") };
            mealsService.uncheck(data);
        }
        if (idx < 0 && checked) {
            $scope.meal.selected.push(value);
            var data = { meal_id: value, category: $scope.mealtype, today: $scope.today.format("YYYY-MM-DD") };
            mealsService.check(data);
        }
        $scope.checkMealCount( $scope.mealtype );
    };
    
    $scope.name = "";
    $scope.newMeal = false;
    
    $scope.saveMeal = function(){
        var data = { name: $scope.name, category: $scope.mealtype };
        mealsService.saveMeal(data, $scope);
    }
    
    $scope.deleteMeal= function( value ){
        if(confirm("Are you sure you want to remove "+value.name+"?")){
            var data = { meal_id: value.id, category: $scope.mealtype };
            mealsService.deleteMeal(data);
            for( var i = 0; i < $scope.allmeals.length; i++ ){ 
                if( $scope.allmeals[i].id == value.id){
                    $scope.allmeals.splice(i, 1);
                }
            }
        }
    }

    $scope.checkMealCount( $scope.mealtype );
}]);