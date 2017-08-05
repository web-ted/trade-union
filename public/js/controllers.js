/**
 * Created by sulimo on 17/1/2016.
 */
angular.module('TradeUnion')
    .controller('WorkersController', function ($scope, $filter, toastr, Worker, Specialty, Specialty) {
        var handleFailure = function(response) {
            var data = response.data,
                status = data.status || 'Error',
                message = data.message || "Removed successfully";

            toastr.error(message, status);
        };

        $scope.currentPage = 1;
        $scope.begin = 0;
        $scope.itemsPerPage = 5;
        $scope.rotate = true;
        $scope.forceEclipses = true;
        $scope.boundaryLinks = true;
        $scope.showPagination = true;
        $scope.paginationDisable = false;

        $scope.datePickerOptions = {
            dateDisabled: false,
            formatDay: 'dd',
            formatMonth: 'MM',
            formatYear: 'yyyy'
        };

        $scope.reloadMembers = function() {
            var workers, workersRefined = [];
            $scope.reloading = true;
            workers =  Worker.query({}, function() {
                angular.forEach(workers, function (value) {
                    value.registered_at = new Date(value.registered_at);
                    value.created_at = new Date(value.created_at);
                    value.birth_date = new Date(value.birth_date);
                    value.hire_date = new Date(value.hire_date);
                    this.push(value);
                }, workersRefined);
                $scope.workers = workersRefined;
                $scope.reloading = false;
            }, function() {
                $scope.reloading = false;
            });
        };

        $scope.loadOther = function () {
            Specialty.query({}, function (response) {
                $scope.specialties = angular.copy(response);
            });

            Specialty.query({}, function (response) {
                $scope.specialtys = angular.copy(response);
            });
        };

        $scope.loadAll = function () {
            $scope.reloading = true;
            $scope.reloadMembers();
            $scope.loadOther();
        };


        $scope.clearSearch = function () {
            $scope.search = '';
            $scope.searching();
        };

        $scope.searching = function () {
            if ($scope.search == '') {
                $scope.itemsPerPage = 5;
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
            Worker.update({id: record.id}, record, function (response) {
                var status = response.status || 'Success',
                    message = response.message || "Removed successfully";

                toastr.success(message, status);
                $scope.loadAll();
            }, handleFailure);
        };

        $scope.createWorker = function (record) {
            Worker.save({id: record.id}, record, function (response) {
                var status = response.status || 'Success',
                    message = response.message || "Removed successfully";

                toastr.success(message, status);
                $scope.loadAll();
            }, handleFailure);
        };

        $scope.editWorker = function (record) {
            var entry = angular.copy($scope.workers[$scope.workers.indexOf(record)]);

            $scope.action = 'update';
            $scope.originalEntry = entry;
            $scope.entry = entry;
        };

        $scope.addWorker = function() {
            Worker.max({}, function(worker) {
                $scope.EditWorkerForm.$setPristine();
                $scope.EditWorkerForm.$setUntouched();
                $scope.action = 'create';
                $scope.entry = {
                    active: 1,
                    registered_at: new Date(new Date().setHours(0, 0, 0, 0)),
                    registration_number: worker.maxRegistrationNumber+1
                };
            });
        };

        $scope.deleteWorker = function (record) {
            Worker.delete({id: record.id}, function (response) {
                var status = response.status || 'Success',
                    message = response.message || "Removed successfully";

                toastr.success(message, status);
                $scope.loadAll();
            }, function (response) {
                var data = response.data,
                    status = data.status || 'Error',
                    message = data.message || "Removed successfully";

                toastr.error(message, status);
            });
        };

        $scope.openDatePicker = function() {
            $scope.popupOpened = true;
        };

        $scope.loadAll();
    })
    .controller('EnterprisesController', function ($scope, $filter, toastr, Enterprise) {
        $scope.currentPage = 1;
        $scope.begin = 0;
        $scope.itemsPerPage = 5;
        $scope.rotate = true;
        $scope.forceEclipses = true;
        $scope.boundaryLinks = true;
        $scope.showPagination = true;
        $scope.paginationDisable = false;

        $scope.datePickerOptions = {
            dateDisabled: false,
            formatDay: 'dd',
            formatMonth: 'MM',
            formatYear: 'yyyy'
        };

        $scope.reloadMembers = function() {
            var members, membersRefined = [];
            $scope.reloading = true;
            members =  Enterprise.query({}, function() {
                angular.forEach(members, function (value) {
                    value.founded = new Date(value.founded);
                    value.created_at = new Date(value.created_at);
                    value.updated_at = new Date(value.updated_at);
                    this.push(value);
                }, membersRefined);
                $scope.members = membersRefined;
                $scope.reloading = false;
            }, function() {
                $scope.reloading = false;
            });
        };


        $scope.loadAll = function () {
            $scope.reloading = true;
            $scope.reloadMembers();
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

        $scope.updateMember = function (record) {
            Enterprise.update({id: record.id}, record, function (response) {
                var status = response.status || 'Success',
                    message = response.message || "Removed successfully";

                toastr.success(message, status);
                $scope.loadAll();
            }, function (response) {
                var data = response.data,
                    status = data.status || 'Error',
                    message = data.message || "Removed successfully";

                toastr.error(message, status);
            });
        };

        $scope.createMember = function (record) {
            var newRecord = new Enterprise(record);
            newRecord.$save(record, function (response) {
                var status = response.status || 'Success',
                    message = response.message || "Removed successfully";

                toastr.success(message, status);
                $scope.loadAll();
            }, function (response) {
                var data = response.data,
                    status = data.status || 'Error',
                    message = data.message || "Removed successfully";

                toastr.error(message, status);
            });
        };

        $scope.editMember = function (record) {
            var entry = angular.copy($scope.members[$scope.members.indexOf(record)]);

            $scope.action = 'update';
            $scope.originalEntry = entry;
            $scope.entry = entry;
        };

        $scope.addMember = function() {
            var entry = {};

            $scope.action = 'create';
            $scope.originalEntry = entry;
            $scope.entry = entry;
        };

        $scope.deleteMember = function (record) {
            Specialty.delete({id: record.id}, function (response) {
                var status = response.status || 'Success',
                    message = response.message || "Removed successfully";

                toastr.success(message, status);
                $scope.loadAll();
            }, function (response) {
                var data = response.data,
                    status = data.status || 'Error',
                    message = data.message || "Removed successfully";

                toastr.error(message, status);
            });
        };

        $scope.openDatePicker = function() {
            $scope.popupOpened = true;
        };

        $scope.loadAll();
    })
    .controller('SpecialtiesController', function ($scope, $filter, toastr, Specialty) {
        $scope.currentPage = 1;
        $scope.begin = 0;
        $scope.itemsPerPage = 5;
        $scope.rotate = true;
        $scope.forceEclipses = true;
        $scope.boundaryLinks = true;
        $scope.showPagination = true;
        $scope.paginationDisable = false;

        $scope.datePickerOptions = {
            dateDisabled: false,
            formatDay: 'dd',
            formatMonth: 'MM',
            formatYear: 'yyyy'
        };

        $scope.reloadMembers = function() {
            var members, membersRefined = [];
            $scope.reloading = true;
            members =  Specialty.query({}, function() {
                angular.forEach(members, function (value) {
                    value.created_at = new Date(value.created_at);
                    value.updated_at = new Date(value.updated_at);
                    this.push(value);
                }, membersRefined);
                $scope.members = membersRefined;
                $scope.reloading = false;
            }, function() {
                $scope.reloading = false;
            });
        };


        $scope.loadAll = function () {
            $scope.reloading = true;
            $scope.reloadMembers();
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

        $scope.updateMember = function (record) {
            Specialty.update({id: record.id}, record, function (response) {
                var status = response.status || 'Success',
                    message = response.message || "Removed successfully";

                toastr.success(message, status);
                $scope.loadAll();
            }, function (response) {
                var data = response.data,
                    status = data.status || 'Error',
                    message = data.message || "Removed successfully";

                toastr.error(message, status);
            });
        };

        $scope.createMember = function (record) {
            var newRecord = new Specialty(record);
            newRecord.$save(record, function (response) {
                var status = response.status || 'Success',
                    message = response.message || "Removed successfully";

                toastr.success(message, status);
                $scope.loadAll();
            }, function (response) {
                var data = response.data,
                    status = data.status || 'Error',
                    message = data.message || "Removed successfully";

                toastr.error(message, status);
            });
        };

        $scope.editMember = function (record) {
            var entry = angular.copy($scope.members[$scope.members.indexOf(record)]);

            $scope.action = 'update';
            $scope.originalEntry = entry;
            $scope.entry = entry;
        };

        $scope.addMember = function() {
            var entry = {};

            $scope.action = 'create';
            $scope.originalEntry = entry;
            $scope.entry = entry;
        };

        $scope.deleteMember = function (record) {
            Specialty.delete({id: record.id}, function (response) {
                var status = response.status || 'Success',
                    message = response.message || "Removed successfully";

                toastr.success(message, status);
                $scope.loadAll();
            }, function (response) {
                var data = response.data,
                    status = data.status || 'Error',
                    message = data.message || "Removed successfully";

                toastr.error(message, status);
            });
        };

        $scope.openDatePicker = function() {
            $scope.popupOpened = true;
        };

        $scope.loadAll();
    });