'use strict';
// Module
var app = angular.module('app', ['ngRoute']);

// Routes
app.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'login/login.html',
            controller: 'loginController'
        })
        .when('/summary', {
            templateUrl: 'summary/summary.html',
            controller: 'summaryController'
        })
        .when('/profile', {
            templateUrl: 'profile/profile.html',
            controller: 'profileController'
        })
        .when('/manage/:today', {
            templateUrl: 'manage/manage.html',
            controller: 'manageController'
        })
        .when('/new/:today', {
            templateUrl: 'new/new.html',
            controller: 'newController'
        })
        .when('/key/:today', {
            templateUrl: 'key/key.html',
            controller: 'keyController'
        })
        .when('/account', {
            templateUrl: 'account/account.html',
            controller: 'accountController'
        })
        .otherwise({redirectTo: '/'});
})
.run(function($rootScope, $location, loginService){
    var routespermission=['/manage'];
    $rootScope.$on('$routeChangeStart', function(){
        if( routespermission.indexOf($location.path()) != -1 ){
            var connected = loginService.islogged();
            connected.then(function(msg){
                if( !msg.data ){
                    $location.path('/');
                }
            });
        }
    });
});