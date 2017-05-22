/**
 * Created by sulimo on 17/1/2016.
 */
angular.module('TradeUnion')
    .controller('WorkersController', function($scope, Worker, Specialty, Enterprise) {
        $scope.workers =  Worker.query();
        $scope.specialties = Specialty.query();
        $scope.enterprises = Enterprise.query();
        $scope.currentPage = 1;
        $scope.begin = 1;
        $scope.itemsPerPage = 5;
        $scope.rotate = true;
        $scope.forceEclipses = true;
        $scope.boundaryLinks = true;
        $scope.maxSize = 5;
        $scope.showPagination = true;
        //$scope.predicate = 'last_name';
        //$scope.reverse = false;
        $scope.datePickerOptions = {
            dateDisabled: false,
            formatDay: 'dd',
            formatMonth: 'MM',
            formatYear: 'yyyy'
        };

        $scope.reloadMembers = function() {
            $scope.reloading = true;
            $scope.workers =  Worker.query({}, function(response) {
                console.log(angular.copy(response));
                // angular.forEach($scope.workers, function (value) {  }, );
                $scope.reloading = false;
            }, function() {
                $scope.reloading = false;
            });
            $scope.specialties = Specialty.query();
            $scope.enterprises = Enterprise.query();
        };

        $scope.clearSearch = function() {
            $scope.search = '';
            $scope.setPage(1);
        };

        $scope.searching = function() {
            if($scope.search != '') {
                $scope.limitTo = undefined;
                $scope.begin = 0;
                $scope.showPagination = false;
            } else {
                $scope.setPage(1);
            }
        };

        $scope.setPage = function (page) {
            $scope.begin = ($scope.itemsPerPage * (page-1));
            $scope.showPagination = true;
        };

        $scope.order = function(predicate) {
            $scope.reverse = ($scope.predicate === predicate) ? !$scope.reverse : false;
            $scope.predicate = predicate;
            $scope.begin = 0;
        };

        $scope.updateWorker = function(record) {
            Worker.update({id: record.id}, record);
        };

        $scope.createWorker = function(record) {
            Worker.save({id: record.id}, record);
        };

        $scope.editWorker = function(record) {
            $scope.entry = record;
        };

        $scope.deleteWorker = function(record) {
            Worker.delete({ id: record.id }, function() {
                delete $scope.workers[$scope.workers.indexOf(record)];
            });
        };
    });