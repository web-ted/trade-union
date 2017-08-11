/**
 * Created by sulimo on 17/1/2016.
 */
angular.module('TradeUnion', ['ngRoute', 'ngResource', 'ui.bootstrap', 'ngAnimate', 'toastr'])
    .config(function($routeProvider) {
        $routeProvider
            .when('/worker', {
                templateUrl: 'partials/workers_index.html',
                controller: 'WorkersController'
            })
            .when('/enterprise', {
                templateUrl: 'partials/enterprise_index.html',
                controller: 'EnterprisesController'
            })
            .when('/specialty', {
                templateUrl: 'partials/specialty_index.html',
                controller: 'SpecialtiesController'
            })
            .when('/report', {
                templateUrl: 'partials/report.html'
            })
            .otherwise({
                redirectTo: '/worker'
            });
    })
    .config(function(toastrConfig) {
        angular.extend(toastrConfig, {
            autoDismiss: false,
            containerId: 'toast-container',
            maxOpened: 0,
            newestOnTop: true,
            positionClass: 'toast-top-right',
            preventDuplicates: false,
            preventOpenDuplicates: false,
            target: 'body'
        });
    });