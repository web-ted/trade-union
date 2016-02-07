/**
 * Created by sulimo on 17/1/2016.
 */
angular.module('TradeUnion', ['ngRoute', 'ngResource', 'ui.bootstrap'])
    .config(function($routeProvider) {
        $routeProvider
            .when('/worker', {
                templateUrl: 'partials/workers_index.html',
                controller: 'WorkersController'
            })
            .otherwise({
                redirectTo: '/worker'
            });
    });