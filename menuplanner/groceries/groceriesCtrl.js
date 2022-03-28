'use strict';

app.controller('groceriesController', ['$scope', '$routeParams', '$location', '$filter', '$route', 'groceryService', function ($scope, $routeParams, $location, $filter, $route, groceryService) {
    
    groceryService.setUserName($scope);
    
    $scope.today = $routeParams.today;
    $scope.mealtype = $routeParams.category;
    
    $scope.selectedMeals = [];
    var data = {date: $routeParams.today, category: $scope.mealtype};
    groceryService.retrieveSelectedMeals(data, $scope);

    $scope.selectedMealIngredients = [];
    var data = {date: $routeParams.today, category: $scope.mealtype};
    groceryService.retrieveSelectedMealIngredients(data, $scope);

    $scope.ingredients = [];
    groceryService.retrieveIngredients($scope);
    
    $scope.categories = [];
    groceryService.retrieveCategories($scope);

    $scope.quantities = ["1","2","3","4","5","6","7","8","9","10"];    
    $scope.selectedQuantity = $scope.quantities[0];
    $scope.setSelectedQuantity = function( value ){
        $scope.selectedQuantity = value;
    }
    
    $scope.setSelectedQuantity = function( value ){
        $scope.selectedQuantity = value;
    }

    $scope.setSelectedCategory = function( value ){
        $scope.selectedCategory = value;
    }
    
    $scope.updateSelectedCategory = function( iid, value ){
		var reload = (value == "--------- ADD CATEGORY ---------");
		if( reload ){
			value = prompt("Please enter a category name below:","");
		}
        var data = {ingredient_id: iid, ingredient_category: value.toLowerCase()}
        groceryService.updateCategory(data, $scope)
		if( reload ){
			$route.reload();
		}
    }    
    
    $scope.updateSelectedQuantity = function( miid, value ){
        var data = {mealingredient_id: miid, quantity: value}
        groceryService.updateQuantity(data, $scope)
    }
    
    $scope.selectedIngredient = "";
    
    $scope.save = function(meal_id, selectedValue){
		if( selectedValue == "--------- ADD INGREDIENT ---------"){
			selectedValue = prompt("Please enter a category name below:","");
			var data = {mealid: meal_id, name: selectedValue.toLowerCase() };
			groceryService.saveIngredient( data, $scope );
		}else{
			for( var i = 0; i < $scope.ingredientObjects.length; i++ ){
				if( $scope.ingredientObjects[i].name == selectedValue ){
					var ingredient = $scope.ingredientObjects[i];
					var data = {mealid: meal_id, ingredient: ingredient.name, category: ingredient.category, ingredientId:ingredient.id, quantity:"1" };
					groceryService.save(data);
				}
			}
		}
    }
    
    $scope.remove = function( ingredient ){
        var data = {ingredient_id: ingredient.mealingredientid};
        groceryService.remove(data);
        for( var i = 0; i < $scope.selectedMealIngredients.length; i++ ){ 
            if( $scope.selectedMealIngredients[i].mealingredientid == ingredient.mealingredientid ){
                $scope.selectedMealIngredients.splice(i, 1);
            }
        }

    }
    
    $scope.decodeMenuCategory = function( code ){
        switch(code){
            case "b":
                return "Breakfast";
            case "l":
                return "Lunch";
            case "d":
                return "Dinner";
        }
    };

    $scope.category = $scope.decodeMenuCategory($routeParams.category);

    $scope.nthDay = function nthDay(date) {
		var split = date.split("-");
		if( split.length > 2 ){
			var day = parseInt(split[2]);
		
			if(day>3 && day<21){
				return 'th'; // thanks kennebec
			}
			
			switch (day % 10) {
				case 1:  return "st";
				case 2:  return "nd";
				case 3:  return "rd";
				default: return "th";
			}
		}
		return "";
    }
    
    $scope.checkMealCount = function( cattype ){
        $scope.mealcount = 0;
        if( $scope.selectedMeals.length > 0 ){ // Make sure meals where selected
            for( var i=0; i<$scope.selectedMeals.length; i++ ){  // Loope through all meals
                var imeal = $scope.selectedMeals[i]
                if( imeal.category == cattype ){    // Make sure that the meal category matches the selected meal type
                    $scope.mealcount += 1;
                }
            }
            $routeParams.category = $scope.mealtype;
        }
        $scope.isDisabled = ($scope.mealcount <= 0);
    }
    
    $scope.checkMealCount( $scope.mealtype );
    
}]);