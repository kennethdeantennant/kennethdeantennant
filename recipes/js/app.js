'use strict';
// Module
var app = angular.module('app', ['ngRoute']);

// Routes
app.config(['$routeProvider', '$locationProvider',
    function ($routeProvider, $locationProvider) {
        $routeProvider
            .when('/', {
                templateUrl: 'listing/listing.html',
                controller: 'listingController'
            })
            .when('/view/:id', {
                templateUrl: 'view/view.html',
                controller: 'viewController'
            })
            .when('/edit/:id', {
                templateUrl: 'edit/edit.html',
                controller: 'editController'
            })
            .when('/add/', {
                templateUrl: 'add/add.html',
                controller: 'addController'
            });
    $locationProvider.html5Mode(true);
}]);


app.run(function($rootScope, $location, loginService){
    var routespermission=[''];
    $rootScope.$on('$routeChangeStart', function(){
        if( routespermission.indexOf($location.path()) != -1 ){
            var connected = loginService.islogged();
            connected.then(function(msg){
                if( !msg.data ) $location.path('/');
            });
        }
    });
});