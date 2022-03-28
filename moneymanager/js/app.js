'use strict';
// Module
var app = angular.module('app', ['ngRoute']);

// Routes
app.config(['$routeProvider', '$locationProvider', 
    function ($routeProvider, $locationProvider) {
        $routeProvider
            .when('/', {
                templateUrl: 'login/login.html',
                controller: 'loginController'
            })
            .when('/summary', {
                templateUrl: 'summary/summary.html',
                controller: 'summaryController'
            })
            .when('/deposits', {
                templateUrl: 'deposits/deposits.html',
                controller: 'depositsController'
            })
            .when('/deposits_add', {
                templateUrl: 'deposits/add.html',
                controller: 'depositsController'
            })
            .when('/deposits_update/:id', {
                templateUrl: 'deposits/update.html',
                controller: 'updateController'
            })
            .when('/categories', {
                templateUrl: 'categories/categories.html',
                controller: 'categoriesController'
            })
            .when('/details/:category', {
                templateUrl: 'details/details.html',
                controller: 'detailsController'
            })
            .when('/details_add/:category/:action', {
                templateUrl: 'details/add.html',
                controller: 'detailsController'
            })
            .when('/account', {
                templateUrl: 'account/account.html',
                controller: 'accountController'
            })
            .when('/expenses/', {
                templateUrl: 'expenses/expenses.html',
                controller: 'expensesController'
            })
            .when('/expenses/:category', {
                templateUrl: 'expenses/expenses.html',
                controller: 'expensesController'
            })
            .when('/income/', {
                templateUrl: 'income/income.html',
                controller: 'incomeController'
            })
            .otherwise({redirectTo: '/'});
//    $locationProvider.html5Mode(true);
}])
.filter("myDateFilter", function() {
  return function(items, asOfDate) {
        var result = [];        
        for (var i=0; i<items.length; i++){
            if (items[i].date >= asOfDate)  {
                result.push(items[i]);
            }
        }            
        return result;
  };
})
.filter("myExpensesDateFilter", function() {
  return function(items, selectedYear) {
    var result = [];        
    for (var i=0; i<items.length; i++){
        if( items[i].year === selectedYear ){
            result.push(items[i]);
        }
    }            
    return result;
  };
})
.filter('total', function () {
    return function (data, keyAmount, keyYear, keyCat, year, cat) {        
        if (angular.isUndefined(data) && angular.isUndefined(key))
            return 0;        
        var sum = 0;        
        angular.forEach(data,function(value){
            if( value[keyYear] == year && value[keyCat] == cat ){
                sum = sum + parseFloat(value[keyAmount]);
            }
        });        
        return sum;
    }
})
.filter("myDescriptionFilter", function() {
  return function(items, description) {
        var result = [];        
        for (var i=0; i<items.length; i++){
            if ( angular.isUndefined(description) || items[i].description.startsWith(description) )  {
                result.push(items[i]);
            }
        }            
        return result;
  };
})
.filter("myDepositFilter", function() {
  return function(items, year) {
        var result = [];
        if( angular.isUndefined(year) ){
            return result;
        }
        for (var i=0; i<items.length; i++){
            var depositYear = moment(items[i].edate).format("YYYY");
            if ( depositYear == year )  {
                result.push(items[i]);
            }
        }
        return result;
  };
})
.filter('totalDepositAmount', function () {
    return function (data, key1, key2, date) {
        if (typeof (data) === 'undefined' && typeof (key1) === 'undefined' && typeof (key2) === 'undefined') {
            return 0.00;
        }
        var sum = 0.00;
        if( angular.isUndefined( data ) ){
            return sum;
        }
        for (var i = 0; i < data.length; i++) {
            if(data[i].edate == date){
                sum = sum + (parseFloat(data[i][key1]) * parseFloat(data[i][key2]));
            }
        }
        return sum;
    }
})
.filter('totalDepositPercent', function () {
    return function (data, key1, date) {
        if( typeof (data) === 'undefined' && typeof (key1) === 'undefined' ){
            return 0.00;
        }
        var sum = 0.00;
        if( angular.isUndefined( data ) ){
            return sum;
        }
        for( var i = 0; i < data.length; i++ ){
            if(data[i].edate == date){
                sum = sum + parseFloat(data[i][key1]);
            }
        }
        return sum;
    }
})
.filter('percentage', ['$filter', function ($filter) {
  return function (input, decimals) {
    return $filter('number')(input * 100, decimals) + '%';
  };
}])
.run(function($rootScope, $location, loginService){
    var routespermission=['/summary','/expenses'];
    $rootScope.$on('$routeChangeStart', function(){
        if( routespermission.indexOf($location.path()) != -1 ){
            var connected = loginService.islogged();
            connected.then(function(msg){
                if( !msg.data ) $location.path('/');
            });
        }
    });
});