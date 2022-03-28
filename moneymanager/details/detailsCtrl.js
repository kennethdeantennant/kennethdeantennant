'use strict';

app.controller('detailsController', ['$scope', '$http', '$location', '$routeParams', 'detailsService', function ($scope, $http, $location, $routeParams, detailsService) {
    
    $scope.today = new Date();
    $scope.selectDate = angular.copy( $scope.today );
        
    if (typeof String.prototype.startsWith != 'function') {
      String.prototype.startsWith = function (str){
        return this.slice(0, str.length) == str;
      };
    }
    
    if (typeof String.prototype.endsWith != 'function') {
      String.prototype.endsWith = function (str){
        return this.slice(-str.length) == str;
      };
    }
    
    $scope.id = $routeParams.category;
    
    var data = {category:$scope.id};
    $scope.category = [];
    detailsService.retrieveCategory(data, $scope);
    
    $scope.transactions = [];
    detailsService.retrieveTransactions(data, $scope);
    
    $scope.descriptions = [];
    var scopeData = {category: $scope.id};
    detailsService.retrieveDescriptions(scopeData, $scope);
    
    $scope.asOfDates = [];
    detailsService.retrieveAsOfDates($scope);
    
    $scope.negativeValue=function(myValue){
      var num = parseFloat(myValue);
      if(num < 0){
        var css = { 'color':'red' };
        return css;
      }
    }
    
    $scope.delete = function( value ){
        var data = {detail:value};
        detailsService.deleteDetail( data, $scope );
    }
    
    $scope.isSaveDisabled = true;
    $scope.showNewDescription = false;
    $scope.check = function(){
        if( $scope.newTransaction.description == "Add Description" ){
            $scope.showNewDescription = true;
        }else if( $scope.newTransaction.description.startsWith("----------") ){
            $scope.isSaveDisabled = true;
        }else{
            $scope.isSaveDisabled = false;
        }
    }
    
    $scope.save = function(){
        var amount = $scope.newTransaction.amount;
        if( $scope.newTransaction.type == "w" ){
            amount = -amount;
        }
        var description = $scope.newTransaction.description;
        if( angular.isDefined($scope.newTransaction.newDescription) && $scope.newTransaction.newDescription.length > 0 ){
            description = $scope.newTransaction.newDescription;
        }
        var datetime = moment($scope.newTransaction.date);
        var data = {amount:amount, date: datetime.format("YYYY-MM-DD"), time: datetime.format("HH:MM:SS"), description: description, category: $scope.id};
        detailsService.save( data, $scope );
    }
    
    $scope.reset = function(){
        $scope.newTransaction = {}
        $scope.newTransaction.date = $scope.today;
        $scope.newTransaction.type = "w";
        
        $scope.showNewDescription = false;
        $scope.isSaveDisabled = true;
    }
    
    $scope.newTransaction = {};
    $scope.newTransaction.date = $scope.today;
    $scope.newTransaction.type = "w";
}]);