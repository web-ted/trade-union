/**
 * Created by sulimo on 17/1/2016.
 */
angular.module('TradeUnion')
    .controller('WorkersController', function($scope, Worker) {
        $scope.workers =  Worker.query();
        $scope.currentPage = 1;
        $scope.begin = 1;
        $scope.itemsPerPage = 6;
        $scope.rotate = true;
        $scope.forceEclipses = true;
        $scope.boundaryLinks = true;
        $scope.maxSize = 5;
        $scope.showPagination = true;
        // $scope.predicate = 'last_name';
        // $scope.reverse = false;

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

        $scope.setPage = function () {
            $scope.begin = ($scope.itemsPerPage * ($scope.currentPage-1))+1;
            $scope.showPagination = true;
        };

        $scope.order = function(predicate) {
            $scope.reverse = ($scope.predicate === predicate) ? !$scope.reverse : false;
            $scope.predicate = predicate;
        };

        $scope.saveWorker = function() {
            $scope.entry.$save();
        };

        $scope.editWorker = function(record) {
            $scope.entry = new Worker();
            $scope.entry = record;
        };
    });