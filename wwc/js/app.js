'use strict';
// Module
var app = angular.module('app', ['ngRoute']);

// Routes
app.config(['$routeProvider', '$locationProvider', 
    function ($routeProvider, $locationProvider) {
        $routeProvider
            .when('/', {
                templateUrl: 'pages/main.html',
                controller: 'mainController'
            })
            .when('/rooms', {
                templateUrl: 'pages/rooms.html',
                controller: 'roomsController'
            })
            .when('/gallery', {
                templateUrl: 'pages/gallery.html',
                controller: 'galleryController'
            })
            .otherwise({redirectTo: '/'});
//    $locationProvider.html5Mode(true);
}]);