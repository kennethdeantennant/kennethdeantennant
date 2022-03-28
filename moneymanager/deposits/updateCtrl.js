'use strict';

app.controller('updateController', ['$scope', '$http', '$location', '$routeParams', 'updateService', 'summaryService', 'sessionService', 'accountService', function ($scope, $http, $location, $routeParams, updateService, summaryService, sessionService, accountService) {
    
    $scope.user = [];
    if( sessionService.get("uid") != null ){
        $scope.isUpdateAccount = true;
        $scope.id = sessionService.get("uid");
    
        var data = {user:sessionService.get("uid")};
        accountService.retrieveUser(data, $scope);
    }else{
        $scope.isUpdateAccount = false;
    }
    
    $scope.canFinalize = true;
    $scope.newDeposit = [];
    
    $scope.id = $routeParams.id;
    $scope.deposit = [];
    var data = {deposit:$scope.id};
    updateService.retrieveDeposit( data, $scope );
    
    $scope.categories = [];
    summaryService.retrieveCategories($scope);
    
    $scope.deposits = [];
    updateService.retrieveDeposits($scope);
    
    $scope.retrieveTotal = function( category ){
        for( var i=0; i < $scope.categories.length; i++ ){
            if( $scope.categories[i].id == category ){
                return $scope.categories[i].amount;
            }
        }
    }
    
    $scope.negativeValue=function(myValue){
      var num = parseFloat(myValue);

      if(num < 0){
        var css = { 'color':'red' };
        return css;
      }
    }
    
    $scope.setGrossNetAmounts = function( value ){
        var idx = $scope.depositDates.indexOf( value );
        $scope.depositGross = $scope.grossAmounts[idx];
        $scope.depositNet = $scope.netAmounts[idx];
    }
    
    $scope.depositTotal = 0.00;    
    $scope.setDepositTotal = function( percentage ){
        if( percentage ){
            percentage.calculatedAmount = parseFloat(percentage.net) * parseFloat(percentage.percent);
            $scope.depositTotal += percentage.calculatedAmount;
        }
    }
    
    $scope.percentages = [];
    $scope.change = function( value ){
        var total = 0.0000;
        for( var i=0; i < $scope.percentages.length; i++ ){
            if( $scope.percentages[i].name == value ){
                $scope.percentages[i].calculatedAmount = parseFloat($scope.percentages[i].net) * parseFloat($scope.percentages[i].percent);
            }
            total += parseFloat( $scope.percentages[i].percent );
            $scope.canFinalize = (parseFloat( total ).toFixed(2)*100 == 100);
        }
    }
    
    $scope.update = function( value ){
        var total = 0.0000;
        for( var i=0; i < $scope.percentages.length; i++ ){
            if( $scope.percentages[i].name == value ){
                var data = {deposit:$scope.percentages[i].deposit, type:$scope.percentages[i].type, percent: parseFloat($scope.percentages[i].percent).toFixed(4)}
                updateService.update( data, $scope );
            }
        }
    }
    
    $scope.save = function(){
        var data = {deposit:$scope.percentages[0].deposit};
        updateService.finalize(data, $scope);
    }
    
    $scope.updateGrossAmount = function(){
        var newAmount = prompt("Enter new amount below...", $scope.depositGross);
        if( parseFloat( newAmount) != parseFloat($scope.depositGross) ){
            $scope.depositGross = parseFloat( newAmount ).toFixed(2);

            var data = {deposit:$scope.id, amount: newAmount};
            updateService.updateGrossAmount( data, $scope );
        }
    }
    
    $scope.updateNetAmount = function(){
        var newAmount = prompt("Enter new amount below...", $scope.depositNet);
        if( parseFloat( newAmount) != parseFloat( $scope.depositNet ) ){
            $scope.depositNet = parseFloat( newAmount ).toFixed(2);

            var data = {deposit:$scope.id, amount: newAmount};
            updateService.updateNetAmount( data, $scope );
        }
    }
    
}]);