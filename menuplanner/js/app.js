'use strict';
// Module
var app = angular.module('app', ['ngRoute','checklist-model']);

// Routes
app.config(['$routeProvider', '$locationProvider', 
    function ($routeProvider, $locationProvider) {
        $routeProvider
            .when('/', {
                templateUrl: 'login/login.html',
                controller: 'loginController'
            })
            .when('/meals', {
                templateUrl: 'meals/meals.html',
                controller: 'mealsController'
            })
            .when('/groceries/:today/:category', {
                templateUrl: 'groceries/groceries.html',
                controller: 'groceriesController'
            })
            .when('/menus', {
                templateUrl: 'menus/menus.html',
                controller: 'menusController'
            })
            .when('/menus/:category', {
                templateUrl: 'menus/menus.html',
                controller: 'menusController'
            })
            .when('/print/:today/:category', {
                templateUrl: 'print/print.html',
                controller: 'printController'
            })
            .when('/account', {
                templateUrl: 'account/account.html',
                controller: 'accountController'
            });
//    $locationProvider.html5Mode(true);
}]);


app.run(function($rootScope, $location, adminService){
    var routespermission=['/menu'];
    $rootScope.$on('$routeChangeStart', function(){
        if( routespermission.indexOf($location.path()) != -1 ){
            var connected = adminService.islogged();
            connected.then(function(msg){
                if( !msg.data ) $location.path('/');
            });
        }
    });
});