'use strict';

app.controller('entriesController', ['$scope', '$http', '$routeParams', '$timeout', '$location', '$route', 'loginService', 'entriesService', function ($scope, $http, $routeParams, $timeout, $location, $route, loginService, entriesService) {
    
    entriesService.setUserName($scope);
    entriesService.retrieveEntries(null, $scope);
    
    $scope.lastUpdated = "";
    
    var months = new Array();
    months[0] = "January";
    months[1] = "February";
    months[2] = "March";
    months[3] = "April";
    months[4] = "May";
    months[5] = "June";
    months[6] = "July";
    months[7] = "August";
    months[8] = "September";
    months[9] = "October";
    months[10] = "November";
    months[11] = "December";
    
    var now = moment();
    $scope.today = now.format("YYYY-MM-DD");
    $scope.selectedDate = "";
    
    $scope.addEntry = false;

    $scope.setSelectedDate = function( value ){
        $location.path("/entry/"+value);
    }
    
    $scope.selectedMonth = now.format("MMMM");
    $scope.selectedYear = now.format("YYYY");
    
    $scope.priorMonth = now.subtract(1, "month").format("YYYY-MM-") + "01";

    $scope.showNext = false;
    $scope.nextMonth = now.add(2, "month").format("YYYY-MM-") + "01";
    
    if( $routeParams.priornext != null ){
        var today = moment();
        var date = moment(new Date($routeParams.priornext + " 00:00:00"));

        $scope.selectedMonth = months[parseInt($routeParams.priornext.substring(5,7)) - 1];
        $scope.selectedYear = $routeParams.priornext.substring(0,4);
        
        $scope.priorMonth = date.subtract(1, "month").format("YYYY-MM-") + "01";
        $scope.showPrior = parseInt(today.format("YYYYMM")) >= parseInt(date.format("YYYYMM"));

        $scope.nextMonth = date.add(2, "month").format("YYYY-MM-") + "01";
        $scope.showNext = parseInt(today.format("YYYYMM")) >= parseInt(date.format("YYYYMM"));
        
        $scope.showMonth = true;
    }
    
    $scope.logout = function () {
        $scope.message = "";
        loginService.logout();
    }
    
    var month = "";
    $scope.showMonth = true;
    
    $scope.spelledOutMonth = function(date) {
        var splits = date.split("-");
        
        var idxMonth = months[parseInt(splits[1]) - 1];
        return idxMonth;
    };
    
    $scope.dayOfWeek = function(sdate) {
        var split = sdate.split("-");

        // new Date(year, month (0-based), day)
        var date = new Date(split[0], parseInt(split[1])-1, split[2]);
        var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        return days[ date.getDay() ];
    };
    
    $scope.dayFromDate = function(sdate) {
        var split = sdate.split("-");
		if( split.length > 2 ) return parseInt(split[2]);
        return "";
    };
    
    $scope.yearFromDate = function(sdate) {
        var split = sdate.split("-");
		if( split.length > 2 ) return split[0];
		return "";
    };
    
    $scope.nthDay = function nthDay(sdate) {
		var split = sdate.split("-");
		if( split.length > 2 ){
			var day = parseInt(split[2]);
		
			if(day>3 && day<21){
				return 'th';
			}
			
			switch (day % 10) {
				case 1:  return "st";
				case 2:  return "nd";
				case 3:  return "rd";
				default: return "th";
			}
		}
		return "";
    } 
    
    $scope.routeDatePrior = null;
    $scope.routeDateNext = null;
	$scope.routeDate = null;
    if( $routeParams.date != null ){
        $scope.routeDate = $routeParams.date;
        var date = moment($routeParams.date);
        $scope.routeDatePrior = date.subtract(1, 'd').format('YYYY-MM-DD');
        $scope.routeDateNext = date.add(2, 'd').format('YYYY-MM-DD');

        var data = {entrydate: $scope.routeDate};
        entriesService.retrieveSingleEntry(data, $scope);
    }
    
    $scope.show = true;
    $scope.doWordCount = function(data){
		if(undefined != data && data.length > 0){
			var formcontent = data.split(" ");
			var number = formcontent.length;
            $scope.show = false;
			return numeral(number).format('0,0');
		}else{
			return 0;
		}
    }
    
    $scope.date = new Date();
    
    $http.get('entries/doesTodayExistCode.php').success(function( data, status, headers, config ){
        $scope.doesTodayExist = data;
    });

	var timeout = null;
	$scope.saveInProgress = false;
	
	var saveUpdates = function() {
		$scope.saveInProgress = true;
		$scope.save($scope.singleEntryID, true);
		$scope.saveInProgress = false;
        $scope.lastUpdated = moment();
	};
	
	var debounceSaveUpdates = function(newVal, oldVal) {
	    if (newVal != oldVal) {
			if (timeout) {
				$timeout.cancel(timeout)
			}
			timeout = $timeout(saveUpdates, 15000);  // 5000 = 5 seconds
		}
	};
	$scope.$watch('singleEntryText', debounceSaveUpdates)
	$scope.$watch('singleTopic', debounceSaveUpdates)
    
    $scope.save = function( eid, autosave ) {
        if( eid == "n" ){ // SAVE
			var text = undefined != $scope.singleEntryText ? $scope.singleEntryText.split("\n\n").join("<p></p><p></p>") : null;
            var data = {entry: text, entrydate: $routeParams.date, topic: $scope.singleTopic};
            console.log(data);
            entriesService.saveSingleEntry(data, $scope, autosave);
        }else{ // UPDATE
            var text = $scope.singleEntryText.split("\n\n").join("<p></p><p></p>");
            if( text.length > 0 ){
                var data = {id: eid, text: $scope.singleEntryText.split("\n\n").join("<p></p><p></p>"), topic: $scope.singleTopic};
                entriesService.updateSingleEntry(data, $scope, autosave);
            }else{
                var data = {id: eid};
                entriesService.deleteSingleEntry(data);
            }
        }
        $scope.lastUpdated = moment();
    }
    
    $scope.delete = function( eid ) {
        if( undefined != eid ){
            if(confirm("Are you sure you want to delete?")){
                var data = {id: eid};
                entriesService.deleteSingleEntry(data);
            }
        }
    }

    var dateTime = moment();
    $scope.day = dateTime.format("dddd, MMMM DD, YYYY");
    
    $scope.selectedDay = null;
    
    $scope.linkIsVisible = function( date ){
        var today = moment();
        $scope.selectedDay = moment(new Date(date)).format("YYYY-MM-DD");
        
        var selectedDay = moment(new Date(date));
        return selectedDay.format("YYYYMMDD") < today.format("YYYYMMDD");
    }
    
    var mdate = moment()
    $scope.maxDate = mdate.add(-1, 'day').format("YYYY/MM/DD");
    
    $scope.day = moment();
    
    $scope.chosen = _removeTime($scope.chosen || moment());
    $scope.month = $scope.chosen.clone();
    
    var start = $scope.chosen.clone();
    start.date(1);
    _removeTime(start.day(0));
    _buildMonth($scope, start, $scope.month);

    $scope.select = function(day, entries) {
        $scope.chosen = day.date;
        $scope.show = true;
    };
    
    $scope.next = function() {
        var next = $scope.month.clone();
        _removeTimeAlt(next.month(next.month()+2)).date(1);
        $scope.month.month($scope.month.month()+2);
        _removeTimeAlt(next.month(next.month()-1).date(1));
        $scope.month.month($scope.month.month()-1);
        _buildMonth($scope, next, $scope.month);
        $scope.showNext = parseInt(next.format("YYYYMM")) < parseInt(moment().add(-1, 'month').format("YYYYMM"));
    };

    $scope.previous = function() {
        var previous = $scope.month.clone();
        $scope.showNext = true;

        _removeTimeAlt(previous.month(previous.month()-1).date(1));
        $scope.month.month($scope.month.month()-1);
        _buildMonth($scope, previous, $scope.month);
    };
    
    function _removeTime(date) {
        return date.hour(0).minute(0).second(0).millisecond(0);
    }

    function _removeTimeAlt(date) {
        return date.day(0).hour(0).minute(0).second(0).millisecond(0);
    }

                        
    function _buildMonth(scope, start, month) {
        $http.get('entries/retrieveDatesCode.php').success(function( data, status, headers, config ){
            var dates = [];
            for(var i=0; i<data.length; i++){
                dates.push(data[i].date)
            }
            
            $scope.weeks = [];
            var done = false, date = start.clone(), monthIndex = date.month(), count = 0;
            while (!done) {
                $scope.weeks.push({ days: _buildWeek(date.clone(), month, dates) });
                date.add(1, "w");
                done = count++ > 2 && monthIndex !== date.month();
                monthIndex = date.month();
            }
        });
    }

    function _buildWeek(date, month, dates) {
        var days = [];
        for (var i = 0; i < 7; i++) {
            days.push({
                name: date.format("dd").substring(0, 1),
                number: date.date(),
                isCurrentMonth: date.month() === month.month(),
                hasEntry: dates.indexOf(date.format("YYYY-MM-DD"))>0,
                date: date
            });
            date = date.clone();
            date.add(1, "d");
        }
        return days;
    }
    
    $scope.split = function( value ){
        var results = value.split("<p></p><p></p>");
        return results;
    }
    
    $scope.cancel = function(){
        $location.path('/entries');
    }
    
}]);