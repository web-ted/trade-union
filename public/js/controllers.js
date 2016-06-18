/**
 * Created by sulimo on 17/1/2016.
 */
angular.module('TradeUnion')
    .controller('WorkersController', function ($scope, $filter, Worker, Specialty, Enterprise) {
        $scope.currentPage = 1;
        $scope.begin = 0;
        $scope.itemsPerPage = 5;
        $scope.rotate = true;
        $scope.forceEclipses = true;
        $scope.boundaryLinks = true;
        $scope.showPagination = true;
        // $scope.predicate = 'last_name';
        // $scope.reverse = false;

        $scope.loadWorkers = function () {
            var workers = [],
                dates = [
                    'birth_date',
                    'hire_date',
                    'registered_at'
                ];

            Worker.query({}, function (response) {
                var data = angular.copy(response);

                angular.forEach(data, function (worker) {
                    dates.forEach(function (fieldName) {
                        if (worker[fieldName]) {
                            worker[fieldName] = new Date(worker[fieldName] * 1000);
                        }
                    });

                    this.push(worker);
                }, workers);

                $scope.workers = workers;
                $scope.reloading = false;
            });
        };

        $scope.loadOther = function () {
            Specialty.query({}, function (response) {
                $scope.specialties = angular.copy(response);
            });

            Enterprise.query({}, function (response) {
                $scope.enterprises = angular.copy(response);
            });
        };

        $scope.loadAll = function () {
            $scope.reloading = true;
            $scope.loadWorkers();
            $scope.loadOther();
        };


        $scope.clearSearch = function () {
            $scope.search = '';
            $scope.searching();
        };

        $scope.searching = function () {
            if ($scope.search == '') {
                $scope.itemsPerPage = 10;
                $scope.begin = 0;
                $scope.showPagination = true;
            } else {
                $scope.showPagination = false;
                $scope.itemsPerPage = undefined;
            }
        };

        $scope.setPage = function (page) {
            $scope.begin = ($scope.itemsPerPage * (page - 1));
            $scope.showPagination = true;
        };

        $scope.order = function (predicate) {
            $scope.reverse = ($scope.predicate === predicate) ? !$scope.reverse : false;
            $scope.predicate = predicate;
            $scope.begin = 0;
        };

        $scope.updateWorker = function (record) {
            Worker.update({id: record.id}, record, function (worker) {
                if (worker[0] != 0) {
                    $scope.loadAll();
                }
            });
        };

        $scope.createWorker = function (record) {
            Worker.save({id: record.id}, record);
        };

        $scope.editWorker = function (record) {
            var entry = angular.copy($scope.workers[$scope.workers.indexOf(record)]);

            $scope.action = 'update';
            $scope.originalEntry = entry;
            $scope.entry = entry;
        };

        $scope.addWorker = function() {
            Worker.max({}, function(worker) {
                $scope.action = 'create';
                $scope.entry = {
                    active: true,
                    registered_at: new Date(new Date().setHours(0, 0, 0, 0)),
                    registration_number: worker.maxRegistrationNumber+1
                };
            });
        };

        $scope.deleteWorker = function (record) {
            Worker.delete({id: record.id}, function () {
                delete $scope.workers[$scope.workers.indexOf(record)];
            });
        };

        $scope.loadAll();
    });