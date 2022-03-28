'use strict';

app.controller('menusController', ['$scope', '$location', '$routeParams', 'menusService', function ($scope, $location, $routeParams, menusService) {

    menusService.setUserName($scope);
    
    if( !$routeParams.category ){
        $scope.mealtype = "b";
    }else{
        $scope.mealtype = $routeParams.category;
    }
    
    $scope.today = moment();
    
    $scope.menus = [];
    menusService.retrieveMenus($scope);    
    
    $scope.meals = [];
    menusService.retrieveMeals($scope);    
    
    $scope.deleteMenu= function( value, fdate ){
        var category = decodeMenuCategory(value.menu_type);
        if(confirm("Are you sure you want to remove "+category+" menu for "+fdate+"?")){
            var data = { menu_date: value.menu_date, menu_type: $scope.mealtype };
            menusService.deleteMenu(data);
            for( var i = 0; i < $scope.menus.length; i++ ){ 
                if( $scope.menus[i].menu_date == value.menu_date && $scope.menus[i].menu_type == value.menu_type){
                    $scope.menus.splice(i, 1);
                }
            }
        }
    }
    
    $scope.printMenu = function( value, fdate ){
        $location.path("/print/" + value.menu_date + "/" + value.menu_type);
    }
    
    function decodeMenuCategory( code ){
        switch(code){
            case "b":
                return "breakfast";
            case "l":
                return "lunch";
            case "d":
                return "dinner";
        }
    };

}]);