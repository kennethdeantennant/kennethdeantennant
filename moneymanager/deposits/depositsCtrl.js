'use strict';

app.controller('depositsController', ['$scope', '$http', '$location', '$routeParams', 'depositsService', function ($scope, $http, $location, $routeParams, depositsService) {
    
    var today = moment();
    $scope.today = today.format("YYYY-MM-DD");
    
    $scope.newDeposit = [];
    $scope.isDepositFinalized = false;
    
    if( angular.isDefined($routeParams.id) ){
        $scope.id = $routeParams.id;
        $scope.deposit = [];
        var data = {deposit:$scope.id};
        depositsService.retrieveDeposit( data, $scope );
    }
    
    $scope.selectYear = moment( $scope.today ).format("YYYY");
    $scope.setSelectYear = function( value ){
        $scope.selectYear = value;
    }

    $scope.deposits = [];
    depositsService.retrieveDeposits($scope);
    
    $scope.depositTotal = 0.00;    
    $scope.setDepositTotal = function( depositCategory ){
        if( depositCategory ){
            $scope.depositTotal += depositCategory.calculatedAmount;
        }
    }
    
    $scope.setGrossNetAmounts = function( value ){
        var idx = $scope.depositDates.indexOf( value );
        $scope.depositGross = $scope.grossAmounts[idx];
        $scope.depositNet = $scope.netAmounts[idx];

        for( var i=0; i<$scope.depositCategories.length; i++ ){
            if( $scope.depositCategories[i].edate == value ){
                $scope.isDepositFinalized = $scope.depositCategories[i].finalized == "Y";
                break;
            }
        }
    }
    
    $scope.save = function(){
        var data = {gross:$scope.newDeposit.gross, net:$scope.newDeposit.net};
        depositsService.save(data, $scope);
    }
    
    $scope.edit = function( value ){
        for( var i=0; i<$scope.depositCategories.length; i++ ){
            if( $scope.depositCategories[i].edate == value ){
                $location.path("/deposits_update/" + $scope.depositCategories[i].id);
            }
        }
    }
    
    $scope.remove = function( value ){
        if( confirm("Are you sure you want to remove the " + moment(value).format("MMM Do, YYYY") + " deposit?") ){
            for( var i=0; i<$scope.depositCategories.length; i++ ){
                if( $scope.depositCategories[i].edate == value ){
                    var data = {deposit: $scope.depositCategories[i].id};
                    depositsService.remove(data, $scope);
                    break;
                }
            }
        }
    }
    
}]);