'use strict';
// Module
var app = angular.module('app', ['ngRoute','ui.bootstrap']);

// Routes
app.config(['$routeProvider','$locationProvider',
    function ($routeProvider, $locationProvider) {
        $routeProvider
            .when('/', {
                templateUrl: 'login/login.html',
                controller: 'loginController'
            })
            .when('/entries', {
                templateUrl: 'entries/entries.html',
                controller: 'entriesController'
            })
            .when('/entries/:priornext', {
                templateUrl: 'entries/entries.html',
                controller: 'entriesController'
            })
            .when('/entry/:date', {
                templateUrl: 'entries/entry.html',
                controller: 'entriesController'
            })
            .when('/account', {
                templateUrl: 'account/account.html',
                controller: 'accountController'
            })
            .when('/print', {
                templateUrl: 'print/print.html',
                controller: 'printController'
            });
    
//    $locationProvider.html5Mode(true);
}])
.filter('myEntryDateFilter', function() {
  return function(items, chosen) {
        var result = [];
        if( angular.isUndefined(chosen) ){
            return result;
        }
        if( angular.isUndefined(items) ){
            return result;
        }
        for (var i=0; i<items.length; i++){
            var entryFullDate = moment(items[i].edate).format("YYYYMMDD");
            if ( entryFullDate == moment(chosen).format("YYYYMMDD") )  {
                result.push(items[i]);
            }
        }
        return result;
  };
});

app.run(function($rootScope, $location, loginService){
    var routespermission=['/entries','/entry'];
    $rootScope.$on('$routeChangeStart', function(){
        if( routespermission.indexOf($location.path()) != -1 ){
            var connected = loginService.islogged();
            connected.then(function(msg){
                if( !msg.data ) $location.path('/');
            });
        }
    });
});